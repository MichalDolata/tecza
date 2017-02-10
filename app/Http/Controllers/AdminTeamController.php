<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Team;

class AdminTeamController extends Controller
{
    public function index() {
        $teams = Team::all();
        return view('pages.admin.teams.index')->with('teams', $teams);
    }

    public function create() {
        return view('pages.admin.teams.create');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(),
            [
                'name' => 'required|max:255|unique:teams|slug:teams',
            ]);

        if ($validator->fails()) {
            return redirect()->action('AdminTeamController@create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $team = Team::create([
                'name' => $request->input('name'),
            ]);

            $request->session()->flash('status', 'Utworzono druzyne');
            return redirect()->action('AdminTeamController@edit', [$team->slug]);
        }
    }

    public function edit(Team $team) {
        return view('pages.admin.teams.edit')->with('team', $team);
    }

    public function update(Request $request, Team $team) {
        $validator = Validator::make($request->all(),
            [
                'name' => ['required','max:255', Rule::unique('teams')->ignore($team->id), 'slug:teams,'.$team->id],
            ]);

        if ($validator->fails()) {
            return redirect()->action('AdminTeamController@edit', [$team->slug])
                ->withErrors($validator)
                ->withInput();
        } else {
            $team->name = $request->input('name', $team->name);

            $team->save();

            $request->session()->flash('status', 'Zedytowano druzyne');
            return redirect()->action('AdminTeamController@edit', [$team->slug]);
        }
    }
}
