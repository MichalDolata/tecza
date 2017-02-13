<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{
    protected $fillable = ['name', 'number_of_teams', 'revenge'];

    public function clubs() {
        return $this->belongsToMany('App\Club');
    }

    public function matches() {
        return $this->hasMany('App\Match');
    }

    public function createTimetableStructure($numberOfRounds, $matchesPerRound) {
        $list = [];
        for($i = 1; $i <= $numberOfRounds; $i++) {
            for($j = 0; $j < $matchesPerRound; $j++) {
                $match = [
                    'contest_id' => $this->id,
                    'round' => $i
                ];
                array_push($list, $match);
            }
        }
        Match::insert($list);
    }
}
