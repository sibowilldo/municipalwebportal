<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Incident as IncidentResource;
use App\Incident;
use Auth;
use Carbon\Carbon;
class IncidentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
//        dd($incidents);
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
    public function store(Request $request)
    {
        //
//        dd($request->all());

        $user = Auth::user();

        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'location_description' => 'required|string',
            'latitude' => 'required|string',
            'longitude' => 'required|string',
            'suburb_id' => 'required',
        ]);

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
//        dd($incident->id);

        $user->incidents()->attach($incident, ['has_location' => true, 'has_attachment' => false, 'source_id' => 0]);

        return  redirect()->action('HomeController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
