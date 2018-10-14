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

    Route::group(['middleware' => ['auth:api', 'accountVerified']], function() {
        Route::get('logout', 'Api\AuthController@logout');

        Route::get('user/{id}', 'Api\UserController@user');
        Route::get('user', 'Api\UserController@profile');
        Route::resource('permissions', 'Api\PermissionController');
        Route::resource('roles', 'Api\RoleController');
        Route::post('roles/assign/{user}', 'Api\RoleController@assign');
    });
});
