<?php

namespace App\Http\Controllers\CP;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Company;
use App\Models\Summary;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $data = [];
        foreach (range(2022, date('Y')) as $year) {
            $data['years'][] = $year;
        }
        foreach (range(1, 12) as $month) {
            $data['months'][] = $month;
        }

        return inertia('Report/Index', $data);
    }

    public function get_employees_summary(Request $request)
    {
        $bill = Bill::query()
            ->where('year', $request->year)
            ->where('month', $request->month)
            ->first();

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
                    'fees' => number_format(($task->paid * 0.025), 2),
                    'total' => number_format(($task->paid * 0.025) + $task->paid, 2)
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
    public function get_employee_children(Request $request, User $user)
    {
        $bill = Bill::query()
            ->where('year', $request->year)
            ->where('month', $request->month)
            ->first();
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

    public function get_company_report(Request $request)
    {
        $bill = Bill::query()
            ->where('year', $request->year)
            ->where('month', $request->month)
            ->first();
        $summary = Summary::query()
            ->select('company_id')
            ->selectRaw('sum(hours) as hours')
            ->selectRaw('sum(paid) as paid')
            ->selectRaw('sum(percentage) as percentage')
            ->with(['company'])
            ->where('bill_id', $bill->id)
            ->groupBy('company_id')
            ->get();

        $taskAfterMap = $summary->map(function ($task) {
            return [
                'key' => $task->company->id,
                'data' => collect([
                    'id' => $task->id,
                    'hours' => $task->hours,
                    'percentage' => $task->percentage,
                    'paid' => $task->paid,
                    'company_id' => $task->company_id,
                    'company_name' => $task->company->name,
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

    public function get_children_for_company(Request $request,Company $company)
    {
        $bill = Bill::query()
            ->where('year', $request->year)
            ->where('month', $request->month)
            ->first();
        $summary = Summary::query()
            ->select('project_id')
            ->selectRaw('sum(hours) as hours')
            ->selectRaw('sum(paid) as paid')
            ->selectRaw('sum(percentage) as percentage')
            ->with(['project'])
            ->where('bill_id', $bill->id)
            ->where('company_id', $company->id)
            ->groupBy('project_id')
            ->get();

        $taskAfterMap = $summary->map(function ($task) use ($company) {
            return [
                'key' => $company->id,
                'styleClass' => 'table-primary',
                'data' => collect([
                    'hours' => $task->hours,
                    'percentage' => $task->percentage,
                    'paid' => $task->paid,
                    'project_id' => $task->project_id,
                    'project_name' => $task->project->name,
                ]),
            ];
        });

        return response()->json(
            $taskAfterMap
        );
    }
}
