<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\NotificationController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\TaskController;

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


Route::get('/', [TaskController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard', [TaskController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/export-excel', [TaskController::class, 'exportExcel'])->middleware(['auth', 'verified'])->name('export-excel');
Route::post('add-category', [CategoryController::class, 'store'])->name('add-category');
Route::post('add-task', [TaskController::class, 'store'])->name('add-task');
Route::post('update-task', [TaskController::class, 'update'])->name('add-update');
Route::delete('/tasks/{id}', [TaskController::class, 'destroy']);
Route::get('/get-tasks', [TaskController::class, 'getTask'])->name('get-tasks');
Route::get('/get-categories', [CategoryController::class, 'getCategories'])->name('get-categories');



require __DIR__ . '/auth.php';
