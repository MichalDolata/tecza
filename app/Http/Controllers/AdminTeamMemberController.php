<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TeamMember;
use Illuminate\Support\Facades\Validator;

class AdminTeamMemberController extends Controller
{
    public function index() {
        $members = TeamMember::all();
        return view('pages.admin.teammembers.index', compact('members'));
    }

    public function create() {
        return view('pages.admin.teammembers.create');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'date_of_birth' => 'date'
        ]);

        $member = TeamMember::create(
            $request->only(['first_name', 'last_name', 'date_of_birth'])
        );

        $request->session()->flash('status', 'Utworzono członka');
        return redirect()->action('AdminTeamMemberController@edit', [$member->id]);
    }

    public function edit(TeamMember $member) {
        return view('pages.admin.teammembers.edit', compact('member'));
    }

    public function update(Request $request, TeamMember $member) {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'date_of_birth' => 'date'
        ]);

        $member->first_name = $request->input('first_name');
        $member->last_name = $request->input('last_name');
        $member->date_of_birth = $request->input('date_of_birth');

        $member->save();

        $request->session()->flash('status', 'Zedytowano członka');
        return redirect()->action('AdminTeamMemberController@edit', [$member->id]);
    }

    public function destroy(Request $request, TeamMember $member) {
        $member->delete();

        $request->session()->flash('status', 'Usunieto członka');
        return redirect()->action('AdminTeamMemberController@index');
    }
}
