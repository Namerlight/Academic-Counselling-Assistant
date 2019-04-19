<?php

namespace App\Http\Controllers;

use App\Country;
use App\Student;
use App\University;
use App\UniversityProgram;
use App\User;
use Illuminate\Http\Request;

class suggestionController extends Controller
{
    /**
     * For suggestion with user preference
     * country suggestion
     * financial calculator
     * auto suggestion
     * University Profile
     */


    /**
     * @param Request $request
     * @param $studyType
     * @param $country
     * @return mixed
     */

    function suggestion(Request $request, $studyType, $country)
    {
        $subject = $request->input('subject');

        $customSubject = substr($subject, 0, 5);

        $flag = 0;


        $universitySubjectFiltered = UniversityProgram::where('program_name', 'LIKE', "%{$customSubject}%")->get();

        echo "focused part" . "<br>";


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
            ->with('studyType', $studyType)
            ->with('universitySubjectFiltered', $universitySubjectFiltered)
            ->with('flag', $flag);

    }

    /**
     * @param Request $request
     * @return mixed
     */

    function suggestionCountry(Request $request)
    {
        $country = $request->input('country');

        $university = University::where('country', $country)->get();
        $subject = null;
        $studyType = null;

        return view("pages.suggestionLandingPageForCountry")
            ->with('university', $university)
            ->with('subject', $subject)
            ->with('country', $country)
            ->with('studyType', $studyType)
            ->with('countryFilter', 'countryFilter');


    }

    /**
     * @param $studyType
     * @param $country
     * @param $average_fees
     * @param $name
     * @return mixed
     */

    function financialCalculator($studyType, $country, $average_fees, $name)
    {
        $flag = 0;
        $totalCost = 0;


        if ($country == "don't_mind") {
            $university = University::where('name', $name)->first();
            $country = $university->country;
        }

        $countryObject = Country::where('country', $country)->first();

        if ($average_fees != "Unknown") {
            $value = str_split($average_fees);

            foreach ($value as &$val) {
                if ($val == 'K') {
                    $val = '000';
                }

                if ($val == '<') {
                    $flag = 1;
                }

                if ($val == ">") {
                    $flag = 2;
                }

            }

            $v = implode($value);

            if ($flag == 0) {
                $v = explode("-", $v);

                $x = (int)$v[0];
                $y = (int)$v[1];

                $totalCost = ($x + $y) / 2;
                $totalCost = $totalCost + $countryObject->average_annual_living_cost;
            } else if ($flag == 1) {
                $v = explode("<", $v);
                $totalCost = $v[1] + $countryObject->average_annual_living_cost;;

            } else {
                $v = explode(">", $v);
                $totalCost = $v[1] + $countryObject->average_annual_living_cost;;
            }


        } else {
            $totalCost = " -- ";
        }


        return view("pages.financialCalculator")
            ->with('studytype', $studyType)
            ->with('country', $country)
            ->with('average_fees', $average_fees)
            ->with('name', $name)
            ->with('countryObject', $countryObject)
            ->with('totalCost', $totalCost);

    }



    /**
     * university profile search
     */

    function universityProfile(Request $request)
    {
        $universityName = $request->input('university');
        $university = University::where('name', $universityName)->first();

        if ($university) {

        } else {
            $university = "null";
        }

        return view("pages.universityProfile")->with('university', $university);

    }

    /**
     * @param $uni
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * this method is for directly getting the university prorfile direct
     * from auto suggestion page
     */

    function universityProfileDirectLink($uni)
    {
        $universityName = substr($uni,1,strlen($uni));
        $university = University::where('name', $universityName)->first();

        if ($university) {

        } else {
            $university = "null";
        }

        return view("pages.universityProfile")->with('university', $university)->with('From_AI','From_AI');

    }

    /**
     * for ai implementation
     * auto-suggestion part
     */
    function ai($username)
    {
        $py = "E:/Python37-32/python.exe";
        $script = "C:/xampp/htdocs/ACADEMIC_COUNSELLING_ASSISTANT/webcrawler/ai.py";

        $result = shell_exec("$py $script $username" );

        $university = explode("*",$result);

        array_splice($university, 0, 1);
        return view("pages.aiSuggestion")->with('university',$university);

    }


}
