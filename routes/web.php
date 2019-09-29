<?php
use App\Http\Resources\CategoryResource;
use App\Category;
use App\Incident;
use App\Notifications\AccountActivate;
use App\Status;
use App\User;
use Illuminate\Support\Facades\Notification;

Auth::routes(['verify' => true]);
Route::get('/register', function (){abort(403, 'Unauthorized action.');});
Route::post('/register', function (){abort(403, 'Unauthorized action.');});

Route::get('/auth/social/{social}', 'SocialLoginController@redirectToSocial')->name('social.redirect');
Route::get('/auth/{social}/callback', 'SocialLoginController@handleSocialCallback')->name('social.callback');
//
Route::group(['middleware' => ['verified']], function () {

    Route::get('push', function () {
        $incident = Incident::latest()->first();//Incident::all()->random();
        $incident->status_id = Status::all()->random()->id;
        $incident->save();
//        $user = User::first();
//        Notification::send($user, new AccountActivate($user));
//        return redirect()->route('dashboard');
    });
    Route::get('/', 'HomeController@index')->name('dashboard')->middleware('verified');
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
    Route::get('api/incidents', 'IncidentController@jsonIndex');
    Route::get('json/types/{category}', 'TypeController@jsonShowByCategory');
    Route::get('json/categories/{type}', 'CategoryController@jsonShowByType');
    Route::get('api/system/categories', 'CategoryController@jsonIndex')->name('categories.index.json');
    Route::get('api/system/statuses', 'StatusController@jsonIndex')->name('statuses.json');

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

