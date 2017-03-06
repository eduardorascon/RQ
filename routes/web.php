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
    return view('welcome');
});
Auth::routes();

Route::get('/home', 'HomeController@index');

//Routes test

Route::get('clientsAll', function () {
	return App\Client::all();
});

Route::get('breedsAll', ['as' => 'breeds', function () {
	return App\Breed::all();
}]);


/*Clients*/
Route::get('clients', 'ClientController@index');

Route::get('client/{id}', 'ClientController@getClient');

Route::get('breed/{id}', 'BreedController@getBreed');



//Api, revisar la clase existente
Route::group(['prefix' => 'api'], function(){
/*	
	Route::get('breeds', ['as'=>'breeds', function(){
			return App\Breed::all();
	}]);
*/	

	Route::resource('clients', 'ClientController', ['only' =>
															['index','client','store','update']
													]);
	Route::resource('breeds', 'BreedController', ['only' =>
															['index','breed','store','update']
													]);
});


