<?php

namespace App\Http\Controllers\CP;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Company;
use App\Models\Expense;
use App\Models\Project;
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


        $total_salary = $tasks->sum('paid');
        $total_fees = $total_salary * 0.025;
        $total_salary_with_fees = $total_salary + $total_fees;

        $taskAfterMap = $tasks->map(function ($task) {
            return [
                'key' => $task->user->id,
                'data' => collect([
                    'user' => $task->user->name,
                    'hours' => number_format($task->hours,2),
                    'percentage' => number_format(floor($task->percentage),2),
                    'paid' => number_format($task->paid, 2),
                    'fees' => number_format(($task->paid * 0.025), 2),
                    'total' => number_format(($task->paid * 0.025) + $task->paid, 2)
                ]),
                'children' => [
                    []
                ]
            ];
        });

        return response()->json(
            [
                'data' => $taskAfterMap,
                'total_salary' => number_format($total_salary, 2),
                'total_fees' => number_format($total_fees, 2),
                'total_salary_with_fees' => number_format($total_salary_with_fees, 2),

            ]
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
                    'paid' => number_format($task->paid, 2),
                    'project' => $task->project->name,
                    'fees' => number_format(($task->paid * 0.025), 2),
                    'total' => number_format(($task->paid * 0.025) + $task->paid, 2)
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

        $total_salary = $summary->sum('paid');
        $total_fees = $total_salary * 0.025;
        $total_salary_with_fees = $total_salary + $total_fees;
        $total_hours = $summary->sum('hours');
        $taskAfterMap = $summary->map(function ($task) {
            return [
                'key' => $task->company->id,
                'data' => collect([
                    'id' => $task->id,
                    'hours' => $task->hours,
                    'percentage' => $task->percentage,
                    'paid' => number_format($task->paid, 2),
                    'company_id' => $task->company_id,
                    'company_name' => $task->company->name,
                    'fess' => number_format(($task->paid * 0.025), 2),
                    'total' => number_format(($task->paid * 0.025) + $task->paid, 2)
                ]),
                'children' => [
                    []
                ]
            ];
        });
        return response()->json([
            'data' => $taskAfterMap,
            'total_salary' => number_format($total_salary, 2),
            'total_fees' => number_format($total_fees, 2),
            'total_salary_with_fees' => number_format($total_salary_with_fees, 2),
            'total_hours' => number_format($total_hours, 2),
        ]);
    }

    public function get_children_for_company(Request $request, Company $company)
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
                    'paid' => number_format($task->paid, 2),
                    'project_id' => $task->project_id,
                    'project_name' => $task->project->name,
                ]),
            ];
        });

        return response()->json(
            $taskAfterMap
        );
    }

    public function get_report_by_projects(Request $request)
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
            ->with(['company'])
            ->where('bill_id', $bill->id)
            ->groupBy('project_id')
            ->get();

        $total_salary = $summary->sum('paid');
        $total_fees = $total_salary * 0.025;
        $total_salary_with_fees = $total_salary + $total_fees;
        $total_hours = $summary->sum('hours');

        $taskAfterMap = $summary->map(function ($task) {
            $company = Company::query()->where('id', $task->project->company_id)->first();
            return [
                'key' => $task->project->id,
                'data' => collect([
                    'id' => $task->id,
                    'hours' => $task->hours,
                    'percentage' => $task->percentage,
                    'paid' => number_format($task->paid, 2),
                    'company_id' => $company->id,
                    'company_name' => $company->name,
                    'project_name' => $task->project->name,
                    'fess' => number_format(($task->paid * 0.025), 2),
                    'total' => number_format(($task->paid * 0.025) + $task->paid, 2)
                ]),
                'children' => [
                    []
                ]
            ];
        });

        return response()->json([
            'data' => $taskAfterMap,
            'total_salary' => number_format($total_salary, 2),
            'total_fees' => number_format($total_fees, 2),
            'total_salary_with_fees' => number_format($total_salary_with_fees, 2),
            'total_hours' => number_format($total_hours, 2),
        ]);
    }

    public function get_children_for_project(Request $request, Project $project)
    {
        $bill = Bill::query()
            ->where('year', $request->year)
            ->where('month', $request->month)
            ->first();
        $summary = Summary::query()
            ->select('user_id')
            ->selectRaw('sum(hours) as hours')
            ->selectRaw('sum(paid) as paid')
            ->selectRaw('sum(percentage) as percentage')
            ->with(['user'])
            ->where('bill_id', $bill->id)
            ->where('project_id', $project->id)
            ->groupBy('user_id')
            ->get();

        $taskAfterMap = $summary->map(function ($task) use ($project) {
            return [
                'key' => $project->id,
                'styleClass' => 'table-primary',
                'data' => collect([
                    'hours' => $task->hours,
                    'percentage' => number_format($task->percentage, 2),
                    'paid' =>number_format( $task->paid, 2),
                    'user_id' => $task->user_id,
                    'employee' => $task->user->name,
                ]),
            ];
        });

        return response()->json(
            $taskAfterMap
        );
    }

    public function get_total_report(Request $request)
    {
        $bill = Bill::query()
            ->where('year', $request->year)
            ->where('month', $request->month)
            ->first();
        $expenses= Expense::query()
            ->with('mainExpenses')
            ->where('bill_id', $bill->id)
            ->get();


        $total_paid = Summary::query()->where('bill_id', $bill->id)->sum('paid');
        $total_expenses = $bill->expenses()->sum('amount');
        $total_fees = $total_paid * 0.025;
        $total_paid_with_fees = $total_paid + $total_fees;
        $total_paid_with_fees_and_total_expenses = $total_paid_with_fees + $total_expenses;
        return response()->json(
            [
                'total_paid' => number_format($total_paid, 2),
                'total_expenses' => number_format($total_expenses, 2),
                'total_fees' => number_format($total_fees, 2),
                'total_paid_with_fees' => number_format($total_paid_with_fees, 2),
                'total_paid_with_fees_and_total_expenses' => number_format($total_paid_with_fees_and_total_expenses, 2),
                'expenses' => $expenses
            ]
        );


    }


}
