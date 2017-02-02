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
        return view('pages.admin.news.index')->with('allNews', $allNews);
    }

    public function create() {
        return view('pages.admin.news.create');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(),
            [
                'title' => 'required|max:255|unique:news',
                'lead' => 'required',
                'content' => 'required'
            ]);
        $validator->after(function($validator) {
            if(News::where('slug', str_slug($validator->attributes()['title']))->count()) {
                $validator->errors()->add('title', 'Tytuł jest zbyt podobny do już istniejącego');
            }
        });

        if ($validator->fails()) {
            return redirect()->action('AdminNewsController@create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $news = News::create([
                'author_id' => Auth::id(),
                'title' => $request->input('title'),
                'lead' => $request->input('lead'),
                'content' => $request->input('content'),
            ]);

            $request->session()->flash('status', 'Utworzono news');
            return redirect()->action('AdminNewsController@edit', [$news->slug]);
        }
    }

    public function edit(Request $request, News $news) {
        return view('pages.admin.news.edit')->with('news', $news);
    }

    public function update(Request $request, News $news) {
        $validator = Validator::make(array_merge($request->all(), ['news_id' => $news->id]),
            [
                'title' => ['required', 'max:255', Rule::unique('news')->ignore($news->id)],
                'lead' => 'required',
                'content' => 'required',
            ]);
        $validator->after(function($validator) {
            if(News::where('slug', str_slug($validator->attributes()['title']))
                ->where('id', '<>', $validator->attributes()['news_id'])->count()) {
                $validator->errors()->add('title', 'Tytuł jest zbyt podobny do już istniejącego');
            }
        });

        if ($validator->fails()) {
            return redirect()->action('AdminNewsController@edit', [$news->slug])
                ->withErrors($validator)
                ->withInput();
        } else {
            $news->title = $request->input('title', $news->title);
            $news->lead = $request->input('lead', $news->lead);
            $news->content = $request->input('content', $news->content);

            $news->save();

            $request->session()->flash('status', 'Zedytowano news');
            return redirect()->action('AdminNewsController@edit', [$news->slug]);
        }
    }
}
