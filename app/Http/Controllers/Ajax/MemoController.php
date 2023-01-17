<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\Memo;

class MemoController extends Controller
{
    public function index() {
        return \App\Models\Memo::all();
    }
}
