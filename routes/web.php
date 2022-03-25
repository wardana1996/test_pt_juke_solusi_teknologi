<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\employeeController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/employees', [App\Http\Controllers\employeeController::class, 'index'])->name('employees.index');
Route::get('/employees/city/{id}', [App\Http\Controllers\employeeController::class, 'indexCity'])->name('employees.city');
Route::post('/employees/create', [App\Http\Controllers\employeeController::class, 'create'])->name('employees.create');
Route::post('/employees/edit/{id}', [App\Http\Controllers\employeeController::class, 'edit'])->name('employees.edit');
Route::post('/employees/update/{id}', [App\Http\Controllers\employeeController::class, 'update'])->name('employees.update');
Route::delete('/employees/delete/{id}', [App\Http\Controllers\employeeController::class, 'delete'])->name('employees.delete');
