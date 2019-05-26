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
    public function user($id)
    {
        $user = User::findOrFail($id);

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

    public function incidents(int $id)
    {
        $user = User::findOrFail($id);
        $incidents = $user->incidents;

        return IncidentResource::collection($incidents);
    }
}

