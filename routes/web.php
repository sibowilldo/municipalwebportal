<?php

use App\Http\Resources\Incident as IncidentResource;
use App\Incident;
use App\Notifications\AccountActivate;
use App\Status;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Notifications\IncidentUpdated;
use Illuminate\Support\Str;
use function MongoDB\BSON\toJSON;

Auth::routes(['verify' => true, 'register' => false]);
Route::get('password/success', 'Auth\ResetPasswordController@resetSuccess')->name('password.success');

Route::get('/auth/social/{social}', 'SocialLoginController@redirectToSocial')->name('social.redirect');
Route::get('/auth/{social}/callback', 'SocialLoginController@handleSocialCallback')->name('social.callback');
//

Route::group(['middleware' => ['auth:web', 'verified']], function () {
//
//    Route::get('push', function () {
//        return view('auth.passwords.success');
//
//        $incident = App\Incident::first();
//        $user = $incident->user()->fullname;
//        dd($user);
//        Notification::send($incident, new IncidentUpdated($user, $incident, 'Another Notification Sent to no one'));
//    });

//    Route::get('notify', function () {
//        return Str::random();
//        //send account activation notification
////        Auth::user()->notify(new AccountActivate(Auth::user()));
//
//    });


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
    Route::resource('manage/permissions', 'PermissionController');
    Route::resource('manage/roles', 'RoleController');
    Route::resource('system/state-colors', 'StateColorController');
    Route::resource('system/statuses', 'StatusController');

    /**
     * GET Routes
     */
    Route::get('welcome', 'HomeController@welcome');
    Route::get('incidents/{incident}/engineers/', 'IncidentController@engineers')->name('incidents.engineers');
    Route::get('incidents/{incident}/specialists/', 'IncidentController@specialists')->name('incidents.specialists');
    Route::get('incidents/{incident}/groups/', 'IncidentController@groups')->name('incidents.groups');
    Route::get('working-group/{incident}/list', 'AssignGroupController@list')->name('working-group.list');

    /**
     * POST Routes
     */
    Route::post('incidents/{incident}/assign', 'IncidentController@assign')->name('incidents.assign');
    Route::post('users/{user}/restore', 'UserController@restore')->name('users.restore');
    Route::post('working-group/{incident}/assign', 'AssignGroupController@assign')->name('working-group.assign');

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
});


//
//Route::get('/{vue?}', function () {
//    return view('pages.dashboard');
//})->where('vue', '[\/\w\.-]*')->name('home');

