<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class VerifyController extends Controller
{
    /*for verifying the user's email*/

    public function verify($token)
    {

        /*where method not working*/

        User::where('token',$token)->firstOrFail()
            ->update(['token' => null]);

        return redirect('/homepage')->with('verificationResponse', 'Account verified || Login to continue');
    }
}
