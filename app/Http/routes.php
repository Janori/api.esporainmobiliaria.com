<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::post('authenticate', 'AuthenticateController@authenticate');
Route::group(['middleware' => ['jwt.auth', 'cors']], function(){

	Route::post('register', 'AuthenticateController@register');
	Route::get('user/data', 'AuthenticateController@getUserData');
	Route::get('user/menu', 'UserController@getMenu');
	Route::get('user/{id}/branch', 'UserController@getBranch');
	Route::get('user/kind/{tipo}', 'UserController@getTipo');
	Route::get('user/kinds', 'UserController@kinds');
	Route::put('user/change-password/{id?}', 'UserController@changePassword');
	Route::resource('user', 'UserController', ['except' => ['create']]);

	Route::get('branch/{id}/users', 'BranchController@users');
	Route::resource('branch', 'BranchController', ['except' => ['create']]);

    Route::resource('building', 'BuildingController', ['except' => ['create']]);
	Route::post('building/upload/{id?}', 'ImageController@upload');
	Route::delete('building/delete-image/{id?}', 'ImageController@destroy');

	Route::get('customer/options/{option}', 'CustomerController@options');
	Route::resource('customer', 'CustomerController', ['except' => ['index', 'create']]);
	Route::resource('location', 'LocationController', ['except' => ['index', 'create']]);
	Route::resource('land', 'LandController', ['except' => ['index', 'create']]);
	Route::resource('warehouse', 'WarehouseController', ['except' => ['index', 'create']]);
	Route::resource('office', 'OfficeController', ['except' => ['index', 'create']]);
	Route::resource('housing', 'HousingController', ['except' => ['index', 'create']]);
	Route::resource('prospect', 'ProspectController', ['except' => ['index', 'create']]);
	Route::resource('date', 'DateController', ['except' => ['index', 'create']]);
	Route::resource('sale', 'SaleController', ['except' => ['index', 'create']]);
	Route::resource('document', 'DocumentController', ['except' => ['index', 'create']]);
	Route::resource('phone', 'PhoneController', ['except' => ['index', 'create']]);
});
