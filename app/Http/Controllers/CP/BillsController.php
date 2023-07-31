<?php

namespace App\Http\Controllers\CP;

use App\Exports\SummaryExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddBillToUserRequest;
use App\Http\Requests\AddExpensesToBillRequest;
use App\Http\Requests\CreateBillRequest;
use App\Models\Bill;
use App\Models\Company;
use App\Models\Expense;
use App\Models\MainExpenses;
use App\Models\Project;
use App\Models\Summary;
use App\Models\Tasks;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;

class BillsController extends Controller
{
    public function index(Request $request)
    {
        $bills = Bill::query()
            ->withSum('tasks', 'paid')
            ->withSum('expenses', 'amount')
            ->paginate(5)
            ->through(function ($bill) {
                return [
                    'id' => $bill->id,
                    'month' => $bill->month,
                    'year' => $bill->year,
                    'price' => $bill->price,
                    'description' => $bill->description,
                    'total_paid' => $bill->tasks_sum_paid,
                    'total_expenses' => $bill->expenses_sum_amount,
                    'is_closed' => $bill->is_closed,
                ];
            })->withQueryString();
        return inertia('Bills/Index', [
            'bills' => $bills,
            'filters' => $request->only('search')
        ]);
    }

    public function create()
    {

        $years = range(2023, 2025);
        $months = range(1, 12);
        return inertia('Bills/Create', [
            'years' => $years,
            'months' => $months
        ]);
    }

    public function store(CreateBillRequest $request)
    {
        $exists = Bill::query()->where('year', $request->year)->where('month', $request->month)->first();
        if ($exists) {
            return redirect()->back()->with('error_message', 'Bill already exists');
        }
        Bill::query()->create($request->all());
        return redirect()->back()->with('success_message', 'Bill created successfully');
    }

    public function add_user_to_bill_form(Request $request, $id)
    {
        $bill = Bill::query()->findOrFail($id);


        $users = User::query()->get();

        $projects = Project::with('company')->get();

        return inertia('Bills/AddUserToBill', [
            'bill' => $bill,
            'users' => $users,
            'projects' => $projects,
        ]);
    }

    public function add_user_to_bill_action(AddBillToUserRequest $request, $id)
    {
        Tasks::query()->where('bill_id', $id)->where('user_id', $request->user_id)->delete();
        foreach ($request->tasks as $task) {
            $from_date = isset($task['date'][0]) ? Carbon::parse($task['date'][0])->toDateString() : null;
            $to_date = isset($task['date'][1]) ? Carbon::parse($task['date'][1])->toDateString() : null;

            Tasks::query()->create([
                'user_id' => $request->user_id,
                'bill_id' => $id,
                'project_id' => $task['project_id'],
                'percentage' => $task['percentage'],
                'paid' => $task['paid'],
                'name' => $task['task_name'],
                'hours' => $task['hours'],
                'from_date' => $from_date,
                'to_date' => $to_date,
            ]);
        }
        return redirect()->route('bills.index')->with('success_message', 'User added to bill successfully');
    }

    public function get_user_tasks($user_id, $bill_id)
    {

        $tasks = Tasks::query()->where('user_id', $user_id)->where('bill_id', $bill_id)->get();

        $tasks = $tasks->map(function ($task) {

            return [
                'id' => $task->id,
                'task_name' => $task->name,
                'hours' => $task->hours,
                'percentage' => $task->percentage,
                'paid' => $task->paid,
                'project_id' => $task->project_id,
                'project_name' => $task->project->name,
                'company_id' => $task->project->company->name ?? '',
                'from_date' => $task->from_date ?? '',
                'to_date' => $task->to_date ?? '',
            ];
        });
        return response()->json([
            'tasks' => $tasks
        ]);
    }

    public function show_bill_tasks(Request $request, Bill $bill)
    {

        $projects = Project::all();
        $tasks = Tasks::query()->with(['user', 'project', 'project.company'])
            ->when($request->search, function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            })
            ->when($request->project_id, function ($query) use ($request) {
                $query->where('project_id', $request->project_id);
            })
            ->where('bill_id', $bill->id)
            ->paginate(5)
            ->through(function ($task) {
                return [
                    'id' => $task->id,
                    'task_name' => substr($task->name, 0, 20),
                    'hours' => $task->hours,
                    'percentage' => $task->percentage,
                    'paid' => $task->paid,
                    'project_id' => $task->project_id,
                    'project_name' => $task->project->name,
                    'company_id' => $task->project->company->name ?? '',
                    'user' => $task->user,
                ];
            })
            ->withQueryString();

