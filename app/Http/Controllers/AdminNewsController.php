<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

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
                'content' => 'required',
                'image' => 'bail|required|image'
            ]);

        $uploadedImage = $request->file('image');
        $id = time().uniqid();

        $this->storeImage($uploadedImage, $id);

        $news = News::create([
            'author_id' => Auth::id(),
            'title' => $request->input('title'),
            'lead' => $request->input('lead'),
            'content' => $request->input('content'),
            'image_id' => $id
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
                'image' => 'image'
            ]);

        $news->title = $request->input('title');
        $news->lead = $request->input('lead');
        $news->content = $request->input('content');

        if($request->hasFile('image')) {
            Storage::delete("images/news/{$news->image_id}.jpg");
            Storage::delete("images/news/thumbnail/{$news->image_id}.jpg");

            $uploadedImage = $request->file('image');
            $id = time().uniqid();

            $this->storeImage($uploadedImage, $id);
            $news->image_id = $id;
        }

        $news->save();

        $request->session()->flash('status', 'Zedytowano news');
        return redirect()->action('AdminNewsController@edit', [$news->slug]);
    }

    public function destroy(Request $request, News $news) {
        Storage::delete("images/news/{$news->image_id}.jpg");
        Storage::delete("images/news/thumbnail/{$news->image_id}.jpg");
        $news->delete();

        $request->session()->flash('status', 'Usunieto news');
        return redirect()->action('AdminNewsController@index');
    }

    protected function storeImage($uploadedImage, $id) {
        $image = Image::make($uploadedImage)->resize(600, 330)->encode('jpg', 100);
        Storage::put("images/news/{$id}.jpg", $image->getEncoded());

        $thumbnail = Image::make($uploadedImage)->resize(180, 100)->encode('jpg', 100);
        Storage::put("images/news/thumbnail/{$id}.jpg", $thumbnail->getEncoded());
    }
}
