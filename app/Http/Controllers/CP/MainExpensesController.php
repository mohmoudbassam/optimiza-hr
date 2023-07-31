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

class MainExpensesController extends Controller
{
    public function index()
    {
        $main_expenses = MainExpenses::query()->paginate(5)
            ->through(function ($main_expense) {
                return [
                    'id' => $main_expense->id,
                    'name' => $main_expense->name,
                    'description' => $main_expense->description,
                ];
            })->withQueryString();

        return Inertia::render('MainExpenses/Index', [
            'main_expenses' => $main_expenses,
        ]);
    }

    public function create()
    {
        return Inertia::render('MainExpenses/Create');
    }

    public function store(Request $request)
    {
        MainExpenses::query()->create([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        return redirect()->back()->with('success_message', 'Expenses created successfully');
    }

    public function edit($expense)
    {
        $expense = MainExpenses::query()->findOrFail($expense);
        return Inertia('MainExpenses/Edit', [
            'expenses' => $expense,
        ]);
    }
    public function update(Request $request,$id)
    {
        $expense = MainExpenses::query()->findOrFail($id);
        $expense->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        return redirect()->back()->with('success_message', 'Expenses updated successfully');
    }
}
