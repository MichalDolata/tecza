<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contest;
use App\ContestTable;
use App\ClubContestTable;


class TableController extends Controller
{
    public function show(Contest $contest) {
        $table = new ContestTable($contest->clubs, $contest->matches);

        return view('pages.contests.show', compact('contest', 'table'));
    }
}