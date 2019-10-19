<?php

namespace App\Http\Controllers\Api;


use App\Http\Resources\Incident as IncidentResource;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\User as UserResource;

class UserController extends Controller
{

    /**
     * Get the authenticated User
     *
     * @return \App\Http\Resources\User
     */
    public function show($user)
    {
        return new UserResource($user);
    }

    /**
     * Get the authenticated User
     *
     * @return \App\Http\Resources\User
     */
    public function profile()
    {
        $user = Auth::user();
        return new UserResource($user);
    }

    public function incidents($user)
    {
        return IncidentResource::collection($user->incidents);
    }
}

