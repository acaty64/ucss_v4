<?php

use App\Acceso;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('dcurso/index', [
		'as'	=> 'api.dcurso.index',
		'uses'	=> 'api\DcursoController@index',	
	]);
//->middleware('can:is_admin,'.Acceso::class);

Route::post('dcurso/update', [
		'as'	=> 'api.dcurso.update',
		'uses'	=> 'api\DcursoController@update',	
	]);

Route::get('generar/{type_id}/{auth_id?}', [
	'as' => 'generar',
	'uses' =>'Api\MenuController@generar'
]);

Route::get('generarHelp/{type_id}', [
	'as' => 'generarHelp',
	'uses' =>'Api\MenuController@generarHelp'
]);

Route::get('loadTypes', [
	'as' => 'loadTypes',
	'uses' =>'Api\MenuController@loadTypes'
]);