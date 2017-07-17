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


Route::post('api/authenticate', 'AuthenticateController@authenticate');
Route::group(['middleware' => ['jwt.auth', 'cors'], 'prefix'=>'api'], function(){
	Route::post('register', 'AuthenticateController@register');
	Route::get('user/data', 'AuthenticateController@getUserData');
	Route::resource('user', 'JiUserController', ['except' => ['index', 'create']]);
	Route::get('customer/options/{option}', 'JiCustomerController@options');
	Route::resource('customer', 'JiCustomerController', ['except' => ['index', 'create']]);
	Route::resource('location', 'JiLocationController', ['except' => ['index', 'create']]);
	Route::resource('land', 'JiLandController', ['except' => ['index', 'create']]);
	Route::resource('warehouse', 'JiWarehouseController', ['except' => ['index', 'create']]);
	Route::resource('office', 'JiOfficeController', ['except' => ['index', 'create']]);
	Route::resource('housing', 'JiHousingController', ['except' => ['index', 'create']]);
	Route::resource('building', 'JiBuildingController', ['except' => ['index', 'create']]);
	Route::resource('prospect', 'JiProspectController', ['except' => ['index', 'create']]);
	Route::resource('date', 'JiDateController', ['except' => ['index', 'create']]);
	Route::resource('branch', 'JiBranchController', ['except' => ['index', 'create']]);
	Route::resource('sale', 'JiSaleController', ['except' => ['index', 'create']]);
	Route::resource('document', 'JiDocumentController', ['except' => ['index', 'create']]);
	Route::resource('phone', 'JiPhoneController', ['except' => ['index', 'create']]);
});

Route::group(['prefix'=>'api/test'], function(){
	Route::get('user/{id}', 'JiUserController@UserToJson');
	Route::get('customer/options/{option}', 'JiCustomerController@options');
	Route::resource('customer', 'JiCustomerController', ['except' => ['index', 'create']]);
	Route::resource('location', 'JiLocationController', ['except' => ['index', 'create']]);
	Route::resource('land', 'JiLandController', ['except' => ['index', 'create']]);
	Route::resource('warehouse', 'JiWarehouseController', ['except' => ['index', 'create']]);
	Route::resource('office', 'JiOfficeController', ['except' => ['index', 'create']]);
	Route::resource('housing', 'JiHousingController', ['except' => ['index', 'create']]);
	Route::resource('building', 'JiBuildingController', ['except' => ['index', 'create']]);
	Route::resource('prospect', 'JiProspectController', ['except' => ['index', 'create']]);
	Route::resource('date', 'JiDateController', ['except' => ['index', 'create']]);
	Route::resource('branch', 'JiBranchController', ['except' => ['index', 'create']]);
	Route::resource('sale', 'JiSaleController', ['except' => ['index', 'create']]);
	Route::resource('document', 'JiDocumentController', ['except' => ['index', 'create']]);
	Route::resource('phone', 'JiPhoneController', ['except' => ['index', 'create']]);
});
