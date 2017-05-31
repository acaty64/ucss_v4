<?php

use App\Acceso;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Http\Request;

// ROUTES

Route::get('user/index', [
		'as'	=> 'consulta.user.index',
		'uses'	=> 'admin\UserController@index',	
	])->middleware(Authorize::class.':is_consulta,'.Acceso::class);

Route::get('user/view', [
		'as'	=> 'consulta.user.view',
		'uses'	=> 'consulta\UserController@view',	
	])->middleware(Authorize::class.':is_consulta,'.Acceso::class);
