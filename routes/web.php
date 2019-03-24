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
    return view('welcome');
});


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

Route::get('/profile','LoginController@profile');

/*for registering new input*/

Route::post('reg', 'RegistrationController@register');

/*For Login*/
Route::post('/Login/checkLogin', 'LoginController@checkLogin');
Route::get('Login/successLogin','LoginController@successLogin');
Route::get('Login/logout','LoginController@logout');


Route::get('/verify/{token}','VerifyController@verify')->name('verify');

/*updating user profile*/

Route::get('/profile/{username}','LoginController@updateView');

/*updating profile*/
Route::post('/profile/{username}/update',['uses' =>'LoginController@update']);

/*for google authentication*/

Route::get('login/google', 'LoginController@redirectToProvider');
Route::get('login/google/callback', 'LoginController@handleProviderCallback');