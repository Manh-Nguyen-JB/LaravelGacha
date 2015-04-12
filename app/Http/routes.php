<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function(){
	$request = Request::create('/home', 'GET');
	return Auth::guest() ? (String) view('app') : Route::dispatch($request)->getContent();
});

Route::get('home', 'HomeController@index');
Route::get('gacha/draw/{id}', 'HomeController@draw');

Route::get('navi-bar', function(){
	return (String) view('navi');
});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
