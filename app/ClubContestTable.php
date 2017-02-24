<?php

namespace App;

class ClubContestTable {
    public $id = 0;
    public $position = 0;
    public $name = '';
    public $points = 0;
    public $matches = 0;
    public $won = 0;
    public $drawn = 0;
    public $lost = 0;
    public $goalsFor = 0;
    public $goalsAgainst = 0;
    public $goalsDiff = 0;

    function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function addResult($score, $opponentScore) {
        $this->matches++;
        $this->goalsFor += $score;
        $this->goalsAgainst += $opponentScore;
        $this->goalsDiff += $score - $opponentScore;

        if($score > $opponentScore) {
            $this->addWin();
        } else if($score < $opponentScore) {
            $this->addLoss();
        } else {
            $this->addTie();
        }
    }

    private function addWin() {
        $this->points += 2;
        $this->won++;
    }

    private function addTie() {
        $this->points++;
        $this->drawn++;
    }

    private function addLoss() {
        $this->lost++;
    }
}