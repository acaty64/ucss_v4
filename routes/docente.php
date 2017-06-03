<?php

use App\Acceso;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Http\Request;

// ROUTES

Route::get('datauser/edit/{id}', [
		'as'	=> 'docente.datauser.edit',
		'uses'	=> 'admin\DataUserController@edit',	
	])->middleware(Authorize::class.':is_docente,'.Acceso::class);

Route::put('datauser/update', [
		'as'	=> 'docente.datauser.update',
		'uses'	=> 'admin\DataUserController@update',	
	])->middleware(Authorize::class.':is_docente,'.Acceso::class);

Route::get('dhora/edit/{id}', [
		'as'	=> 'docente.dhora.edit',
		'uses'	=> 'admin\DHoraController@edit',	
	])->middleware(Authorize::class.':is_docente,'.Acceso::class);

Route::put('dhora/update', [
		'as'	=> 'docente.dhora.update',
		'uses'	=> 'admin\DHoraController@update',	
	])->middleware(Authorize::class.':is_docente,'.Acceso::class);

Route::get('dcurso/edit/{id}', [
		'as'	=> 'docente.dcurso.edit',
		'uses'	=> 'admin\DcursoController@edit',	
	])->middleware(Authorize::class.':is_docente,'.Acceso::class);

Route::put('dcurso/update', [
		'as'	=> 'docente.dcurso.update',
		'uses'	=> 'admin\DcursoController@update',	
	])->middleware(Authorize::class.':is_docente,'.Acceso::class);

Route::get('horario/show/{id}', [
		'as'	=> 'docente.horario.show',
		'uses'	=> 'admin\UserController@show',	
	])->middleware(Authorize::class.':is_docente,'.Acceso::class);
