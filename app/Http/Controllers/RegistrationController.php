<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Http\Request;
use App\User;
use App\Student;
use App\Competitive_Entrance_Exams;
use Illuminate\Support\Facades\Hash;



class RegistrationController extends Controller
{

    public function register(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'username' => 'required|min:6|unique:users',
            'email' => 'required|email|unique:users',
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

        $user = new User();
        $student = new Student();
        $cExam = new Competitive_Entrance_Exams();

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->username = $request->input('username');

        /*for password hashing*/
        $temp = $request->input('pass');
        $hashedPassword = Hash::make($temp);
        $user->password = $hashedPassword;

        $user->token = str_random(25);

        $student->username = $request->input('username');
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

        $cExam->username = $request->input('username');
        $cExam->ielts = $request->input('ielts');
        $cExam->sat = $request->input('sat');
        $cExam->gre = $request->input('gre');
        $cExam->toefl = $request->input('toefl');
        $cExam->gmat = $request->input('gmat');



        $user->save();
        $student->save();
        $cExam->save();

        $user->sendVerificationEmail();

        return redirect('/index')->with('verificationResponse', 'Registration Successful || Please Verify your email and login to continue');
        /*Registration Successful || Please Verify your email and login to continue*/
    }
}
