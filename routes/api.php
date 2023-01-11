<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Memo;
// use App\Models\Task;
// use App\Models\Schedule;
// use App\Models\Color;
// use App\Models\Category;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(App\Http\Controllers\Api\MemoController::class)->group(function(){
    Route::get('memos','index')->name('memo.index');
    // Route::post('memos','create')->name('memo.create');
    Route::delete('memos/{id}','destroy')->name('memo.destroy');
    Route::patch('memos/{id}','update')->name('memo.update');
});

Route::controller(App\Http\Controllers\Api\TaskController::class)->group(function(){
    Route::get('tasks','index')->name('task.index');
    Route::post('tasks','create')->name('task.create');
    Route::delete('tasks/{id}','destroy')->name('task.destroy');
    Route::patch('tasks/{id}','update')->name('task.update');
});

Route::controller(App\Http\Controllers\Api\CategoryController::class)->group(function(){
    Route::get('categories','index')->name('category.index');
    Route::post('categories','create')->name('category.create');
    // Route::delete('categories/{id}','destroy')->name('category.destroy');
    // Route::patch('categories/{id}','update')->name('category.update');
});

// Route::get('memos', function(){
//     return App\Models\Memo::all();
// });

Route::middleware('auth:sanctum')->post('memos', function(Request $request) {
    $memo = new Memo();
    
    $form = $request->all();
    
    //データの内容を入れ替え
    // $memo->title=$form->title;
    // $memo->text=$form->text;
    $memo->fill($form);
    $memo->user_id = Auth::id();
    // $memo->user_id=1;
    
    return $request->user();
    
    $memo->save();
    // return $memo;
});

// Route::delete('memos/{id}',function($id){
//     $memo = App\Models\Memo::find($id);
//     $memo->delete();
//     return response()->json([
//         'success' => 'memo deleted successfully!']);
// });

// Route::patch('memos/{id}', function($id, Request $request){
//     $memo = App\Models\Memo::find($id);
//     $memo->update($request->all());
//     return $memo;
// });