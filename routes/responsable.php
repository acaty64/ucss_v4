<?php

use App\Acceso;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Http\Request;

// ROUTES

Route::get('datauser/edit/{id}', [
		'as'	=> 'responsable.datauser.edit',
		'uses'	=> 'admin\DataUserController@edit',	
	])->middleware(Authorize::class.':is_responsable,'.Acceso::class);

Route::post('datauser/update', [
		'as'	=> 'responsable.datauser.update',
		'uses'	=> 'admin\DataUserController@update',	
	])->middleware(Authorize::class.':is_responsable,'.Acceso::class);

Route::get('dhora/{dhora}/edit', [
		'as'	=> 'responsable.dhora.edit',
		'uses'	=> 'admin\DhoraController@edit',	
	])->middleware(Authorize::class.':is_responsable,'.Acceso::class);

Route::get('dcurso/{dcurso}/edit', [
		'as'	=> 'responsable.dcurso.edit',
		'uses'	=> 'admin\DcursoController@edit',	
	])->middleware(Authorize::class.':is_responsable,'.Acceso::class);
