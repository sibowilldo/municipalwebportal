<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\StateColorResource;
use App\StateColor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class StateColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        $stateColors = StateColor::all();
        return StateColorResource::collection($stateColors);
    }

    /**
     * Display the specified resource.
     *
     * @param  StateColor $stateColor
     * @return StateColorResource
     */
    public function show(StateColor $stateColor)
    {
        return new StateColorResource($stateColor);
    }
}
