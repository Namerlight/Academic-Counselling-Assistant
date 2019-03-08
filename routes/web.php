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