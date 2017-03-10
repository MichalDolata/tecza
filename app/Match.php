<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    protected $fillable = ['home_id', 'home_score', 'away_id', 'away_score', 'date'];

    public $timestamps = false;

    public function contest() {
        return $this->belongsTo('App\Contest');
    }

    public function homeClub() {
        return $this->belongsTo('App\Club', 'home_id');
    }

    public function awayClub() {
        return $this->belongsTo('App\Club', 'away_id');
    }
}
