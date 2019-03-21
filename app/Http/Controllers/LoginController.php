<?php

namespace App\Http\Controllers;

use App\Student;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    function checkLogin(Request $request)
    {

        /*Validation is not working need to change

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|mid:6'
        ]);

        */

        $email = $request->get('email');

        $userData = array(
            'email' => $request->get('email'),
            'password' => $request->get('password')
        );

        if (Auth::attempt($userData)) {
            return redirect('Login/successLogin');
        } else {
            return back()->with('error', 'Wrong Login Details');
        }

    }

    function successLogin()
    {
        $username = auth()->user()->username;

        $user = User::where('username',$username) -> first();
        $students = Student::find($username);

        return view('pages.homepage')->with('students',$students)->with('user',$user);
    }

    function logout()
    {
        Auth::logout();
        return redirect('/index');
    }

}
