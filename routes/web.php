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

	Route::resource('cows', 'CowController');

	//Bulls
	Route::post('/bulls/{id}/log_weight', [
		'uses' => 'BullController@log_weight',
		'as' => 'bull_log_weight']);

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

	Route::resource('calfs', 'CalfController');

	//Sales
	Route::get('calves_sales', [
		'uses' => 'CalfSaleController@index',
		'as' => 'calves_sales']);

	Route::get('calves_sales/{id}', [
		'uses' => 'CalfSaleController@show',
		'as' => 'calves_sales_show']);

	Route::get('calves_sales/register_sale/c={id}', [
		'uses' => 'CalfSaleController@register_sale',
		'as' => 'calves_sales_register']);

	Route::post('calves_sales/{id}/register_sale', [
		'uses' => 'CalfSaleController@store',
		'as' => 'calves_sales_log_sale']);

	Route::get('calves_sales/{id}/edit', [
		'uses' => 'CalfSaleController@edit',
		'as' => 'calves_sales_edit_sale']);

	Route::post('calves_sales/{id}/edit', [
		'uses' => 'CalfSaleController@update',
		'as' => 'calves_sales_update_sale']);
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