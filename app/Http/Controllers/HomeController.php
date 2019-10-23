<?php

namespace App\Http\Controllers;

use App\Category;
use App\Incident;
use App\Status;
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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $incidents = Incident::with('users')->get()->sortByDesc('created_at');
        $statuses = Status::whereIn('group', ['incidents', 'both'])->select('id', 'name')->get();
        $categories = Category::all('id', 'name');
        return view('dashboard', compact('incidents', 'statuses', 'categories'));
    }

    public function welcome()
    {
        if (!Auth::user()->fullname === 'Sibongiseni Msomi'){
            abort(404);
        }
        return view('welcome');
    }
}
