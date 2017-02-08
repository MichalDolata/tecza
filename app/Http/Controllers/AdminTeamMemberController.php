<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TeamMember;
use Illuminate\Support\Facades\Validator;

class AdminTeamMemberController extends Controller
{
    public function index() {
        $members = TeamMember::all();
        return view('pages.admin.teammembers.index')->with('members', $members);
    }

    public function create() {
        return view('pages.admin.teammembers.create');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'date_of_birth' => 'date'
        ]);

        if($validator->fails()) {
            return redirect()->action('AdminTeamMemberController@create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $member = TeamMember::create([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'date_of_birth' => $request->input('date_of_birth') !== '' ?
                $request->input('date_of_birth'): null
            ]);

            $request->session()->flash('status', 'Utworzono członka');
            return redirect()->action('AdminTeamMemberController@edit', [$member->id]);
        }
    }

    public function edit(TeamMember $member) {
        return view('pages.admin.teammembers.edit')->with('member', $member);
    }

    public function update(Request $request, TeamMember $member) {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'date_of_birth' => 'date'
        ]);

        if($validator->fails()) {
            return redirect()->action('AdminTeamMemberController@edit', [$member->id])
                ->withErrors($validator)
                ->withInput();
        } else {
            $member->first_name = $request->input('first_name', $member->first_name);
            $member->last_name = $request->input('last_name', $member->last_name);
            $member->date_of_birth = $request->input('date_of_birth', $member->date_of_birth) !== '' ?
                $request->input('date_of_birth', $member->date_of_birth): null;

            $member->save();

            $request->session()->flash('status', 'Zedytowano członka');
            return redirect()->action('AdminTeamMemberController@edit', [$member->id]);
        }
    }
}
