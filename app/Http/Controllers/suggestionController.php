<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class suggestionController extends Controller
{
    function suggestion(Request $request,$studyType,$country)
    {
        $subject = $request->input('subject');
       echo $studyType."<br>";
       echo $country."<br>";
       echo $subject;
    }
}
