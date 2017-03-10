<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\NextMatch;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class AdminNextMatchController extends Controller {
    public function edit() {
        $nextMatch = NextMatch::get()->first();
        return view('pages.admin.next_match.edit', compact('nextMatch'));
    }

    public function update(Request $request) {
        $nextMatch = NextMatch::get()->first();
        $this->validate($request,
            [
                'date' => 'date',
                'image' => 'image',
                'type' => ['required', Rule::in(['home', 'away'])]
            ]);

        $uploadedImage = $request->file('image');

        if($uploadedImage) {
            $this->storeLogo($uploadedImage);
        }

        $nextMatch->active = $request->has('active');
        $nextMatch->opponent = $request->input('opponent');
        $nextMatch->place = $request->input('place');
        $nextMatch->date = $request->input('date') ? Carbon::createFromFormat('Y-m-d\TH:i', $request->input('date')) : null;
        $nextMatch->type = $request->input('type');

        $nextMatch->save();

        $request->session()->flash('status', 'Zedytowano');
        return redirect()->action('AdminNextMatchController@edit');
    }

    protected function storeLogo($uploadedImage)
    {
        $image = Image::make($uploadedImage)->fit(128, 128, function ($constraint) {
            $constraint->upsize();
        })->encode('png', 100);
        Storage::put("images/opponent_logo.png", $image->getEncoded());
    }
}