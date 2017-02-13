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

}
