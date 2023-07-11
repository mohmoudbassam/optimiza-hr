<?php

namespace App\Http\Controllers\CP;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequestByTeamMember;
use App\Models\Bill;
use App\Models\Project;
use App\Models\Tasks;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function index()
    {
        $bills = Bill::query()
            ->orderBy('month','desc')
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

        return inertia('Team/Months', [
            'bills' => $bills,
        ]);
    }
    public function my_tasks(Bill $bill)
    {


        $projects=Project::query()->with('company')->get();
        return inertia('Team/MyTasks', [
            'bill' => $bill,
            'projects'=>$projects
        ]);
    }

    public function store_tasks(StoreTaskRequestByTeamMember $request){

        Tasks::query()->where('bill_id',$request->bill_id)
            ->where('user_id',auth()->id())
            ->delete();
        foreach ($request->tasks as $task) {

            $from_date=isset($task['date'][0])  ? Carbon::parse($task['date'][0])->toDateString():null;
            $to_date= isset($task['date'][1]) ? Carbon::parse($task['date'][1])->toDateString():null;

            Tasks::query()->create([
                'user_id' => $request->user()->id,
                'bill_id' => $request->bill_id,
                'project_id' => $task['project_id'],
                'percentage' => $task['percentage'],
                'paid' => $task['paid'],
                'name' => $task['task_name'],
                'hours' => $task['hours'],
                'from_date' => $from_date,
                'to_date' => $to_date,
            ]);
        }
        return redirect()->back()->with('success_message', 'Tasks added successfully');
    }
    public function get_user_tasks(Bill $bill){

        $tasks=Tasks::query()->with(['project.company'])
            ->where('bill_id',$bill->id)
            ->where('user_id',auth()->id())
            ->get()->map(function ($task) {

                return [
                    'id' => $task->id,
                    'task_name' => $task->name,
                    'hours' => $task->hours,
                    'percentage' => $task->percentage,
                    'paid' => $task->paid,
                    'project_id' => $task->project_id,
                    'project_name' => $task->project->name ?? '',
                    'company_id' => $task->project->company->name ?? '',
                    'from_date' =>$task->from_date,
                    'to_date' =>$task->to_date,
                ];
            });
        return response()->json([
            'tasks' => $tasks
        ]);
    }



}
