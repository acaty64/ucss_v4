<?php

use App\Acceso;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Http\Request;

// ROUTES
Route::get('cursogrupo/index/{id}', [
		'as'	=> 'responsable.cursogrupo.index',
		'uses'	=> 'admin\CursoGrupoController@index',	
	])->middleware(Authorize::class.':is_responsable,'.Acceso::class);

Route::get('cursogrupo/edit/{id}', [
		'as'	=> 'responsable.cursogrupo.edit',
		'uses'	=> 'admin\CursoGrupoController@edit',	
	])->middleware(Authorize::class.':is_responsable,'.Acceso::class);

Route::get('datauser/edit/{id}', [
		'as'	=> 'responsable.datauser.edit',
		'uses'	=> 'admin\DataUserController@edit',	
	])->middleware(Authorize::class.':is_responsable,'.Acceso::class);

Route::put('datauser/update', [
		'as'	=> 'responsable.datauser.update',
		'uses'	=> 'admin\DataUserController@update',	
	])->middleware(Authorize::class.':is_responsable,'.Acceso::class);

Route::get('dcurso/edit/{id}', [
		'as'	=> 'responsable.dcurso.edit',
		'uses'	=> 'admin\DcursoController@edit',	
	])->middleware(Authorize::class.':is_responsable,'.Acceso::class);

Route::put('dcurso/update', [
		'as'	=> 'responsable.dcurso.update',
		'uses'	=> 'admin\DcursoController@update',	
	])->middleware(Authorize::class.':is_responsable,'.Acceso::class);

Route::get('dhora/edit/{id}', [
		'as'	=> 'responsable.dhora.edit',
		'uses'	=> 'admin\DHoraController@edit',	
	])->middleware(Authorize::class.':is_responsable,'.Acceso::class);

Route::put('dhora/update', [
		'as'	=> 'responsable.dhora.update',
		'uses'	=> 'admin\DHoraController@update',	
	])->middleware(Authorize::class.':is_responsable,'.Acceso::class);

Route::get('horario/show/{id}', [
		'as'	=> 'responsable.horario.show',
		'uses'	=> 'admin\UserController@show',	
	])->middleware(Authorize::class.':is_responsable,'.Acceso::class);
 
Route::get('grupocurso/index', [
		'as'	=> 'responsable.grupocurso.index',
		'uses'	=> 'admin\GrupoCursoController@index',	
	])->middleware(Authorize::class.':is_responsable,'.Acceso::class);
