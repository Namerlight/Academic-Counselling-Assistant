<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //primary key
    protected $primaryKey = 'username';

    public function user(){
        return $this->belongsTo('App\User','username');
    }
}
