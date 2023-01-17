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

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/calendar', function () {
    return view('calendar');
})->middleware('auth');

Route::get('/calendar/{any}', function () {
    return view('calendar');
})->where('any','.*')->middleware('auth');

Route::get('ajax/memo', [App\Http\Controllers\Ajax\MemoController::class, 'index'])->name('ajax_memo');
Route::get('ajax/category', [App\Http\Controllers\Ajax\CategoryController::class, 'index'])->name('ajax_category');
Route::get('ajax/task', [App\Http\Controllers\Ajax\TaskController::class, 'index'])->name('ajax_task');