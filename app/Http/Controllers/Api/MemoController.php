<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Memo;
// use Auth;
use Illuminate\Support\Facades\Auth;


class MemoController extends Controller
{
    public function index() {
        return Memo::all();
    }

    public function create(Request $request) {
        $memo = new Memo();
        
        $form = $request->all();
        
        //データの内容を入れ替え
        // $memo->title=$form->title;
        // $memo->text=$form->text;
        $memo->fill($form);
        // $memo->user_id=1;
        $memo->user_id=Auth::id();
        // dd(Auth);    
        // $memo->save();
        return $request->user('api');
    }
    
    public function destroy($id) {
        $memo = Memo::find($id);
        $memo->delete();
        return $memo;
    }
    
    public function update($id, Request $request){
        $memo = Memo::find($id);
        $memo->update($request->all());
        return $memo;
    }
}
