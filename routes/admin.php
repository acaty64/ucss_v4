<?php

use App\Acceso;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Http\Request;

// ROUTES

/** USER ********************************************/
Route::get('user/index',  [
		'as'	=> 'administrador.user.index',
		'uses'	=> 'admin\UserController@index',	
	])->middleware('can:is_admin,'.Acceso::class);

Route::get('user/create', [
		'as'	=> 'admin.user.create',
		'uses'	=> 'admin\UserController@create',	
	])->middleware('can:is_admin,'.Acceso::class);

Route::post('user/store', [
		'as'	=> 'admin.user.store',
		'uses'	=> 'admin\UserController@store',	
	])->middleware('can:is_admin,'.Acceso::class);

Route::get('user/edit/{user_id}', [
		'as'	=> 'admin.user.edit',
		'uses'	=> 'admin\UserController@edit',	
	])->middleware('can:is_admin,'.Acceso::class);

Route::put('user/update', [
		'as'	=> 'admin.user.update',
		'uses'	=> 'admin\userController@update',	
	])->middleware('can:is_admin,'.Acceso::class);

Route::get('user/{user}/show', [
		'as'	=> 'admin.user.show',
		'uses'	=> 'admin\UserController@show',	
	])->middleware('can:is_admin,'.Acceso::class);

Route::get('user/{id}/destroy', [
		'as'	=> 'admin.user.destroy',
		'uses'	=> 'admin\UserController@destroy',	
	])->middleware(Authorize::class.':is_admin,'.Acceso::class);

Route::get('user/editpass/{id}', [
		'as'	=> 'admin.user.editpass',
		'uses'	=> 'admin\UserController@editpass',	
	])->middleware(Authorize::class.':is_admin,'.Acceso::class);

/** DATAUSER *****************************************/
Route::get('datauser/edit/{id}', [
		'as'	=> 'admin.datauser.edit',
		'uses'	=> 'admin\DataUserController@edit',	
	])->middleware('can:is_admin,'.Acceso::class);

Route::put('datauser/update', [
		'as'	=> 'administrador.datauser.update',
		'uses'	=> 'admin\DataUserController@update',	
	])->middleware('can:is_admin,'.Acceso::class);

/** ACCESO *******************************************/
Route::get('acceso/edit/{id}', [
		'as'	=> 'admin.acceso.edit',
		'uses'	=> 'admin\AccesoController@edit',	
	])->middleware('can:is_admin,'.Acceso::class);

Route::put('acceso/update', [
		'as'	=> 'admin.acceso.update',
		'uses'	=> 'admin\AccesoController@update',	
	])->middleware('can:is_admin,'.Acceso::class);

/** DHORA ********************************************/

Route::get('dhora/edit/{id}',[
		'as'	=> 'admin.dhora.edit',
		'uses'	=> 'admin\DHoraController@edit'
	])->middleware('can:is_admin,'.Acceso::class);

Route::put('dhora/update',[
		'as'	=> 'admin.dhora.update',
		'uses'	=> 'admin\DHoraController@update'
	])->middleware('can:is_admin,'.Acceso::class);

Route::get('dhora/lista',  [
		'as'	=> 'administrador.dhora.lista',
		'uses'	=> 'admin\DHoraController@lista',	
	])->middleware('can:is_admin,'.Acceso::class);

Route::get('dhora/list2Excel',[
		'as'	=> 'admin.dhora.list2Excel',
		'uses'	=> 'admin\DHoraController@list2Excel'
	])->middleware('can:is_admin,'.Acceso::class);

/** CURSOGRUPO *******************************************/
Route::get('cursogrupo/index/{id?}', [
		'as'	=> 'admin.cursogrupo.index',
		'uses'	=> 'admin\CursoGrupoController@index',	
	])->middleware(Authorize::class.':is_admin,'.Acceso::class);

Route::get('cursogrupo/edit/{id}', [
		'as'	=> 'admin.cursogrupo.edit',
		'uses'	=> 'admin\CursoGrupoController@edit',	
	])->middleware(Authorize::class.':is_admin,'.Acceso::class);

/** DCURSO *******************************************/
Route::get('dcurso/index/{grupo_id}/{curso_id}', [
		'as'	=> 'admin.dcurso.index',
		'uses'	=> 'admin\DcursoController@index',	
	])->middleware('can:is_admin,'.Acceso::class);

Route::get('dcurso/edit/{id}', [
		'as'	=> 'admin.dcurso.edit',
		'uses'	=> 'admin\DcursoController@edit',	
	])->middleware('can:is_admin,'.Acceso::class);

Route::put('dcurso/update', [
		'as'	=> 'admin.dcurso.update',
		'uses'	=> 'admin\DcursoController@update',	
	])->middleware('can:is_admin,'.Acceso::class);

Route::get('dcurso/lista',  [
		'as'	=> 'administrador.dcurso.lista',
		'uses'	=> 'admin\DCursoController@lista',	
	])->middleware('can:is_admin,'.Acceso::class);

Route::get('dcurso/list2Excel',[
		'as'	=> 'admin.dcurso.list2Excel',
		'uses'	=> 'admin\DCursoController@list2Excel'
	])->middleware('can:is_admin,'.Acceso::class);

/** GRUPO ********************************************/
Route::get('grupo/index',  [
		'as'	=> 'administrador.grupo.index',
		'uses'	=> 'admin\GrupoController@index',	
	])->middleware('can:is_admin,'.Acceso::class);

Route::get('grupo/create',  [
		'as'	=> 'admin.grupo.create',
		'uses'	=> 'admin\GrupoController@create',	
	])->middleware('can:is_admin,'.Acceso::class);

