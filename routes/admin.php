<?php

use App\Acceso;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Http\Request;

// ROUTES

Route::get('user/index',  [
		'as'	=> 'admin.user.index',
		'uses'	=> 'admin\UserController@index',	
	])->middleware('can:is_admin,'.Acceso::class);

Route::get('user/create', [
		'as'	=> 'admin.user.create',
		'uses'	=> 'admin\UserController@create',	
	])->middleware(Authorize::class.':is_admin,'.Acceso::class);

Route::post('user/store', [
		'as'	=> 'admin.user.store',
		'uses'	=> 'admin\UserController@store',	
	])->middleware(Authorize::class.':is_admin,'.Acceso::class);

Route::get('user/{user}/edit', [
		'as'	=> 'admin.user.edit',
		'uses'	=> 'admin\UserController@edit',	
	])->middleware(Authorize::class.':is_admin,'.Acceso::class);

Route::post('user/update', [
		'as'	=> 'admin.user.update',
		'uses'	=> 'admin\userController@update',	
	])->middleware(Authorize::class.':is_admin,'.Acceso::class);

Route::get('user/{user}/show', [
		'as'	=> 'admin.user.show',
		'uses'	=> 'admin\UserController@show',	
	])->middleware(Authorize::class.':is_admin,'.Acceso::class);

Route::get('user/{id}/destroy', [
		'as'	=> 'admin.user.destroy',
		'uses'	=> 'admin\UserController@destroy',	
	])->middleware(Authorize::class.':is_admin,'.Acceso::class);

Route::get('datauser/edit/{id}', [
		'as'	=> 'admin.datauser.edit',
		'uses'	=> 'admin\DataUserController@edit',	
	])->middleware(Authorize::class.':is_admin,'.Acceso::class);

Route::post('datauser/update', [
		'as'	=> 'admin.datauser.update',
		'uses'	=> 'admin\DataUserController@update',	
	])->middleware(Authorize::class.':is_admin,'.Acceso::class);

Route::get('dhora/{dhora}/edit', [
		'as'	=> 'admin.dhora.edit',
		'uses'	=> 'admin\DhoraController@edit',	
	])->middleware(Authorize::class.':is_admin,'.Acceso::class);

Route::get('dcurso/{dcurso}/edit', [
		'as'	=> 'admin.dcurso.edit',
		'uses'	=> 'admin\DcursoController@edit',	
	])->middleware(Authorize::class.':is_admin,'.Acceso::class);
