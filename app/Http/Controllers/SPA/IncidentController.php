<?php

namespace App\Http\Controllers\SPA;

use App\Http\Controllers\Controller;
use App\Http\Requests\IncidentFormRequest;
use App\Http\Resources\Incident as IncidentResource;
use App\Incident;
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
        $incidents = EloquentBuilder::to(Incident::class, request()->except(['page', 'per_page']));
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
        $payload = [
                "name" => "Trashed",
                "description" => "Because I is lazy AF to type these 2 fields",
                "location_description" => "39 Dales Ave, New Germany, Pinetown, 3620, South Africa",
                "longitude" => "30.86103539999999",
                "latitude" => "-29.8159511",
                "category_id" => 2,
                "type_id" => 2,
                "status_id" => 7,
                "suburb_id" => 0
                ];
        $incident = Incident::create($payload);
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
