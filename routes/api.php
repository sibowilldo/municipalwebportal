<?php

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'Api\AuthController@login');
    Route::post('signup', 'Api\AuthController@signup');
    Route::get('account/activate/{token}', 'Api\AuthController@AccountActivate');

    Route::group(['middleware' => ['auth:api', 'accountVerified']], function() {

        // Auth, Roles and Permissions Routes
        Route::post('logout', 'Api\AuthController@logout');
        Route::get('user', 'Api\UserController@profile');
        Route::get('users/{user}', 'Api\UserController@show');
        Route::get('users/{user}/incidents', 'Api\UserController@incidents');

        //Resource Routes (Excluding Create & Edit)
        Route::apiResources([
            'assignments'   =>'Api\AssignmentController',
            'categories'    =>'Api\CategoryController',
            'devices'       =>'Api\DeviceController',
            'incidents'     =>'Api\IncidentController',
            'notifications' =>'Api\NotificationController',
            'permissions'   =>'Api\PermissionController',
            'roles'         =>'Api\RoleController',
            'statuses'      =>'Api\StatusController',
            'types'         =>'Api\TypeController'

        ]);

        // Assignment Routes
        Route::post('assignments/accept/{assignment}','Api\AssignmentController@accept');
        Route::post('assignments/decline/{assignment}','Api\AssignmentController@decline');
        Route::post('assignments/escalate/{assignment}','Api\AssignmentController@escalate');

        Route::post('roles/assign/{user}', 'Api\RoleController@assign');

        Route::post('incidents/{incident}/upload', 'Api\IncidentController@upload')->name('incidents.upload'); //upload images

        // Device Routes
        Route::patch('devices/{device_id}/update-token', 'Api\DeviceController@updateToken');

        // State Colors Routes
        Route::resource( 'state-colors','Api\StateColorController')->except(['edit', 'update', 'destroy', 'create', 'store']);
    });
});
