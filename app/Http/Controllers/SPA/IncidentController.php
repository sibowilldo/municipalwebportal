<?php

namespace App\Http\Controllers\SPA;

use App\Http\Controllers\Controller;
use App\Http\Requests\IncidentFormRequest;
use App\Http\Resources\Incident as IncidentResource;
use App\Incident;
use Auth;
use Carbon\Carbon;
use EloquentBuilder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class IncidentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        $incidents = EloquentBuilder::to(Incident::class, request()->except(['page', 'per_page']))->where('created_at', '<', Carbon::now());
        return IncidentResource::collection($incidents->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param IncidentFormRequest $request
     * @return IncidentResource
     */
    public function store(IncidentFormRequest $request)
    {
        $user = null;
        $incident = Incident::create($request->all());
        //If incident is public or user opted to be notified about the incident

        //ToDo: Get user information
        //else
        Auth::user()->incidents()->attach($incident, ['has_location' => true, 'has_attachment' => false, 'source_id' => 0]);
        return new IncidentResource($incident);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
