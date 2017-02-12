<?php

namespace App\Http\Controllers;

use App\Contest;
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

        $contest = Contest::create([
            'name' => $request->input('name'),
            'number_of_teams' => $request->input('number_of_teams'),
            'revenge' => $request->has('revenge')
        ]);

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
        return view('pages.admin.contests.edit', compact('contest'));
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
            'number_of_teams' => 'bail|required|numeric|min:2'
        ]);

        $contest->name = $request->input('name');
        $contest->number_of_teams = $request->input('number_of_teams');

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
}
