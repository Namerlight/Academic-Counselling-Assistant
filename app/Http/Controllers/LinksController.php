<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LinksController extends Controller
{
    /**
     * All the important links
     * how to apply
     */

    /**
     * links dashboard
     */
    public function importantLinks(){
        return view('pages.links');
    }

    /**
     * how to apply
     */

    public function howToApply(){
        return view('pages.howToApply');
    }
}
