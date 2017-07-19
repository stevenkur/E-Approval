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

Auth::routes();

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/query', function () {
    return view('admin/query');
});

Route::get('/masteraccount', function () {
    return view('admin/masteraccount');
});

Route::get('/masterrole', function () {
    return view('admin/masterrole');
});

Route::get('/mastercategory', function () {
    return view('admin/mastercategory');
});

Route::get('/mastercategoryaccess', function () {
    return view('admin/mastercategoryaccess');
});

Route::get('/mastercategorydetail', function () {
    return view('admin/mastercategorydetail');
});

Route::get('/masteractivity', function () {
    return view('admin/masteractivity');
});

Route::get('/masterflow', function () {
    return view('admin/masterflow');
});

Route::get('/masterholiday', function () {
    return view('admin/masterholiday');
});

Route::get('/masteruserdistributor', function () {
    return view('admin/masteruserdistributor');
});

Route::get('/masterdistributor', function () {
    return view('admin/masterdistributor');
});

Route::get('/mastermarketing', function () {
    return view('admin/mastermarketing');
});

Route::get('/masterprogram', function () {
    return view('admin/masterprogram');
});

Route::get('index', 'IndexController@index');

Route::get('/profile', function () {
    return view('user/profile');
});

Route::get('/newclaim', function () {
    return view('user/newclaim');
});

Route::get('/listclaim', function () {
    return view('user/listclaim');
});
