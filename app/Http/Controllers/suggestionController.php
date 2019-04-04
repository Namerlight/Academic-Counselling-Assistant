<?php

namespace App\Http\Controllers;

use App\University;
use Illuminate\Http\Request;

class suggestionController extends Controller
{
    /*
     * For suggestion
     * country suggestion
     * financial calculator
     */

    function suggestion(Request $request, $studyType, $country)
    {
        $subject = $request->input('subject');

        if ($country != "don't_mind") {
            $university = University::where('country', $country)->get();
        } else {
            $university = University::all();
            $country = "NULL";
        }


        return view("pages.suggestionLandingPage")
            ->with('university', $university)
            ->with('subject', $subject)
            ->with('country', $country)
            ->with('studyType', $studyType);

    }

    function suggestionCountry(Request $request)
    {
        $country = $request->input('country');

        $university = University::where('country', $country)->get();
        $subject = null;
        $studyType = null;

        return view("pages.suggestionLandingPage")
            ->with('university', $university)
            ->with('subject', $subject)
            ->with('country', $country)
            ->with('studyType', $studyType)
            ->with('countryFilter','countryFilter');


    }

    function financialCalculator($studyType, $country, $average_fees)
    {
        echo $studyType;
        echo $country;
        echo $average_fees;
        echo "<br>";

        return view("pages.financialCalculator");
    }

}
