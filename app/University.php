<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    protected $primaryKey = 'id';


    public function university_programs()
    {
        return $this->hasMany('App\UniversityProgram');
    }
}