        return inertia('Bills/showBillTasks', [
            'bill' => $bill,
            'tasks' => $tasks,
            'filters' => $request->only('search'),
            'projects' => $projects
        ]);
    }

    public function add_expenses_to_bill_form(Request $request, $bill_id)
    {


        $bill = Bill::query()->with('expenses')->findOrFail($bill_id);
        $main_expenses = MainExpenses::query()->get()->map(function ($main_expense) {
            return [
                'id' => $main_expense->id,
                'name' => $main_expense->name,
                'amount' => $main_expense->amount,
                'main_expense_id'=>$main_expense->id
            ];

        });
        return inertia('Bills/AddExpensesToBill', [
            'bill' => $bill,
            'main_expenses' => $main_expenses,
        ]);
    }

    public function add_expenses_to_bill_action(AddExpensesToBillRequest $request, $bill_id)
    {

        Expense::query()->where('bill_id', $bill_id)->delete();
        foreach ($request->expenses as $expense) {
            Expense::query()->create([
                'bill_id' => $bill_id,
                'main_expenses_id' => $expense['main_expenses_id'],
                'amount' => $expense['amount'],
            ]);

        }
        return redirect()->route('bills.index')->with('success_message', 'Expenses added to bill successfully');

    }

    public function summary(Bill $bill)
    {
        return inertia('Bills/Summary', [
            'bill' => $bill,
        ]);
    }

    public function get_users_summary(Request $request, Bill $bill)
    {
        $tasks = Summary::query()
            ->with(['user'])
            ->select('user_id')
            ->selectRaw('sum(hours) as hours')
            ->selectRaw('sum(paid) as paid')
            ->selectRaw('sum(percentage) as percentage')
            ->where('bill_id', $bill->id)
            ->groupBy('user_id')
            ->get();

        $taskAfterMap = $tasks->map(function ($task) {
            return [
                'key' => $task->user->id,
                'data' => collect([
                    'user' => $task->user->name,
                    'hours' => $task->hours,
                    'percentage' => $task->percentage,
                    'paid' => $task->paid,
                ]),
                'children' => [
                    []
                ]
            ];
        });
        return response()->json(
            $taskAfterMap
        );

    }

    public function get_children(Bill $bill, User $user)
    {
        $tasks = Summary::query()
            ->select('project_id')
            ->selectRaw('sum(hours) as hours')
            ->selectRaw('sum(paid) as paid')
            ->selectRaw('sum(percentage) as percentage')
            ->with(['user', 'project', 'project'])
            ->where('bill_id', $bill->id)
            ->where('user_id', $user->id)
            ->groupBy('project_id')
            ->get();

        $taskAfterMap = $tasks->map(function ($task) use ($user) {
            return [
                'key' => $user->id ?? '',
                'styleClass' => 'table-primary',
                'data' => collect([
                    'user' => $user->name,
                    'hours' => $task->hours,
                    'percentage' => $task->percentage,
                    'paid' => $task->paid,
                    'project' => $task->project->name,
                ]),
            ];
        });

        return response()->json(
            $taskAfterMap
        );

    }

    public function summary_export(Request $request, Bill $bill)
    {
        $tasks = Summary::query()
            ->select('project_id', 'user_id')
            ->selectRaw('sum(hours) as hours')
            ->selectRaw('sum(paid) as paid')
            ->selectRaw('sum(percentage) as percentage')
            ->with(['user', 'project', 'project'])
            ->where('bill_id', $bill->id)
            ->groupBy('project_id', 'user_id')
            ->get();

        $taskAfterMap = $tasks->map(function ($task) {

            return [
                'data' => collect([
                    'user' => $task->user->name ?? '',
                    'hours' => $task->hours ?? '',
                    'percentage' => $task->percentage ?? '',
                    'paid' => $task->paid ?? '',
                    'project' => $task->project->name ?? '',
                    'company' => $task->project->company->name ?? '',
                ]),
            ];
        });
        return Excel::download(new SummaryExport($taskAfterMap), 'summary.xlsx');
    }

    public function get_user_summary(User $user, Bill $bill)
    {
        $summary = Summary::query()
            ->where('user_id', $user->id)
            ->where('bill_id', $bill->id)
            ->get();
        $tasks = $summary->map(function ($task) {
            return [
                'id' => $task->id,
                'hours' => $task->hours,
                'percentage' => $task->percentage,
                'paid' => $task->paid,
                'project_id' => $task->project_id,
                'project_name' => $task->project->name,
                'company_id' => $task->project->company->name ?? '',
            ];
        });
        return response()->json([
            'tasks' => $tasks
        ]);

    }

    public function store_summary(Bill $bill)
    {
        $summary = \request('tasks');
        Summary::query()->where('bill_id', $bill->id)->where('user_id', request('user_id'))->delete();
        foreach (collect($summary)->groupBy('project_id') as $task) {
            Summary::query()->create([
                'bill_id' => $bill->id,
                'project_id' => $task[0]['project_id'],
                'user_id' => request('user_id'),
                'hours' => $task->sum('hours'),
                'percentage' => $task->sum('percentage'),
                'paid' => $task->sum('paid'),
                'company_id' => Company::query()->where('name', $task[0]['company_id'])->first()->id ?? null,
            ]);
        }
        return redirect()->route('bills.index')->with('success_message', 'Summary added to bill successfully');
    }

    public function change_bill_status(Bill $bill)
    {
        $bill->is_closed = !$bill->is_closed;
        $bill->save();
    }
}
