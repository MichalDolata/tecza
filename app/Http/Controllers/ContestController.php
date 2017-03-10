<?php

namespace App\Http\Controllers;

use App\Contest;
use App\ContestTable;
use Illuminate\Http\Request;

class ContestController extends Controller
{
    public function index() {
        $contests = Contest::all();
        return view('pages.contests.index', compact('contests'));
    }

    public function show(Contest $contest) {
        $table = new ContestTable($contest->clubs, $contest->matches);

        return view('pages.contests.show', compact('contest', 'table'));
    }
}
