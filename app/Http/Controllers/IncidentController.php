<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\IncidentFormRequest;
use App\Status;
use App\Type;
use Illuminate\Http\Request;
use App\Http\Resources\Incident as IncidentResource;
use App\Incident;
use Auth;
use Carbon\Carbon;
class IncidentController extends Controller
{

    public function __construct() {
        $this->middleware(['auth']);//isAdmin middleware lets only users with a //specific permission permission to access these resources
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $incidents = Incident::with('users')->get()->sortByDesc('created_at');
        $statues = Status::all('id', 'name');
        $categories = Category::all('id', 'name');

        return view('backend.incidents.index', compact('incidents', 'statues', 'categories'));
    }

    public function jsonIndex()
    {

        $incidents = Incident::get()->sortBy('created_at');

        if(!count($incidents)){
            return response()->json([
                'data' => 'Nothing Found!',
                'message' => 'OK'
            ], 404);
        }
        return IncidentResource::collection($incidents);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(IncidentFormRequest $request)
    {

        $user = Auth::user();


        $incident = new Incident([
            'reference' => Carbon::now()->timestamp, //ToDo: Auto-Generate
            'name' => $request->name,
            'description' => $request->description,
            'location_description' => $request->location_description,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'suburb_id' => $request->suburb_id,
            'type_id' => $request->type_id,
            'status_id' => $request->status_id

        ]);
        $incident->save();
        $user->incidents()->attach($incident, ['has_location' => true, 'has_attachment' => false, 'source_id' => 0]);
        flash($incident->name . ' <b>Logged</b> Successfully')->success();


        return  redirect()->back(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $incident = Incident::findOrFail($id);
        return view('backend.incidents.show')->with('incident',$incident);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $incident = Incident::findOrFail($id);
        $categories = Category::pluck('name', 'id');
        $types = Type::pluck('name', 'id');

        return view('backend.incidents.edit', compact('incident','categories', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(IncidentFormRequest $request, $id)
    {
        $incident = Incident::findOrFail($id);
        $incident->update($request->only(['name', 'description', 'location_description', 'latitude', 'longitude', 'suburb_id', 'type_id', 'status_id']));

        flash($incident->name . ' <b>Updated</b> Successfully')->success();
        return  redirect()->back(201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $incident = Incident::findOrFail($id);
//        $incident->delete();

        return response()->json([
            "message"=> $incident->name . ' was sent to trash.',
            "url" => route('dashboard')
        ], 200);
    }

}
