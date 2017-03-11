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

        $this->generate('mainStats', $this->matches);
        $this->sortTable();
    }

    public function getClub($id) {
        return $this->clubList[$id];
    }

    public function getClubs() {
        return $this->clubList;
    }

    protected function generate($type, $matches) {
        foreach ($matches as $match) {
            $homeId = $match->home_id; $awayId = $match->away_id;
            $homeScore = $match->home_score; $awayScore = $match->away_score;
            if(isset($homeId) && isset($awayId) && isset($homeScore) && isset($awayScore)) {
                $this->getClub($homeId)->$type->addResult($homeScore, $awayScore);
                $this->getClub($awayId)->$type->addResult($awayScore, $homeScore);
            }
        }
    }

    protected function sortTable() {
        $clubsByPoints = [];
        foreach ($this->clubList as $club) {
            $clubsByPoints[$club->mainStats->points][] = $club;
        }

        krsort($clubsByPoints);

        $currentPosition = 1;
        foreach ($clubsByPoints as $group) {
            if(count($group) > 1) {
                $teamsIds = array_reduce($group, function($carry, $item) {
                    $carry[] = $item->id;
                    return $carry;
                }, []);
                $matches = $this->matches->whereIn('home_id', $teamsIds)->whereIn('away_id', $teamsIds);
                $this->generate('subStats', $matches);
                usort($group, 'self::sort');

                foreach ($group as $club) {
                    $club->position = $currentPosition++;
                }
            } else {
                $group[0]->position = $currentPosition++;
            }
        }

        $this->clubList = array_reduce($clubsByPoints, "array_merge", []);
        usort($this->clubList, "self::sortBy");
    }

    private function sort($a, $b) {
        $result = $this->sortBy($a->subStats, $b->subStats, 'points', 1);
        if($result) return $result;

        $result = $this->sortBy($a->subStats, $b->subStats, 'goalsDiff', 1);
        if($result) return $result;

        $result = $this->sortBy($a->subStats, $b->subStats, 'goalsFor', 1);
        if($result) return $result;

        $result = $this->sortBy($a->mainStats, $b->mainStats, 'goalsDiff', 1);
        if($result) return $result;

        $result = $this->sortBy($a->mainStats, $b->mainStats, 'goalsFor', 1);
        if($result) return $result;
    }

    private function sortBy($a, $b, $criterion = 'position', $order = -1) {
        if($a->$criterion < $b->$criterion) {
            return 1 * $order;
        } else if($a->$criterion > $b->$criterion) {
            return -1 * $order;
        } else {
            return 0;
        }
    }
}

/*class TieContestTable extends ContestTable {
    protected $clubStatsList = [];

    function __construct($clubs, $matches)
    {
        parent::__construct($clubs, $matches);
        foreach ($clubs as $club) {
            $this->clubStatsList[$club->id] = $club;
        }
    }



    protected function sortTable() {
        usort($this->clubList, 'self::sort');
    }
}*/