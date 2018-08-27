<?php

use App\Events\Event;
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

/*
Route::get('/', function () {
    return view('welcome');
});
*/

/* *
 * Here start our work!
 */
Route::get('/', function(){
    return view('clients.pages.home');
});

Route::get('test_event',function(){
    event(new Event('Greetings from PrinceLuo! Time:'.\Carbon\Carbon::now()));
});

Route::get('test_listen',function(){
    return view('listenBroadcast');
});

Route::prefix('clients')->namespace('Clients')->group(function($route){
    $route->get('registration','RegisterController@showRegistrationForm');
    $route->post('registration','RegisterController@register')->name('clients.registration');
    $route->get('login','LoginController@showLoginForm');
    $route->post('login','LoginController@login')->name('clients.login');
    $route->post('logout','LoginController@logout')->name('clients.logout');
    $route->get('dashboard','TaskController@index')->name('clients.dashboard');
    $route->get('auth_test','TaskController@authenticatedPage')->name('clients.auth_test');
    $route->get('download_page','TestFunctionsController@zipDownloadPage')->name('clients.zip_download_page');
    $route->post('download_zipfile','TestFunctionsController@donwloadPDF')->name('clients.zip_download');
    $route->post('simple_download_zipfile','TestFunctionsController@simpleDownloadZip')->name('clients.simple_zip_download');
    $route->get('rank_array','TestFunctionsController@rankArray')->name('clients.rankArray');
});

Route::prefix('staff')->namespace('Staff')->group(function($route){
    $route->get('registration','RegisterController@showRegistrationForm');
    $route->post('registration','RegisterController@register')->name('staff.registration');
    $route->get('login','LoginController@showLoginForm');
    $route->post('login','LoginController@login')->name('staff.login');
    $route->post('logout','LoginController@logout')->name('staff.logout');
    $route->get('dashboard','TaskController@index')->name('staff.dashboard');
    $route->get('createrole','TaskController@newRoleForm');
    $route->post('createrole','TaskController@createRole')->name('staff.createRole');
    $route->get('column1','TaskController@getColumn1')->name('staff.getColumn1');
    $route->get('column2','TaskController@getColumn2')->name('staff.getColumn2');
//    $route->get('getcolumns','TaskController@getColumns')->name('staff.getColumns');
//    $route->get('getoperations','TaskController@getoperations')->name('staff.getOperations');
});