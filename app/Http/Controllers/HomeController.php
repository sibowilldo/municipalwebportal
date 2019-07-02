<?php

namespace App\Http\Controllers;

use App\Category;
use Auth;
use App\Status;
use App\Type;
use App\Incident;
use Carbon\Carbon;

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

    public function chart_types()
    {
        $data = [];
        $types = Type::all();
        $incidents = Incident::whereDate('created_at', '2019-06-14')->get();
        foreach ($types as $type){
            $series = new Series($type->name, $type->state_color, count($incidents->where('category_id', $type->categories()->first()->id)));
            array_push($data, $series);
        }
        return response()->json($data);
    }
}

class Series{
    public $label;
    public $color;
    public $data;

    public function __construct($label, $color, $data)
    {
        $this->label = $label;
        $this->color = $color;
        $this->data = $data;
    }
}
