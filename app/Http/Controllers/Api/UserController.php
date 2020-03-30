<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Resources\Incident as IncidentResource;
use App\Http\Resources\User as UserResource;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    /**
     * Get the authenticated User
     *
     * @return UserResource
     */
    public function show($user)
    {
        return new UserResource($user);
    }

    /**
     * Get the authenticated User
     *
     * @return UserResource
     */
    public function profile()
    {
        $user = Auth::user();
        return new UserResource($user);
    }

    /**
     * Update User
     *
     * @param Request $request
     * @param User $user
     * @return UserResource
     */
    public function update(Request $request, User $user)
    {

        //Validate name, email and password fields
        $request->validate(
            [
                'firstname'=>'required|max:120',
                'lastname'=>'required|max:120',
                'contactnumber'=>'required|max:20'
            ]
        );

        $input = $request->only(['firstname', 'lastname', 'contactnumber']); //Retreive the name, email and password fields
        $user->fill($input)->save();

        return new UserResource($user);
    }

    /**
     * @param $user
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function incidents($user)
    {
        return IncidentResource::collection($user->incidents);
    }
}

