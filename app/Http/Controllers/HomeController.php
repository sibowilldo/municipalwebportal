<?php

namespace App\Http\Controllers;

use App\Category;
use App\Incident;
use App\Status;
use App\Type;
use Auth;
use App\Http\Resources\Incident as IncidentResource;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statuses = Cache::remember('statuses', now()->addHour(), function () {
            return Status::where('model_type', 'App\Incident')->select('id', 'name')->get();
        });
        $categories = Cache::remember('categories', now()->addHour(), function () {
            return Category::all('id', 'name');
        });
        $types = Cache::remember('types', now()->addHour(), function () {
            return Type::all('id', 'name')->unique('name');
        });

        return view('dashboard', compact('statuses', 'categories', 'types'));
    }

    public function welcome()
    {
        if (!Auth::user()->fullname === 'Sibongiseni Msomi'){
            abort(404);
        }
        return view('welcome');
    }
}
