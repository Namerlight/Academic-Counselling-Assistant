<?php

namespace App\Http\Controllers;

use App\Country;
use App\University;
use Illuminate\Http\Request;

class suggestionController extends Controller
{
    /**
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
            ->with('countryFilter', 'countryFilter');


    }

    function financialCalculator($studyType, $country, $average_fees, $name)
    {
        $flag = 0;
        $totalCost = 0;


        if($country == "don't_mind"){
            $university = University::where('name',$name)->first();
            $country = $university->country;
        }

        $countryObject = Country::where('country', $country)->first();

        if ($average_fees != "Unknown") {
            $value = str_split($average_fees);

            foreach ($value as &$val) {
                if ($val == 'K') {
                    $val = '000';
                }

                if($val == '<'){
                    $flag = 1;
                }

                if($val == ">"){
                    $flag = 2;
                }

            }

            $v = implode($value);

           if($flag == 0){
               $v = explode("-",$v);

               $x = (int)$v[0];
               $y = (int)$v[1];

               $totalCost = ($x+$y)/2;
               $totalCost = $totalCost + $countryObject->average_annual_living_cost;
           }

           else if($flag == 1){
               $v = explode("<",$v);
               $totalCost = $v[1] + $countryObject->average_annual_living_cost;;

           }

           else{
               $v = explode(">",$v);
               $totalCost = $v[1] + $countryObject->average_annual_living_cost;;
           }


        }

        else{
            $totalCost = " -- ";
        }





        return view("pages.financialCalculator")
            ->with('studytype', $studyType)
            ->with('country', $country)
            ->with('average_fees', $average_fees)
            ->with('name', $name)
            ->with('countryObject', $countryObject)
            ->with('totalCost',$totalCost);

    }


}
