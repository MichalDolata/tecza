<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use Illuminate\Validation\Rule;
use Validator;
//use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class AdminNewsController extends Controller
{
    public function index() {
        $allNews = News::all();
        return view('pages.admin.news.index', compact('allNews'));
    }

    public function create() {
        return view('pages.admin.news.create');
    }

    public function store(Request $request) {
        $this->validate($request,
            [
                'title' => 'bail|required|max:255|unique:news|slug:news',
                'lead' => 'required',
                'content' => 'required'
            ]);

        $news = News::create([
            'author_id' => Auth::id(),
            'title' => $request->input('title'),
            'lead' => $request->input('lead'),
            'content' => $request->input('content'),
        ]);

        $request->session()->flash('status', 'Utworzono news');
        return redirect()->action('AdminNewsController@edit', [$news->slug]);
    }

    public function edit(Request $request, News $news) {
        return view('pages.admin.news.edit', compact('news'));
    }

    public function update(Request $request, News $news) {
        $this->validate($request,
            [
                'title' => ['bail', 'required', 'max:255', Rule::unique('news')->ignore($news->id), 'slug:news,'.$news->id],
                'lead' => 'required',
                'content' => 'required',
            ]);

        $news->title = $request->input('title');
        $news->lead = $request->input('lead');
        $news->content = $request->input('content');

        $news->save();

        $request->session()->flash('status', 'Zedytowano news');
        return redirect()->action('AdminNewsController@edit', [$news->slug]);
    }

    // TODO: function delete
}
