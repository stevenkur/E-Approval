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

// Auth::routes();

// Route::get('/', function () {
//     // return redirect('login');
//     return view('auth/login');
// });
Route::get('/', ['as'=>'/', 'uses'=>'LoginController@index']);

Route::get('login', ['as'=>'login', 'uses'=>'LoginController@index']);
Route::post('login', ['as'=>'login', 'uses'=>'LoginController@login']);
Route::get('logout', ['as'=>'logout', 'uses'=>'LoginController@logout']);

Route::resource('home', 'HomeController');
Route::any('changearea/{category}', ['as'=>'changearea', 'uses'=>'HomeController@changearea']);

Route::any('newclaim', ['as'=>'newclaim', 'uses'=>'ClaimController@newclaim']);
Route::any('saveclaim', ['as'=>'saveclaim', 'uses'=>'ClaimController@saveclaim']);
Route::any('listclaim', ['as'=>'listclaim', 'uses'=>'ClaimController@listclaim']);
Route::any('updateclaim', ['as'=>'updateclaim', 'uses'=>'ClaimController@updateclaim']);
Route::any('/addcomment/{id_claim}', ['as'=>'addcomment', 'uses'=> 'ClaimController@addcomment']);
Route::any('/editclaim/{id_claim}', ['as'=>'editclaim', 'uses'=> 'ClaimController@editclaim']);
Route::any('/cancelclaim/{id_claim}', ['as'=>'cancelclaim', 'uses'=> 'ClaimController@cancelclaim']);
Route::any('/approveclaim/{id_claim}', ['as'=>'approveclaim', 'uses'=> 'ClaimController@approveclaim']);
Route::any('/marketingapproveclaim/{id_claim}', ['as'=>'marketingapproveclaim', 'uses'=> 'ClaimController@marketingapproveclaim']);
Route::any('/financeapproveclaim/{id_claim}', ['as'=>'financeapproveclaim', 'uses'=> 'ClaimController@financeapproveclaim']);
Route::any('/rejectclaim/{id_claim}', ['as'=>'rejectclaim', 'uses'=> 'ClaimController@rejectclaim']);
Route::any('monitoringreport', ['as'=>'monitoringreport', 'uses'=>'ReportController@monitoringreport']);
Route::any('resolutionreport', ['as'=>'resolutionreport', 'uses'=>'ReportController@resolutionreport']);
Route::any('summaryclaimreport', ['as'=>'summaryclaimreport', 'uses'=>'ReportController@summaryclaimreport']);
Route::any('profile', ['as'=>'profile', 'uses'=>'ProfileController@index']);
Route::any('profilechange', ['as'=>'profilechange', 'uses'=>'ProfileController@changepassword']);

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
Route::any('dashboard', ['as'=>'dashboard', 'uses'=>'AdminController@dashboard']);
Route::any('query', ['as'=>'query', 'uses'=>'AdminController@query']);
Route::any('queryresult', ['as'=>'queryresult', 'uses'=>'AdminController@queryresult']);
Route::any('listticket', ['as'=>'listticket', 'uses'=>'AdminController@listticket']);
Route::any('listattachment', ['as'=>'listattachment', 'uses'=>'AdminController@listattachment']);
Route::any('listperiod', ['as'=>'listperiod', 'uses'=>'AdminController@listperiod']);