<?php

namespace App\Http\Controllers\CP;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddBillToUserRequest;
use App\Http\Requests\AddExpensesToBillRequest;
use App\Http\Requests\CreateBillRequest;
use App\Models\Bill;
use App\Models\Expense;
use App\Models\Project;
use App\Models\Tasks;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

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
            Tasks::query()->create([
                'user_id' => $request->user_id,
                'bill_id' => $id,
                'project_id' => $task['project_id'],
                'percentage' => $task['percentage'],
                'paid' => $task['paid'],
                'name' => $task['task_name'],
                'hours' => $task['hours'],
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
                    'task_name' =>substr($task->name, 0, 20),
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
        return inertia('Bills/AddExpensesToBill', [
            'bill' => $bill,
        ]);
    }

    public function add_expenses_to_bill_action(AddExpensesToBillRequest $request,$bill_id)
    {
        Expense::query()->where('bill_id', $bill_id)->delete();
        foreach ($request->expenses as $expense) {
            Expense::query()->create([
                'bill_id' => $bill_id,
                'description' => $expense['description'],
                'amount' => $expense['amount'],
            ]);

        }
        return redirect()->route('bills.index')->with('success_message', 'Expenses added to bill successfully');

    }
}
