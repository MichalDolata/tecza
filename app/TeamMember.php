<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'date_of_birth'
    ];

    public function setDateOfBirthAttribute($value) {
        $this->attributes['date_of_birth'] = $value !== '' ? $value: null;
    }

}
