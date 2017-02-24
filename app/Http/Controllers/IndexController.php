<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;

class IndexController extends Controller
{
    public function index() {
        $news = News::orderBy('created_at', 'desc')->take(3)->get();
        return view('pages.index', compact('news'));
    }
}
