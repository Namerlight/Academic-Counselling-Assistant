<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competitive_Entrance_Exams extends Model
{
    public $table = 'competitive_entrance_exams';
    protected $primaryKey = 'username';

    public function students(){
        return $this->belongsTo('App\Student','username');
    }
}
