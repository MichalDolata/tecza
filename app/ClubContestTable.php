<?php

namespace App;


class ClubContestTable {
    public $id = 0;
    public $name = '';
    public $position = 0;
    public $mainStats;
    public $subStats;

    function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->mainStats = new ClubContestTableStats();
        $this->subStats = new ClubContestTableStats();
    }
}