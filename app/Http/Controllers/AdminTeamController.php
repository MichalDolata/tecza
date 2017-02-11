<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Team;
use App\TeamMember;
use Illuminate\Support\Facades\DB;

class AdminTeamController extends Controller
{
    public function index() {
        $teams = Team::all();
        return view('pages.admin.teams.index', compact('teams'));
    }

    public function create() {
        return view('pages.admin.teams.create');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'bail|required|max:255|unique:teams|slug:teams',
        ]);


        $team = Team::create($request->only(['name']));

        $request->session()->flash('status', 'Utworzono druzyne');
        return redirect()->action('AdminTeamController@edit', [$team->slug]);
    }

    public function edit(Team $team) {
        $members = TeamMember::all();
        $teamMembers = $team->members->groupBy('pivot.position');

        return view('pages.admin.teams.edit', compact('team', 'members', 'teamMembers'));
    }

    public function update(Request $request, Team $team) {
        $this->validate($request, [
            'name' => ['bail', 'required', 'max:255',
                Rule::unique('teams')->ignore($team->id), 'slug:teams,'.$team->id],
        ]);

        $team->name = $request->input('name');

        $team->save();

        $request->session()->flash('status', 'Zedytowano druzyne');
        return redirect()->action('AdminTeamController@edit', [$team->slug]);
    }

    public function addMember(Request $request, Team $team) {
        $member = TeamMember::find($request->id);
        $position = $request->position;
        $team->members()->save($member, compact('position'));

        return '';
    }

    public function deleteMember(Request $request, Team $team) {
        $member = $request->id;
        $position = $request->position;
        $team = $team->id;
        DB::table('team_team_member')->where('team_id', $team)
            ->where('team_member_id', $member)->where('position', $position)->delete();

        return '';
    }
}
