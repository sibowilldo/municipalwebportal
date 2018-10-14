<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
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
}

