<?php

Route::get('/home', 'HomeController@index');

Route::post('/home/acceso', [
	'as'	=> 'home.acceso',
	'uses'	=> 'HomeController@acceso',	
]);