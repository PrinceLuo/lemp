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
Route::prefix('clients')->namespace('Clients')->group(function($route){
    $route->get('registration','RegisterController@showRegistrationForm');
    $route->post('registration','RegisterController@register')->name('clients.registration');
    $route->get('login','LoginController@showLoginForm');
    $route->post('login','LoginController@login')->name('clients.login');
    $route->post('logout','LoginController@logout')->name('clients.logout');
    $route->get('dashboard','TaskController@index')->name('clients.dashboard');
    $route->get('auth_test','TaskController@authenticatedPage')->name('clients.auth_test');
});
