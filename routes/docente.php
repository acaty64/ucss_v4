<?php

use App\Acceso;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Http\Request;

// ROUTES

Route::get('datauser/{id}/edit', [
		'as'	=> 'docente.datauser.edit',
		'uses'	=> 'admin\DataUserController@edit',	
	])->middleware(Authorize::class.':is_docente,'.Acceso::class);

Route::post('datauser/update', [
		'as'	=> 'docente.datauser.update',
		'uses'	=> 'admin\DataUserController@update',	
	])->middleware(Authorize::class.':is_docente,'.Acceso::class);

Route::get('dhora/{dhora}/edit', [
		'as'	=> 'docente.dhora.edit',
		'uses'	=> 'admin\DhoraController@edit',	
	])->middleware(Authorize::class.':is_docente,'.Acceso::class);

Route::get('dcurso/{dcurso}/edit', [
		'as'	=> 'docente.dcurso.edit',
		'uses'	=> 'admin\DcursoController@edit',	
	])->middleware(Authorize::class.':is_docente,'.Acceso::class);
