<?php

namespace App\Http\Controllers;

use App\Status;
use App\Type;
use Illuminate\Http\Request;
use App\Incident;
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
        $statues = Status::all('id', 'name');
        $types = Type::all('id', 'name');

//        dd($incidents);

        return view('dashboard', compact('incidents', 'statues', 'types'));
    }

}
