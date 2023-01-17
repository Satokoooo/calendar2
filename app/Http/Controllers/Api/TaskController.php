<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Category;
use Auth;

class TaskController extends Controller
{
    public function index() {
        return Task::all();
    }

    public function create(Request $request) {
        $task = new Task();
        $form = $request->all();
        //データの内容を入れ替え
        // $memo->title=$form->title;
        // $memo->text=$form->text;
        $task->fill($form);
        $task->user_id=Auth::id();
        // $task->user_id=1;
        $task->save();
        return $task;
    }
    
    public function destroy($id) {
        $task = Task::find($id);
        $task->delete();
        return $task;
    }
    
    public function update($id, Request $request){
        $task = Memo::find($id);
        $task->update($request->all());
        return $task;
    }
}

