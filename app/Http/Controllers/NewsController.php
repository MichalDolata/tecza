<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;

class NewsController extends Controller
{
    public function index() {
        $allNews = News::orderBy('created_at', 'DESC')->paginate(10);
        return view('pages.news.index')->with('allNews', $allNews);
    }

    public function show(News $news) {
        return view('pages.news.show')->with('news', $news);
    }
}
