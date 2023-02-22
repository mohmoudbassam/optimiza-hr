<?php

namespace App\Http\Controllers\CP;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Project;
use App\Models\Tasks;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function index()
    {
        $bills = Bill::query()
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
                    'project_name' => $task->project->name,
                    'company_id' => $task->project->company->name ?? '',
                ];
            });
        $projects=Project::query()->with('company')->get();
        return inertia('Team/MyTasks', [
            'bill' => $bill,
            'tasks'=>$tasks,
            'projects'=>$projects
        ]);
    }

    public function store_tasks(Request $request){
        dd($request->all());
    }

}
