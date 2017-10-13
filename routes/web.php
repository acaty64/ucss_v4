<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
    return view('auth.login');
    //return view('welcome');
});

Auth::routes();

Route::get('/home', [
	'as'	=> 'home',
	'uses'	=> 'HomeController@index']);

Route::post('/home/acceso', [
	'as'	=> 'home.acceso',
	'uses'	=> 'HomeController@acceso',	
]);

Route::get('/prueba1',function(){
	dd(Session::all());
});

Route::get('/prueba2',function(){
	dd(Auth::user());
});
