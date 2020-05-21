<?php

use Illuminate\Support\Facades\Auth;

Auth::routes(['verify' => true, 'register' => false]);

Route::post('password/success', 'Auth\ResetPasswordController@resetSuccess')->name('password.success');

Route::get('/auth/social/{social}', 'SocialLoginController@redirectToSocial')->name('social.redirect');
Route::get('/auth/{social}/callback', 'SocialLoginController@handleSocialCallback')->name('social.callback');

Route::view('apis', 'apis');

Route::group(['middleware' => ['auth:web', 'verified','checkrole:administrator,super-administrator']], function () {
    Route::get('/', 'HomeController@index')->name('dashboard');
    Route::get('dashboard', 'HomeController@index')->name('dashboard');

    /**
     * Resource Routes
     */
    Route::resource('categories', 'CategoryController');
    Route::resource('engineers', 'AssignEngineerController');
    Route::resource('incidents', 'IncidentController');
    Route::resource('profile', 'ProfileController')->except(['index', 'show', 'create', 'store']);
    Route::resource('types', 'TypeController');
    Route::resource('users', 'UserController')->except(['show']);
    Route::resource('working-groups', 'WorkingGroupController');

    Route::resource('manage/departments', 'DepartmentController');
    Route::resource('manage/districts', 'DistrictController');
    Route::resource('security/permissions', 'PermissionController');
    Route::resource('security/roles', 'RoleController');
    Route::resource('system/state-colors', 'StateColorController');
    Route::resource('system/statuses', 'StatusController');

    /**
     * GET Routes
     */
    Route::get('welcome', 'HomeController@welcome');
    Route::get('incidents/{incident}/engineers/', 'IncidentController@engineers')->name('incidents.engineers');
    Route::get('incidents/{incident}/specialists/', 'IncidentController@specialists')->name('incidents.specialists');
    Route::get('incidents/{incident}/groups/', 'IncidentController@groups')->name('incidents.groups');
    Route::get('working-groups/{working_group}/engineers/list', 'WorkingGroupController@listEngineers')->name('working-group.list');

    /**
     * POST Routes
     */
    Route::post('incidents/{incident}/assign', 'IncidentController@assign')->name('incidents.assign');
    Route::post('users/{user}/restore', 'UserController@restore')->name('users.restore');
    Route::post('working-groups/{working_group}/engineers/assign', 'WorkingGroupController@assignEngineers')->name('working-group.assign');

    /**
     * Custom JSON formatted output
     */
    Route::get('json/types/{category}', 'TypeController@jsonShowByCategory');
    Route::get('json/categories/{type}', 'CategoryController@jsonShowByType');

    Route::prefix('api/v1')->group(function (){
        Route::get('incidents', 'IncidentController@jsonIndex');
        Route::name('spa.')->group(function(){
            Route::apiResource('roles', 'SPA\RoleController');
            Route::apiResource('permissions', 'SPA\PermissionController');
            Route::apiResource('incidents', 'SPA\IncidentController');
            Route::apiResource('categories', 'SPA\CategoryController');
            Route::apiResource('types', 'SPA\TypeController');
            Route::apiResource('statuses', 'SPA\StatusController');
        });
        Route::get('system/categories', 'CategoryController@jsonIndex')->name('categories.index.json');
        Route::get('system/statuses', 'StatusController@jsonIndex')->name('statuses.json');
    });
    /**
     * Charts Controller
     */
    Route::get('charts/types', 'ChartController@types');
    Route::get('charts/statuses', 'ChartController@statuses');
    Route::get('charts/incidents', 'ChartController@incidents');

//    Route::get('push', function () {
//        return view('auth.passwords.success');
//
//        $incident = App\Incident::first();
//        $user = $incident->user()->fullname;
//        dd($user);
//        Notification::send($incident, new IncidentUpdated($user, $incident, 'Another Notification Sent to no one'));
//    });
});


Route::get('notify', function () {

    return response()->redirectToRoute('dashboard');
});

//
//Route::get('/{vue?}', function () {
//    return view('pages.dashboard');
//})->where('vue', '[\/\w\.-]*')->name('home');

