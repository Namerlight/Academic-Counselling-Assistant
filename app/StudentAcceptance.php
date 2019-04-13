<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentAcceptance extends Model
{
    protected $table = 'student_acceptance';
    protected $primaryKey = 'acceptance_id';
    public $timestamps = false;


}
