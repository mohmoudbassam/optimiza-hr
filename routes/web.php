<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CP\MainExpensesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('test', function () {
   \App\Models\User::query()->create([
       'name' => 'test',
       'email' =>'admin@admin.com',
       'password'=>bcrypt('123456'),
       'is_admin'=>1,
    ]);

});
Route::get('login', [LoginController::class,'create'])->name('login');
Route::post('login', [LoginController::class,'store'])->name('login');
Route::post('logout', [LoginController::class,'logout'])->name('logout');
Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return inertia('Welcome');
    });
    Route::get('/Dashboard', function () {

        return inertia('Dashboard');
    });


    Route::prefix('Projects')->middleware('Admin')->group(function (){
        Route::get('/',[\App\Http\Controllers\CP\ProjectController::class,'index'])->name('projects.index');
        Route::get('/create',[\App\Http\Controllers\CP\ProjectController::class,'create'])->name('projects.create');
        Route::post('/store',[\App\Http\Controllers\CP\ProjectController::class,'store'])->name('projects.store');
        Route::get('/edit/{project}',[\App\Http\Controllers\CP\ProjectController::class,'edit'])->name('projects.edit');
        Route::post('/update/{project}',[\App\Http\Controllers\CP\ProjectController::class,'update'])->name('projects.update');
        Route::get('/delete/{id}',[\App\Http\Controllers\CP\ProjectController::class,'destroy'])->name('projects.destroy');
    });
    Route::prefix('Users')->middleware('Admin')->group(function (){
        Route::get('',[\App\Http\Controllers\CP\UserController::class,'index'])->name('users.index');
        Route::get('create',[\App\Http\Controllers\CP\UserController::class,'create'])->name('users.create');
        Route::post('upload_image',[\App\Http\Controllers\CP\UserController::class,'upload_image'])->name('users.upload_image');
        Route::post('store',[\App\Http\Controllers\CP\UserController::class,'store'])->name('users.store');
        Route::get('edit/{id}',[\App\Http\Controllers\CP\UserController::class,'edit'])->name('users.edit');
        Route::post('update',[\App\Http\Controllers\CP\UserController::class,'update'])->name('users.update');
        Route::post('destroy',[\App\Http\Controllers\CP\UserController::class,'destroy'])->name('users.destroy');
    });
    Route::prefix('Companies')->middleware('Admin')->group(function (){
        Route::get('',[\App\Http\Controllers\CP\CompanyController::class,'index'])->name('companies.index');
        Route::get('create',[\App\Http\Controllers\CP\CompanyController::class,'create'])->name('companies.create');
        Route::post('store',[\App\Http\Controllers\CP\CompanyController::class,'store'])->name('companies.store');
        Route::get('edit/{id}',[\App\Http\Controllers\CP\CompanyController::class,'edit'])->name('companies.edit');
        Route::post('update',[\App\Http\Controllers\CP\CompanyController::class,'update'])->name('companies.update');
        Route::post('destroy',[\App\Http\Controllers\CP\CompanyController::class,'destroy'])->name('companies.destroy');
    });
    Route::prefix('Bills')->middleware('Admin')->group(function (){
        Route::get('',[\App\Http\Controllers\CP\BillsController::class,'index'])->name('bills.index');
        Route::get('create',[\App\Http\Controllers\CP\BillsController::class,'create'])->name('bills.create');
        Route::post('store',[\App\Http\Controllers\CP\BillsController::class,'store'])->name('bills.store');
        Route::post('change_bill_status/{bill}',[\App\Http\Controllers\CP\BillsController::class,'change_bill_status'])->name('bills.change_bill_status');
        /// bill user route
        Route::get('add_user_to_bill_form/{bill_id}',[\App\Http\Controllers\CP\BillsController::class,'add_user_to_bill_form'])->name('bills.add_user_to_bill_form');
        Route::post('add_user_to_bill_action/{bill_id}',[\App\Http\Controllers\CP\BillsController::class,'add_user_to_bill_action'])->name('bills.add_user_to_bill_action');
        Route::get('get_user_tasks/{user_id}/{bill_id}',[\App\Http\Controllers\CP\BillsController::class,'get_user_tasks'])->name('bills.get_user_tasks');
        Route::get('show_bill_tasks/{bill}',[\App\Http\Controllers\CP\BillsController::class,'show_bill_tasks'])->name('bills.show_bill_tasks');
        Route::get('get_user_summary/user/{user}/bill/{bill}',[\App\Http\Controllers\CP\BillsController::class,'get_user_summary'])->name('bills.get_user_summary');
        Route::post('store_summary/{bill}',[\App\Http\Controllers\CP\BillsController::class,'store_summary'])->name('bills.store_summary');

        ///expenses route
        Route::get('add_expenses_to_bill_form/{bill_id}',[\App\Http\Controllers\CP\BillsController::class,'add_expenses_to_bill_form'])->name('bills.add_expenses_to_bill_form');
        Route::post('add_expenses_to_bill_action/{bill_id}',[\App\Http\Controllers\CP\BillsController::class,'add_expenses_to_bill_action'])->name('bills.add_expenses_to_bill_action');
        Route::get('summary/{bill}',[\App\Http\Controllers\CP\BillsController::class,'summary'])->name('bills.summary');
        Route::get('get_users_summary/{bill}',[\App\Http\Controllers\CP\BillsController::class,'get_users_summary'])->name('tasks.get_users_summary');
        Route::get('get_children/{bill}/{user}',[\App\Http\Controllers\CP\BillsController::class,'get_children'])->name('tasks.get_children');
        Route::get('summary_export/{bill}',[\App\Http\Controllers\CP\BillsController::class,'summary_export'])->name('tasks.summary_export');

    });
    Route::prefix('Tasks')->group(function (){
        Route::get('',[\App\Http\Controllers\CP\TasksController::class,'index'])->name('tasks.months');
        Route::get('my-tasks/{bill}',[\App\Http\Controllers\CP\TasksController::class,'my_tasks'])->name('tasks.my_tasks');
        Route::post('store_tasks',[\App\Http\Controllers\CP\TasksController::class,'store_tasks'])->name('tasks.store_tasks');
        Route::get('get_user_tasks/{bill}',[\App\Http\Controllers\CP\TasksController::class,'get_user_tasks'])->name('tasks.get_user_tasks');
    });
    Route::prefix('main_expenses')->group(function (){
        Route::get('',[MainExpensesController::class,'index'])->name('main_expenses.index');
        Route::get('create',[MainExpensesController::class,'create'])->name('main_expenses.create');
        Route::post('store',[MainExpensesController::class,'store'])->name('main_expenses.store');
        Route::get('edit/{expenses}',[MainExpensesController::class,'edit'])->name('main_expenses.edit');
        Route::post('update/{id}',[MainExpensesController::class,'update'])->name('main_expenses.update');
    });

});
