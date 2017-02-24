<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;

class TeamController extends Controller
{
    public function index() {
        $teams = Team::all();
        return view('pages.teams.index', compact('teams'));
    }

    public function show(Team $team) {
        $teamMembers = $team->members->groupBy('pivot.position');
        return view('pages.teams.show', compact('team', 'teamMembers'));
    }
}
