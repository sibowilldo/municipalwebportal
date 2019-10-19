<?php

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


Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'Api\AuthController@login');
    Route::post('signup', 'Api\AuthController@signup');
    Route::get('account/activate/{token}', 'Api\AuthController@AccountActivate');
//    Route::post('check', function (){
////        return response(['authenticated' => false]);
//    });


    Route::group(['middleware' => ['auth:api', 'accountVerified']], function() {

        // Auth, Roles and Permissions Routes
        Route::post('logout', 'Api\AuthController@logout');
        Route::get('user', 'Api\UserController@profile');
        Route::get('users/{user}', 'Api\UserController@show');
        Route::get('users/{user}/incidents', 'Api\UserController@incidents');

        //permissions routes
        Route::resource('permissions', 'Api\PermissionController');

        //roles routes
        Route::resource('roles', 'Api\RoleController');

        Route::post('roles/assign/{user}', 'Api\RoleController@assign');

        // Incident Routes
        Route::resource('incidents', 'Api\IncidentController');
        Route::post('incidents/{incident}/upload', 'Api\IncidentController@upload')->name('incidents.upload'); //upload images

        // Status Routes
        Route::resource('statuses', 'Api\StatusController');

        // Category Routes
        Route::resource('categories', 'Api\CategoryController');

        // Device Routes
        Route::resource('devices', 'Api\DeviceController');
        Route::patch('devices/{device_id}/update-token', 'Api\DeviceController@updateToken');

        // Type Routes
        Route::resource('types', 'Api\TypeController');

        // State Colors Routes
        Route::resource('state-colors', 'Api\StateColorController')->except(['edit', 'update', 'destroy', 'create', 'store']);
    });
});
