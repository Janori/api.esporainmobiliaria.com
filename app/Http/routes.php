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

Route::get('mailtest', 'CustomerController@mailtest');


Route::post('authenticate', 'AuthenticateController@authenticate');
Route::post('lockscreen', 'AuthenticateController@lockscreen');
Route::group(['middleware' => ['jwt.auth', 'cors']], function(){

	Route::post('register', 'AuthenticateController@register');
    // Route::post('user/{id}/files/{type}', 'UserController@files');
	Route::get('user/data', 'AuthenticateController@getUserData');
	Route::get('user/menu', 'UserController@getMenu');
	Route::get('user/{id}/branch', 'UserController@getBranch');
	Route::get('user/kind/{tipo}', 'UserController@getTipo');
	Route::get('user/kinds', 'UserController@kinds');
	Route::put('user/change-password/{id?}', 'UserController@changePassword');
	Route::resource('user', 'UserController', ['except' => ['create']]);

	Route::get('branch/{id}/users', 'BranchController@users');
	Route::resource('branch', 'BranchController', ['except' => ['create']]);

    Route::post('building/{id}/remove', 'BuildingController@removeCustomer');
    Route::post('building/sell', 'BuildingController@sell');
    Route::post('buildings/filter', 'BuildingController@filter');
    Route::post('building/send', 'BuildingController@send');
    Route::resource('building', 'BuildingController', ['except' => ['create']]);
	Route::post('building/upload/{id?}', 'ImageController@upload');
	Route::delete('building/delete-image/{id?}', 'ImageController@destroy');

	Route::post('customer/campaign', 'CustomerController@campaign');
	Route::post('customer/prospects', 'CustomerController@prospectsInteresteds');
	Route::get('customer/options/{option}', 'CustomerController@options');
    Route::post('customer/{id}/file', 'CustomerController@file');
    Route::get('customer/{type}/kind', 'CustomerController@index');
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
