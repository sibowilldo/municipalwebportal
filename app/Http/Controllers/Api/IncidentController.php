<?php

namespace App\Http\Controllers\Api;

use App\Incident;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Incident as IncidentResource;
use App\Http\Resources\IncidentCollection;
use App\Http\Resources\UserCollection;

class IncidentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\Resources\IncidentCollection
     */
    public function index()
    {
        $incidents = Incident::with('users')->get()->sortBy('created_at');

        if(!count($incidents)){
            return response()->json([
                'data' => 'Nothing Found!',
                'message' => 'OK'
            ], 404);
        }
        return IncidentResource::collection($incidents);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::findOrFail($request->user_id);

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

        $user->incidents()->attach($incident);

        dd($user->with('incidents')->all());
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
