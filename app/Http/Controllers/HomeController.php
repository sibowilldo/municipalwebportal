<?php

namespace App\Http\Controllers;

use App\Category;
use App\Incident;
use App\Status;
use Auth;

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
        $statues = Status::all('id', 'name');
        $categories = Category::all('id', 'name');
        return view('dashboard', compact('incidents', 'statues', 'categories'));
    }
}
