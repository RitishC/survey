<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $table = 'schools';

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
