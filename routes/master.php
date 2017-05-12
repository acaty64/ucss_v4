<?php

use App\Acceso;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Http\Request;

// ROUTES

Route::get('menu/index', [
		'as'	=> 'master.menu.index',
		'uses'	=> 'master\MenuController@index',	
	])->middleware(Authorize::class.':is_master,'.Acceso::class);

Route::get('menu/create', [
		'as'	=> 'master.menu.create',
		'uses'	=> 'master\MenuController@create',	
	])->middleware(Authorize::class.':is_master,'.Acceso::class);

Route::post('menu/store', [
		'as'	=> 'master.menu.store',
		'uses'	=> 'master\MenuController@store',	
	])->middleware(Authorize::class.':is_master,'.Acceso::class);

Route::get('menu/delete', [
		'as'	=> 'master.menu.delete',
		'uses'	=> 'master\MenuController@delete',	
	])->middleware(Authorize::class.':is_master,'.Acceso::class);

Route::get('menu/{menu}/edit', [
		'as'	=> 'master.menu.edit',
		'uses'	=> 'master\MenuController@edit',	
	])->middleware(Authorize::class.':is_master,'.Acceso::class);

Route::get('menu/update', [
		'as'	=> 'master.menu.update',
		'uses'	=> 'master\MenuController@update',	
	])->middleware(Authorize::class.':is_master,'.Acceso::class);

Route::post('menu/{type}/show', [
		'as'	=> 'master.menu.show',
		'uses'	=> 'master\MenuController@show',	
	])->middleware(Authorize::class.':is_master,'.Acceso::class);
