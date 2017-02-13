<?php

namespace App\Http\Controllers;

use App\Contest;
use App\Club;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminContestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contests = Contest::all();
        return view('pages.admin.contests.index', compact('contests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.contests.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'bail|required|max:255|unique:contests',
            'number_of_teams' => 'bail|required|numeric|min:2'
        ]);

        $numberOfTeams = $request->input('number_of_teams');
        $revenge = $request->has('revenge');

        $contest = Contest::create([
            'name' => $request->input('name'),
            'number_of_teams' => $numberOfTeams,
            'revenge' => $revenge
        ]);

        $matchesPerRound = intval($numberOfTeams / 2);
        $numberOfRounds = ($numberOfTeams * ($numberOfTeams - 1)) / (2 * $matchesPerRound);
        if($revenge) {
            $numberOfRounds *= 2;
        }

        $contest->createTimetableStructure($numberOfRounds, $matchesPerRound);

        return redirect()->action('AdminContestController@edit', ['id' => $contest->id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contest  $contest
     * @return \Illuminate\Http\Response
     */
    public function edit(Contest $contest)
    {
        $clubs = Club::all();
        return view('pages.admin.contests.edit', compact('contest', 'clubs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contest  $contest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contest $contest)
    {
        $this->validate($request, [
            'name' => ['bail', 'required', 'max:255', Rule::unique('contests')->ignore($contest->id)],
        ]);

        $contest->name = $request->input('name');

        $request->session()->flash('status', 'Zedytowano rozgrywki');
        return redirect()->action('AdminContestController@edit', ['id' => $contest->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contest  $contest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contest $contest)
    {
        //
    }

    public function addClub(Request $request, Contest $contest) {
        $club = Club::find($request->id);
        $contest->clubs()->attach($club);
    }

    public function deleteClub(Request $request, Contest $contest) {
        $club = Club::find($request->id);
        $contest->clubs()->detach($club);
    }
}
