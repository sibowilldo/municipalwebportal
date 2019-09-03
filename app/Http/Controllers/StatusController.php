<?php

namespace App\Http\Controllers;

use App\StateColor;
use App\Status;
use Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statuses = Status::all();
        return view('backend.statuses.index', compact('statuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $state_colors = StateColor::all();
        $groups = Status::$groups;
        return view('backend.statuses.create', compact('state_colors', 'groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['is_active'] = $request->is_active === 'on' ? true:false;
        $status = Status::create($request->only('name', 'description','group', 'state_color_id', 'is_active'));
        flash(ucfirst($status->name) . ' created successfully')->success();
        return redirect()->action('StatusController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Status $status)
    {
        return view('backend.statuses.show', compact('status'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Status $status)
    {
        $state_colors = StateColor::all();
        $groups = Status::$groups;
        return view('backend.statuses.edit', compact('status', 'state_colors', 'groups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Status $status)
    {
        $state_color = StateColor::findOrFail($request->state_color_id);
        $status->name = $request->name;
        $status->description = $request->description;
        $status->group = $request->group;
        $status->state_color_id = $state_color->id;
        $status->is_active = $request->is_active ? true : false;
        $status->update();

        flash(ucfirst($status->name) . ' created successfully')->success();
        return redirect()->action('StatusController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Status $status)
    {
        try{
            $status->delete();
        }catch(QueryException $e){
            return response()->json([
                "title"=>'Deleting this status is not allowed!',
                "message"=>'CODE: ' .$e->getCode()
            ], 500);
        }
        return response()->json([
            "message"=> $status->name . ' was deleted successfully',
            "url" => route('statuses.index')
        ], 200);
    }

    public function jsonIndex()
    {
        $data = [];
        $statuses = Status::all();
        foreach ($statuses as $status){
            $newStatus = new JsonStatuses(ucfirst($status->name), $status->state_color->css_class);
            $data[$status->id]=$newStatus;
        }
        return response()->json(['data' => $data]);
    }
}

//Formatted Statuses
class JsonStatuses{
//    public $id;
    public $title;
    public $class;

    public function __construct($title, $class)
    {
//        $this->id = $id;
        $this->title = $title;
        $this->class = $class;
    }
}
