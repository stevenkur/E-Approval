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

Route::get('/lsfbudgetreport', function () {
    return view('user/lsfbudgetreport');
});

Route::get('/monitoringreport', function () {
    return view('user/monitoringreport');
});

Route::get('/resolutionreport', function () {
    return view('user/resolutionreport');
});

Route::resource('masteraccount', 'AccountController');
Route::resource('masterrole', 'RoleController');
Route::resource('mastercategory', 'CategoryController');
Route::resource('mastercategoryaccess', 'CategoryAccessController');
Route::resource('mastercategorydetail', 'CategoryDetailController');
Route::resource('masteractivity', 'ActivityController');
Route::resource('masterflow', 'FlowController');
Route::resource('masterholiday', 'HolidayController');
Route::resource('masteruserdistributor', 'UserDistributorController');
Route::resource('masterdistributor', 'DistributorController');
Route::resource('mastermarketing', 'MarketingController');
Route::resource('masterprogram', 'ProgramController');
Route::resource('masterperiod', 'PeriodController');
Route::any('query', ['as'=>'query', 'uses'=>'AdminController@query']);
Route::any('queryresult', ['as'=>'queryresult', 'uses'=>'AdminController@queryresult']);
Route::any('listticket', ['as'=>'listticket', 'uses'=>'AdminController@listticket']);
Route::any('listattachment', ['as'=>'listattachment', 'uses'=>'AdminController@listattachment']);
Route::any('listperiod', ['as'=>'listperiod', 'uses'=>'AdminController@listperiod']);