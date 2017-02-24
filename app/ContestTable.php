<?php

namespace App;

class ContestTable
{
    protected $clubList = [];
    protected $matches;

    function __construct($clubs, $matches) {
        foreach ($clubs as $club) {
            $this->clubList[$club->id] = new ClubContestTable($club->id, $club->name);
        }
        $this->matches = $matches;

        $this->generate();
        $this->sortTable();
    }

    public function getClub($id) {
        return $this->clubList[$id];
    }

    public function getClubs() {
        return $this->clubList;
    }

    protected function generate() {
        foreach ($this->matches as $match) {
            $homeId = $match->home_id; $awayId = $match->away_id;
            $homeScore = $match->home_score; $awayScore = $match->away_score;
            if(isset($homeId) && isset($awayId) && isset($homeScore) && isset($awayScore)) {
                $this->getClub($homeId)->addResult($homeScore, $awayScore);
                $this->getClub($awayId)->addResult($awayScore, $homeScore);
            }
        }
    }

    protected function sortTable() {
        $clubsByPoints = [];
        foreach ($this->clubList as $club) {
            $clubsByPoints[$club->points][] = $club;
        }

        krsort($clubsByPoints);

        foreach ($clubsByPoints as $group) {
            if(count($group) > 1) {
                $teamsIds = array_reduce($group, function($carry, $item) {
                    $carry[] = $item->id;
                    return $carry;
                }, []);

                $matches = $this->matches->whereIn('home_id', $teamsIds)->whereIn('away_id', $teamsIds);
                $tieTable = new TieContestTable($group, $matches);
            }
        }


        $currentPosition = 1;
        foreach ($clubsByPoints as $group) {
            foreach ($group as $club) {
                $club->position = $currentPosition;
            }
            $currentPosition += count($group);
        }

        $this->clubList = array_reduce($clubsByPoints, "array_merge", []);
    }


}

class TieContestTable extends ContestTable {
    function __construct($clubs, $matches)
    {
        parent::__construct($clubs, $matches);
    }

    private function sort($a, $b) {
        $result = $this->sortBy($a, $b, 'points');
        if($result) return $result;

        $result = $this->sortBy($a, $b, 'goalsDiff');
        if($result) return $result;

        $result = $this->sortBy($a, $b, 'goalsFor');
        if($result) return $result;
    }

    private function sortBy($a, $b, $criterion) {
        if($a->$criterion < $b->$criterion) {
            return 1;
        } else if($a->$criterion > $b->$criterion) {
            return -1;
        } else {
            return 0;
        }
    }

    protected function sortTable() {
        usort($this->clubList, 'self::sort');
    }
}