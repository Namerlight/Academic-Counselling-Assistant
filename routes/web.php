<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
   return view('pages.index');

});

/**
 * index page
 */

Route::get('/index', function () {
    return view('pages.index');
});

Route::get('/temp', function () {
    return view('pages.temporary');
});

Route::get('/temp2', function () {
    return view('pages.temp2');
});

Route::get('/temp3', function () {
    return view('pages.temp3');
});

Route::get('/register', function () {
    return view('pages.register');
});

Route::get('/homepage', function () {
    return view('pages.homepage');
});

/**
 * profile view
 */
Route::get('/profile','LoginController@profile');

/**
 * for registering new input
 */

Route::post('reg', 'RegistrationController@register');

/**
 * For Login
 */
Route::post('/Login/checkLogin', 'LoginController@checkLogin');
Route::get('Login/successLogin','LoginController@successLogin');
Route::get('Login/logout','LoginController@logout');


Route::get('/verify/{token}','VerifyController@verify')->name('verify');

/**
 * updating user profile
 */

Route::get('/profile/{username}','LoginController@updateView');

/**
 * updating profile
 */

Route::post('/profile/{username}/update',['uses' =>'LoginController@update']);

/**
 * for google authentication
 */

Route::get('login/google', 'LoginController@redirectToProvider');
Route::get('login/google/callback', 'LoginController@handleProviderCallback');



/**
 * course matching tool
 */
Route::get('/courseMatching', function () {
    return view('pages.courseMatchingLandingPage');
});

Route::get('/courseMatching/{studyType}', function () {
    return view('pages.courseMatchingCountryPage');
});

Route::get('/courseMatching/{studyType}/{country}', function () {
    return view('pages.courseMatchingSubjectPage');
});

/**
 * for financial calculator Go back button
 */
Route::get('/courseMatching/{studyType}/{country}/{subject}', function () {
         /*return view(pages.suggestionLandingPage);*/
});


Route::post('/courseMatching/{studyType}/{country}/subject',['uses' =>'suggestionController@suggestion']);

/**
 * financial calculator
 */
Route::get('/courseMatching/{studyType}/{country}/subject/{average_fees}/{name}', 'suggestionController@financialCalculator');


/**
 * country matching
 */
Route::get('/countryMatching', function () {
    return view('pages.countryMatchingLandingPage');
});

Route::post('/countryMatching/country',['uses' =>'suggestionController@suggestionCountry']);

Route::get('/suggestionLandingPage', function () {
    return view('pages.suggestionLandingPage');
});


/**
 * Auto suggestion part
 */

Route::get('autosuggestion/{name}', 'suggestionController@autoSuggestion');


/**
 * University Profile search
 */

Route::get('/universitySearch', function () {
    return view('pages.universitySearch');
});

Route::post('/universitySearch/universityProfile',['uses' =>'suggestionController@universityProfile']);


/**
 * py to php
 */
Route::get('/python', 'suggestionController@python');

/**
 * help us !!
 * for improving our database
 * for enriching data for AI algorithm
 */

Route::get('{username}/helpUs', function () {
    return view('pages.helpUs');
});

Route::post('{username}/helpUs/studentAcceptance',['uses' =>'RegistrationController@studentAcceptance']);


