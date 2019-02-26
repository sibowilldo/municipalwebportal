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


//Route::get('/{any}', 'SinglePageController@index')->where('any', '.*');
//Route::get('/', function () {
//    return view('welcome');
//});
//
Auth::routes();
//

Route::get('/', 'HomeController@index')->name('dashboard');
Route::get('/dashboard', 'HomeController@index')->name('dashboard');

Route::resource('incidents', 'IncidentController');
Route::get('/api/incidents', 'IncidentController@jsonIndex');

Route::resource('types', 'TypeController');
Route::get('json/types/{category}', 'TypeController@jsonShowByCategory');

Route::resource('categories', 'CategoryController');
Route::get('json/categories/{type}', 'CategoryController@jsonShowByType');

//
//Route::get('/{vue?}', function () {
//    return view('pages.dashboard');
//})->where('vue', '[\/\w\.-]*')->name('home');
