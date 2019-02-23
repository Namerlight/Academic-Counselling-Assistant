<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UniversityProgram extends Model
{
    //as id is the foreign key and can appear multiple times
    public $incrementing=false;
}
