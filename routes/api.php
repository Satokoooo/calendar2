<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Memo;
use App\Models\Task;
use App\Models\Schedule;
use App\Models\Color;
use App\Models\Category;
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
Route::get('memos', function(){
    return App\Models\Memo::all();
});

Route::post('memo', function(Request $request) {
    $memo = new Memo();
    
    $form = $request->all();
    
    //データの内容を入れ替え
    // $memo->title=$form->title;
    // $memo->text=$form->text;
    $memo->fill($form);
    
    $memo->user_id=Auth::id();
    // $memo->user_id=1;
        
    $memo->save();
    return $memo;
    // return $memo;
});

Route::delete('memos/{id}',function($id){
    $memo = App\Models\Memo::find($id);
    $memo->delete();
    return response()->json([
        'success' => 'memo deleted successfully!']);
});

Route::patch('memos/{id}', function($id, Request $request){
    $memo = App\Models\Memo::find($id);
    $memo->update($request->all());
    return $memo;
});