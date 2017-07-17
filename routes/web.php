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
    return view('auth/login');
});

Route::get('/query', function () {
    return view('admin/query');
});

Route::get('/index', function () {
    return view('user/index');
});

Route::get('/profile', function () {
    return view('user/profile');
});

Route::get('/newclaim', function () {
    return view('user/newclaim');
});

Route::get('/listclaim', function () {
    return view('user/listclaim');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
