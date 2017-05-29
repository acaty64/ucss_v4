<?php

use App\Acceso;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Http\Request;

// ROUTES

Route::get('user/index',  [
		'as'	=> 'administrador.user.index',
		'uses'	=> 'admin\UserController@index',	
	])->middleware('can:is_admin,'.Acceso::class);

Route::get('grupos/index',  [
		'as'	=> 'administrador.grupo.index',
		'uses'	=> 'admin\GrupoController@index',	
	])->middleware('can:is_admin,'.Acceso::class);

Route::get('usergrupos/index',  [
		'as'	=> 'administrador.usergrupo.index',
		'uses'	=> 'admin\UserGrupoController@index',	
	])->middleware('can:is_admin,'.Acceso::class);

Route::get('dhoras/lista',  [
		'as'	=> 'administrador.dhora.lista',
		'uses'	=> 'admin\DHorasController@lista',	
	])->middleware('can:is_admin,'.Acceso::class);

Route::get('dcursos/lista',  [
		'as'	=> 'administrador.dcurso.lista',
		'uses'	=> 'admin\DCursoController@lista',	
	])->middleware('can:is_admin,'.Acceso::class);

Route::get('menvios/index',  [
		'as'	=> 'administrador.menvio.index',
		'uses'	=> 'admin\MEnvioController@index',	
	])->middleware('can:is_admin,'.Acceso::class);

Route::get('user/create', [
		'as'	=> 'admin.user.create',
		'uses'	=> 'admin\UserController@create',	
	])->middleware(Authorize::class.':is_admin,'.Acceso::class);

Route::post('user/store', [
		'as'	=> 'admin.user.store',
		'uses'	=> 'admin\UserController@store',	
	])->middleware(Authorize::class.':is_admin,'.Acceso::class);

Route::get('user/edit/{user_id}', [
		'as'	=> 'admin.user.edit',
		'uses'	=> 'admin\UserController@edit',	
	])->middleware(Authorize::class.':is_admin,'.Acceso::class);

Route::put('user/update', [
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

Route::put('datauser/update', [
		'as'	=> 'admin.datauser.update',
		'uses'	=> 'admin\DataUserController@update',	
	])->middleware(Authorize::class.':is_admin,'.Acceso::class);

Route::get('dhora/edit/{id}',[
		'as'	=> 'admin.dhora.edit',
		'uses'	=> 'admin\DHoraController@edit'
	])->middleware(Authorize::class.':is_admin,'.Acceso::class);

Route::post('dhora/update',[
		'as'	=> 'admin.dhora.update',
		'uses'	=> 'admin\DHoraController@update'
	])->middleware(Authorize::class.':is_admin,'.Acceso::class);

Route::get('dcurso/edit/{id}', [
		'as'	=> 'admin.dcurso.edit',
		'uses'	=> 'admin\DcursoController@edit',	
	])->middleware(Authorize::class.':is_admin,'.Acceso::class);

Route::post('dcurso/update', [
		'as'	=> 'admin.dcurso.update',
		'uses'	=> 'admin\DcursoController@update',	
	])->middleware(Authorize::class.':is_admin,'.Acceso::class);

Route::get('user/editpass/{id}', [
		'as'	=> 'admin.user.editpass',
		'uses'	=> 'admin\UserController@editpass',	
	])->middleware(Authorize::class.':is_admin,'.Acceso::class);

Route::put('PDF/silaboCurso', [
		'as'	=> 'admin.PDF.silaboCurso',
		'uses'	=> 'admin\PDFController@silaboCurso',	
	])->middleware(Authorize::class.':is_admin,'.Acceso::class);
