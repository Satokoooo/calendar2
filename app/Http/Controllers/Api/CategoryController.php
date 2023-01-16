<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Auth;

class CategoryController extends Controller
{
    public function index() {
        return Category::all();
    }

    public function create(Request $request) {
        $category = new Category();
        $form = $request->all();
        //データの内容を入れ替え
        $category->fill($form);
        // $category->user_id=Auth::id();
        $category->user_id=1;
        $category->save();
        
        return $category;
    }
}
