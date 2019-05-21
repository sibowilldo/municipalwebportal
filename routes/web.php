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

Auth::routes(['verify' => true]);
//
Route::group(['middleware' => ['verified']], function () {
    Route::get('/', 'HomeController@index')->name('dashboard')->middleware('verified');
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');

    /**
     * Permissions and Roles Routes
     */
    Route::resource('manage/permissions', 'PermissionController');
    Route::resource('manage/roles', 'RoleController');

    /**
     * Profile, Users, Engineers and WorkingGroup Routes
     */

    Route::resource('profile', 'ProfileController')->except(['index', 'show', 'create', 'store']);

    Route::resource('users', 'UserController');
    Route::post('users/{user}/restore', 'UserController@restore')->name('users.restore');

    Route::resource('/engineers', 'AssignEngineerController');
    Route::post('/engineers/{incident}/assign', 'AssignEngineerController@assign')->name('engineers.assign');
    Route::get('/engineers/{incident}/list', 'AssignEngineerController@list')->name('engineers.list');


    Route::resource('/working-group', 'AssignGroupController');
    Route::post('/working-group/{incident}/assign', 'AssignGroupController@assign')->name('working-group.assign');
    Route::post('/working-group/{incident}/list', 'AssignGroupController@list')->name('working-group.list');


    Route::resource('incidents', 'IncidentController');
    Route::get('/api/incidents', 'IncidentController@jsonIndex');

    Route::resource('types', 'TypeController');
    Route::get('json/types/{category}', 'TypeController@jsonShowByCategory');

    Route::resource('categories', 'CategoryController');
    Route::get('json/categories/{type}', 'CategoryController@jsonShowByType');

    Route::resource('manage/departments', 'DepartmentController');
});


//
//Route::get('/{vue?}', function () {
//    return view('pages.dashboard');
//})->where('vue', '[\/\w\.-]*')->name('home');
