<?php

namespace App\Http\Controllers\Api;

use App\Device;
use App\Status;
use App\User;
use App\Http\Resources\User as UserResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\AccountActivate;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{

    /**
     * Create user
     *
     * @return \App\Http\Resources\User
     */
    public function signup(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'contactnumber' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed',
            'device_id' => 'required|string',
            'os' => 'required|string',
            'token'=> 'required|string'
        ]);
        $status = Status::where('name', 'unverified')->firstOrFail(); //ToDo set to unverified later

        $user = new User(
            [
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'contactnumber' => $request->contactnumber,
                'activation_token' => str_random(60), // ToDo set to str_random(60) later
                'email_verified_at' => null,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'status_id' => $status->id
            ]
        );
        $user->save();
        $roles = $request->roles;
        foreach ($roles as $role){
            $role = Role::findByName($role, 'api');
            $user->assignRole($role); //assign role(s) to user
        }

        //ToDo Add Device Info to database
        $device = new Device([
            'device_id' => $request->device_id,
            'os' => $request->os,
            'token' => $request->token,
            'is_active' => true
        ]);
        $device->save();

        $user->devices()->attach($device, ['is_verified' =>true, 'is_active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);

        //ToDo Enable later
        $user->notify(new AccountActivate($user)); //send account activation notification

        return new UserResource($user);
    }

    /**
     * Login user and create token
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);

        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Invalid Credentials'
            ], 401);
        }

        $user = $request->user();

        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);

        $token->save();

        return response()->json([
            'data' => new UserResource($user),
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString(),
            'message' => 'Signed in Successfully'
        ], 200);
    }

    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ], 200);
    }

    public function AccountActivate($token)
    {
        $user = User::where('activation_token', $token)->first();
        if (!$user) {
            return response()->json([
                'message' => 'This activation token is invalid.'
            ], 404);
        }
        $status = Status::where(['name'=>'active', 'group'=>'both'])->firstOrFail();
        $user->status_id = $status->id;
        $user->email_verified_at = Carbon::now();
        $user->activation_token = '';
        $user->save();

        return response()->json([
            'data' => new UserResource($user),
            'message' => 'Account Verified Successfully.'
        ], 200);
    }
}
