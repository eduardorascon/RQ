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

	Route::post('/cows/{id}/log_weight', [
		'uses' => 'CowController@log_weight',
		'as' => 'cow_log_weight']);

	Route::post('/cows/{id}/log_vaccine', [
		'uses' => 'CowController@log_vaccine',
		'as' => 'cow_log_vaccine']);

	Route::resource('cows', 'CowController');

	Route::post('/bulls/{id}/log_weight', [
		'uses' => 'BullController@log_weight',
		'as' => 'bull_log_weight']);

	Route::post('/bulls/{id}/log_vaccine', [
		'uses' => 'BullController@log_vaccine',
		'as' => 'bull_log_vaccine']);

	Route::resource('bulls', 'BullController');

	Route::post('/calfs/{id}/log_weight', [
		'uses' => 'CalfController@log_weight',
		'as' => 'calf_log_weight']);

	Route::resource('calfs', 'CalfController');
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