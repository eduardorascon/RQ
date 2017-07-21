<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});
Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['middleware' => ['web']], function() {
  Route::resource('clients','ClientController');
});

Route::group(['middleware' => ['web']], function() {
	Route::resource('breeds','BreedController');
	Route::resource('vaccines','VaccineController');
	Route::resource('owners', 'OwnerController');
	Route::resource('paddocks', 'PaddockController');

	Route::get('/cow_filters', [
		'uses' => 'CowFilterController@index',
		'as' => 'cow_filters.index'
	]);

	Route::get('bull_filters', [
		'uses' => 'BullFilterController@index',
		'as' => 'bull_filters.index'
	]);

	Route::get('calf_filters', [
		'uses' => 'CalfFilterController@index',
		'as' => 'calf_filters.index'
	]);

	//Cows
	Route::post('/cows/{id}/log_weight', [
		'uses' => 'CowController@log_weight',
		'as' => 'cow_log_weight']);

	Route::post('/cows/{id}/log_vaccine', [
		'uses' => 'CowController@log_vaccine',
		'as' => 'cow_log_vaccine']);

	Route::post('/cows/{id}/log_palpation', [
		'uses' => 'CowController@log_palpation',
		'as' => 'cow_log_palpation']);

	Route::post('/cows/{id}/cow_save_picture', [
		'uses' => 'CowController@save_picture',
		'as' => 'cow_save_picture']);

	Route::resource('cows', 'CowController');

	//Bulls
	Route::post('/bulls/{id}/log_weight', [
		'uses' => 'BullController@log_weight',
		'as' => 'bull_log_weight']);

	Route::post('/bulls/{id}/log_weight_delete', [
		'uses' => 'BullController@log_weight_delete',
		'as' => 'bull_delete_weight']);

	Route::post('/bulls/{id}/log_vaccine', [
		'uses' => 'BullController@log_vaccine',
		'as' => 'bull_log_vaccine']);

	Route::post('/bulls/{id}/bull_save_picture', [
		'uses' => 'BullController@save_picture',
		'as' => 'bull_save_picture']);

	Route::resource('bulls', 'BullController');

	//Calves
	Route::post('/calfs/{id}/log_weight', [
		'uses' => 'CalfController@log_weight',
		'as' => 'calf_log_weight']);

	Route::post('/calfs/{id}/log_vaccine', [
		'uses' => 'CalfController@log_vaccine',
		'as' => 'calf_log_vaccine']);

	Route::get('calfs/create_offspring/c={id}', [
		'uses' => 'CalfController@create_offspring',
		'as' => 'calf_create_offspring'
		]);

	Route::post('/calfs/{id}/calf_save_picture', [
		'uses' => 'CalfController@save_picture',
		'as' => 'calf_save_picture']);

	Route::resource('calfs', 'CalfController');

	//Sales
	Route::resource('calves_sales', 'CalfSaleController');
	Route::resource('cows_sales', 'CowSaleController');
	Route::resource('bulls_sales', 'BullSaleController');
});

Route::get('/admin', [
	'uses' => 'AdminController@index',
	'as' => 'admin',
	'middleware' => 'roles',
	'roles' => ['Admin']]);

Route::post('/admin.create_new_user', [
	'uses' => 'AdminController@create_new_user',
	'as' => 'create_new_user',
	'middleware' => 'roles',
	'roles' => ['Admin']]);

Route::post('/admin.assign_role', [
	'uses' => 'AdminController@assign_role',
	'as' => 'assign_role',
	'middleware' => 'roles',
	'roles' => ['Admin']]);