Route::post('grupo/store',  [
		'as'	=> 'admin.grupo.store',
		'uses'	=> 'admin\GrupoController@store',	
	])->middleware('can:is_admin,'.Acceso::class);

Route::get('grupo/edit/{id}',[
		'as'	=> 'admin.grupo.edit',
		'uses'	=> 'admin\GrupoController@edit',	
	])->middleware('can:is_admin,'.Acceso::class);

Route::put('grupo/update',  [
		'as'	=> 'admin.grupo.update',
		'uses'	=> 'admin\GrupoController@update',	
	])->middleware('can:is_admin,'.Acceso::class);

Route::get('grupo/orden',  [
		'as'	=> 'admin.grupo.orden',
		'uses'	=> 'admin\GrupoController@orden',	
	])->middleware('can:is_admin,'.Acceso::class);

Route::get('grupo/destroy/{id}',  [
		'as'	=> 'admin.grupo.destroy',
		'uses'	=> 'admin\GrupoController@destroy',	
	])->middleware('can:is_admin,'.Acceso::class);


/** GRUPOUSERS *************CORREGIR NOMBRES**************************/
Route::get('usergrupos/index',  [
		'as'	=> 'administrador.usergrupo.index',
		'uses'	=> 'admin\UserGrupoController@index',	
	])->middleware('can:is_admin,'.Acceso::class);

/** FRANJAS ***************************************/
Route::get('franjas/index',  [
		'as'	=> 'administrador.franja.index',
		'uses'	=> 'admin\FranjaController@index',	
	])->middleware('can:is_admin,'.Acceso::class);

Route::get('franjas/show',  [
		'as'	=> 'administrador.franja.show',
		'uses'	=> 'admin\FranjaController@show',	
	])->middleware('can:is_admin,'.Acceso::class);

Route::get('franjas/create',  [
		'as'	=> 'administrador.franja.create',
		'uses'	=> 'admin\FranjaController@create',	
	])->middleware('can:is_admin,'.Acceso::class);

Route::post('franjas/store',  [
		'as'	=> 'administrador.franja.store',
		'uses'	=> 'admin\FranjaController@store',	
	])->middleware('can:is_admin,'.Acceso::class);

Route::get('franjas/edit/{id}',  [
		'as'	=> 'admin.franja.edit',
		'uses'	=> 'admin\FranjaController@edit',	
	])->middleware('can:is_admin,'.Acceso::class);

Route::put('franjas/update',  [
		'as'	=> 'administrador.franja.update',
		'uses'	=> 'admin\FranjaController@update',	
	])->middleware('can:is_admin,'.Acceso::class);

Route::get('franjas/destroy/{id}',  [
		'as'	=> 'administrador.franja.destroy',
		'uses'	=> 'admin\FranjaController@destroy',	
	])->middleware('can:is_admin,'.Acceso::class);



/** MENVIO *******************************************/
Route::get('menvios/index',  [
		'as'	=> 'administrador.menvio.index',
		'uses'	=> 'admin\MenvioController@index',	
	])->middleware('can:is_admin,'.Acceso::class);

Route::get('menvios/create',  [
		'as'	=> 'administrador.menvio.create',
		'uses'	=> 'admin\MenvioController@create',	
	])->middleware('can:is_admin,'.Acceso::class);

Route::post('menvios/store',  [
		'as'	=> 'administrador.menvio.store',
		'uses'	=> 'admin\MenvioController@store',	
	])->middleware('can:is_admin,'.Acceso::class);

Route::get('menvios/edit/{id}',  [
		'as'	=> 'administrador.menvio.edit',
		'uses'	=> 'admin\MenvioController@edit',	
	])->middleware('can:is_admin,'.Acceso::class);

Route::put('menvios/update',  [
		'as'	=> 'administrador.menvio.update',
		'uses'	=> 'admin\MenvioController@update',	
	])->middleware('can:is_admin,'.Acceso::class);

Route::get('menvios/show/{id}',  [
		'as'	=> 'administrador.menvio.show',
		'uses'	=> 'admin\MenvioController@show',	
	])->middleware('can:is_admin,'.Acceso::class);

Route::get('menvios/destroy/{id}',  [
		'as'	=> 'administrador.menvio.destroy',
		'uses'	=> 'admin\MenvioController@destroy',	
	])->middleware('can:is_admin,'.Acceso::class);

/** DENVIO *******************************************/
Route::get('denvios/define/{id}',  [
		'as'	=> 'administrador.denvio.define',
		'uses'	=> 'admin\DenvioController@define',	
	])->middleware('can:is_admin,'.Acceso::class);

Route::put('denvios/update',  [
		'as'	=> 'administrador.denvio.update',
		'uses'	=> 'admin\DenvioController@update',	
	])->middleware('can:is_admin,'.Acceso::class);

Route::get('denvios/markall/{id}',  [
		'as'	=> 'administrador.denvio.markall',
		'uses'	=> 'admin\DenvioController@markall',	
	])->middleware('can:is_admin,'.Acceso::class);

Route::get('denvios/unmarkall/{id}',  [
		'as'	=> 'administrador.denvio.unmarkall',
		'uses'	=> 'admin\DenvioController@unmarkall',	
	])->middleware('can:is_admin,'.Acceso::class);

/** ENVIO *********************************************/
Route::get('envios/send/{id}', [
		'as'	=> 'administrador.envio.send',
		'uses'	=> 'admin\EnvioController@send',	
	])->middleware('can:is_admin,'.Acceso::class);

/** PDF ***********************************************/
Route::put('PDF/silaboCurso', [
		'as'	=> 'admin.PDF.silaboCurso',
		'uses'	=> 'admin\PDFController@silaboCurso',	
	])->middleware('can:is_admin,'.Acceso::class);
