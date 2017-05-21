<?php

use App\Acceso;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Http\Request;

// ROUTES

Route::get('consulta/user/index', [
		'as'	=> 'consulta.user.index',
		'uses'	=> 'consulta\UserController@index',	
	])->middleware(Authorize::class.':is_consulta,'.Acceso::class);

