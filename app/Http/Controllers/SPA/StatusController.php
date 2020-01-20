<?php

namespace App\Http\Controllers\SPA;

use App\Http\Requests\StatusFormRequest;
use App\Http\Resources\StatusResource;
use App\Status;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $statuses = Status::all();
        return response()->json([
            'data'=> StatusResource::collection($statuses)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StatusFormRequest $request
     * @return void
     */
    public function store(StatusFormRequest $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param Status $status
     * @return JsonResponse
     */
    public function show(Status $status)
    {
        return response()->json([
            'data' => new StatusResource($status),
            'links' => [
                '_self' => route('spa.statuses.show', $status->id),
                '_index' => route('spa.statuses.index')
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StatusFormRequest $request
     * @param Status $status
     * @return void
     */
    public function update(StatusFormRequest $request, Status $status)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return void
     */
    public function destroy($id)
    {
        //
    }
}
