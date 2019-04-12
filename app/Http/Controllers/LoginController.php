<?php

namespace App\Http\Controllers;

use App\Competitive_Entrance_Exams;
use App\Student;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;


use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /**
     * this controller contains
     * login things
     * profile view
     * update the profile
     */

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

        $user = User::where('username', $username)->first();
        $students = Student::find($username);

        return view('pages.homepage')->with('students', $students)->with('user', $user);
    }

    // profile view

    function profile()
    {
        $username = auth()->user()->username;

        $user = User::where('username', $username)->first();
        $student = Student::find($username);
        $exams = Competitive_Entrance_Exams::find($username);


        return view('pages.profile')->with('student', $student)->with('user', $user)->with('exams', $exams);
    }

    function updateView()
    {
        $username = auth()->user()->username;

        $user = User::where('username', $username)->first();
        $student = Student::find($username);
        $exams = Competitive_Entrance_Exams::find($username);


        return view('pages.updateProfile')->with('student', $student)->with('user', $user)->with('exams', $exams);
    }

    public function update(Request $request, $username)
    {

        $this->validate($request, [
            'name' => 'required',
            'pass' => 'required|min:6',
            'cpass' => 'required_with:pass|same:pass|min:6',
            'college' => 'required',
            'college_group' => 'required',
            'hsc' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'university' => 'required',
            'bsSubject' => 'required',
            'credits' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'cgpa' => 'required|regex:/^\d+(\.\d{1,2})?$/'
        ]);


        $user = User::where('username', $username)->first();
        $student = Student::find($username);
        $cExam = Competitive_Entrance_Exams::find($username);

        $email = $user->email;

        $user->name = $request->input('name');

        $user->email = $email;
        $user->username = $username;

        /*for password hashing*/
        $temp = $request->input('pass');
        $hashedPassword = Hash::make($temp);
        $user->password = $hashedPassword;


        $student->username = $username;
        $student->school_name = $request->input('school');
        $student->college_name = $request->input('college');
        $student->college_group = $request->input('college_group');
        $student->university = $request->input('university');
        $student->ssc_o_level = $request->input('ssc');
        $student->hsc_a_level = $request->input('hsc');
        $student->bachelor_subject = $request->input('bsSubject');
        $student->bachelor_credit = $request->input('credits');
        $student->cgpa_bachelor = $request->input('cgpa');
        $student->others = $request->input('others');

        $cExam->username = $username;
        $cExam->ielts = $request->input('ielts');
        $cExam->sat = $request->input('sat');
        $cExam->gre = $request->input('gre');
        $cExam->toefl = $request->input('toefl');
        $cExam->gmat = $request->input('gmat');


        /**
         * for academic point
         */

        $bachelorCGPA = $student->cgpa_bachelor;
        $ielts = $cExam->ielts;
        $sat = $cExam->sat;
        $gre = $cExam->gre;
        $toefl = $cExam->toefl;
        $gmat = $cExam->gmat;

        $student->academic_point = ($bachelorCGPA*100) + ($ielts*10) + ($gre) + ($sat) + ($toefl) + ($gmat);


        $user->save();
        $student->save();
        $cExam->save();


        return redirect('/index')->with('verificationResponse', 'Profile updated');


    }


    function logout()
    {
        Auth::logout();
        return redirect('/index');
    }


    /**
     * For google verification
     */

    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();

        $existOrNot = User::where('email', $user->email)->first();

        if ($existOrNot) {
            return redirect('/index')->with('user', $user);
        } else {
            return redirect('/register')->with('user', $user);
        }

        //return redirect()->back()->with('user', $user);

    }

    public function pythonReader()
    {

        $pythonInt = "C:\Users\Computer Mania\AppData\Local\Programs\Python\Python37-32\python.exe";
        $pyFile = "\webcrawler\temp.py";

        $string = "";

        echo "Himel";

        $output = shell_exec('ls -lart');
        echo "<pre>$output</pre>";

        echo "Himel";

    }

}
