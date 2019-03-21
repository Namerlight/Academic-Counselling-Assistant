<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\VerifyEmail;
use phpDocumentor\Reflection\Types\This;

class User extends Authenticatable
{


    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * returns true if user is verified
     * @return bool
     *
     */

    public function verified()
    {
        return $this->token === null;
    }

    /**
     * send the user verification email
     */

    public function sendVerificationEmail()
    {
        $this->notify(new VerifyEmail($this));
    }


    public function students()
    {
        return $this->hasOne('App\Student');
    }

}
