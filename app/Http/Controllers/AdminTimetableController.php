<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contest;
use App\Match;

class AdminTimetableController extends Controller
{
    public function edit(Contest $contest) {
        return view('pages.admin.contests.timetable', compact('contest'));
    }

    public function update(Request $request, Contest $contest) {
        $matches = $request->input('matches');

        foreach ($matches as $id => $match) {
            Match::find($id)->update([
                'home_id' => $match['homeTeam'] !== ''? $match['homeTeam'] : null,
                'home_score' => $match['homeScore'] !== ''? $match['homeScore'] : null,
                'away_id' => $match['awayTeam'] !== ''? $match['awayTeam'] : null,
                'away_score' => $match['awayScore'] !== ''? $match['awayScore'] : null,
                'date' => $match['date'] !== ''? $match['date'] : null,
            ]);
        }

        return $request->input('matches');
    }
}
