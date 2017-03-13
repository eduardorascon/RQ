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

Route::resource('cows', 'CowController');
Route::resource('bulls', 'BullController');
Route::resource('calfs', 'CalfController');

Route::get('/home', 'HomeController@index');

Route::group(['middleware' => ['web']], function() {
  Route::resource('clients','ClientController');  
});

Route::group(['middleware' => ['web']], function() {
  Route::resource('breeds','BreedController');  
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