<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    //country
    //can create problem as primary key moved from int to string
    protected $primaryKey = 'country';
    public $incrementing = false;



    public function Universities()
    {
        return $this->hasMany('App\University');
    }
}
