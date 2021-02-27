<?php

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
Auth::routes([ 'register' => false ]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/companies', [App\Http\Controllers\CompaniesController::class, 'index'])->name('companies.index');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return view('home');
    });
    Route::get('/companies/create', [App\Http\Controllers\CompaniesController::class, 'create'])->name('companies.create');
    Route::post('/companies/store', [App\Http\Controllers\CompaniesController::class, 'store'])->name('companies.store');
    Route::get('/employee/create', [App\Http\Controllers\EmployeesController::class, 'create'])->name('employee.create');
    Route::post('/employee/store', [App\Http\Controllers\EmployeesController::class, 'store'])->name('employee.store');
    Route::get('/companies/show/{company}', [App\Http\Controllers\CompaniesController::class, 'show'])->name('companies.show');
    Route::delete('/companies/remove/{company}', [App\Http\Controllers\CompaniesController::class, 'remove'])->name('companies.remove');
    Route::put('/companies/edit/{company}', [App\Http\Controllers\CompaniesController::class, 'edit'])->name('companies.edit');
    Route::get('/employee/show/{employee}', [App\Http\Controllers\EmployeesController::class, 'show'])->name('employee.show');
    Route::delete('/employee/remove/{employee}', [App\Http\Controllers\EmployeesController::class, 'remove'])->name('employee.remove');
    Route::put('/employee/edit/{employee}', [App\Http\Controllers\EmployeesController::class, 'edit'])->name('employee.edit');
    Route::post('/companies/removeLogo/{company}', [App\Http\Controllers\CompaniesController::class, 'removeLogo'])->name('companies.removeLogo');
});




