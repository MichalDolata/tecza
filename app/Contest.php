<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{
    protected $fillable = ['name', 'number_of_teams', 'revenge'];
}
