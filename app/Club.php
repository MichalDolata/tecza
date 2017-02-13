<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    protected $fillable = ['name'];

    public function contests() {
        return $this->belongsToMany('App\Contest');
    }
}
