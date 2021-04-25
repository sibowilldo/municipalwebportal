<?php

namespace App\Http\Controllers;

use App\Http\Requests\StatusFormRequest;
use App\StateColor;
use App\Status;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Cache;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $statuses = Status::with('state_color')->select('id', 'name', 'description', 'model_type', 'is_active', 'state_color_id')->get();
        $model_types = Status::$model_types;

        return view('backend.statuses.index', compact('statuses', 'model_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $state_colors = StateColor::all();
        $model_types = Status::$model_types;
        return view('backend.statuses.create', compact('state_colors', 'model_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StatusFormRequest $request)
    {
        if(Status::statusExists($request->name, $request->model_type))
            return back()->withErrors('A status with the same Name and Associated Group selection already exists')->withInput();


        $request['is_active'] = $request->is_active === 'on';

        $status = Status::create($request->only('name', 'description', 'model_type', 'state_color_id', 'is_active'));
        flash(ucfirst($status->name) . ' created successfully')->success();
        return redirect()->action('StatusController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param Status $status
     * @return \Illuminate\Http\Response
     */
    public function show(Status $status)
    {
        $model_types = Status::$model_types;
        return view('backend.statuses.show', compact('status', 'model_types'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Status $status
     * @return \Illuminate\Http\Response
     */
    public function edit(Status $status)
    {
        $state_colors = StateColor::all();
        $model_types = Status::$model_types;
        return view('backend.statuses.edit', compact('status', 'state_colors', 'model_types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Status $status
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StatusFormRequest $request, Status $status)
    {
        $statusExists = Status::statusExists($request->name, $request->model_type);

        if($statusExists && $statusExists->id !=$status->id)
            return back()->withErrors('A status with the same Name and Associated Group selection already exists')->withInput();

        $request['state_color_id'] = StateColor::findOrFail($request->state_color_id)->id;
        $request['is_active'] = $request->is_active === 'on';

        $status->update();

        $status->update($request->only('name', 'description', 'model_type', 'state_color_id', 'is_active'));
        flash(ucfirst($status->name) . ' updated successfully')->success();
        return redirect()->action('StatusController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Status $status
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
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
