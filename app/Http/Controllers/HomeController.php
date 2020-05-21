<?php

namespace App\Http\Controllers;

use App\Category;
use App\Incident;
use App\Status;
use App\Type;
use Auth;
use App\Http\Resources\Incident as IncidentResource;

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
        $incidents = Incident::with('users')->get()->sortByDesc('created_at');
        $statuses = Status::where('model_type', 'App\Incident')->select('id', 'name')->get();
        $categories = Category::all('id', 'name');
        $types = Type::all('id', 'name')->unique('name');
        return view('dashboard', compact('incidents','statuses', 'categories', 'types'));
    }

    public function welcome()
    {
        if (!Auth::user()->fullname === 'Sibongiseni Msomi'){
            abort(404);
        }
        return view('welcome');
    }
}
