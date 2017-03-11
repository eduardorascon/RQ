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

Route::resource('cows', 'CowsController');
Route::resource('bulls', 'BullController');
Route::resource('calfs', 'CalfController');

Route::get('/home', 'HomeController@index');

Route::get('/breeds', [
	'uses' => 'BreedController@index',
	'as' => 'breeds'
	]);

Route::get('/breeds.create', [
	'uses' => 'BreedController@create',
	'as' => 'breeds.create'
	]);

Route::get('/breeds.edit', [
	'uses' => 'BreedController@edit',
	'as' => 'breeds.edit'
	]);

Route::post('/breeds.store', [
	'uses' => 'BreedController@store',
	'as' => 'breeds.store'
	]);

Route::post('/breeds.destroy', [
	'uses' => 'BreedController@destroy',
	'as' => 'breeds.destroy'
	]);

Route::get('/clients', [
	'uses' => 'ClientController@index',
	'as' => 'clients'
	]);

Route::get('/clients.create', [
	'uses' => 'ClientController@create',
	'as' => 'clients.create'
	]);

Route::get('/clients.edit', [
	'uses' => 'ClientController@edit',
	'as' => 'clients.edit'
	]);

Route::post('/clients.store', [
	'uses' => 'ClientController@store',
	'as' => 'clients.store'
	]);

Route::post('/clients.destroy', [
	'uses' => 'ClientController@destroy',
	'as' => 'clients.destroy'
	]);

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