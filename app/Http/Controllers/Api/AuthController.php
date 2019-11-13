<?php

namespace App\Http\Controllers\Api;

use App\Device;
use App\Events\DeviceEvent;
use App\Http\Controllers\Controller;
use App\Http\Resources\User as UserResource;
use App\Notifications\AccountActivate;
use App\Status;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
            'token'=> 'string'
        ]);
        $status = Status::where('name', 'active')->firstOrFail(); //ToDo set to unverified later

        $user = new User(
            [
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'contactnumber' => $request->contactnumber,
                'activation_token' => '', //str_random(60), // ToDo set to str_random(60) later
                'email_verified_at' => Carbon::now(), //null, ToDo: Set to Null
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

        //Add Device to database
        $device = new Device([
            'device_id' => $request->device_id,
            'os' => $request->os,
            'token' => $request->token
        ]);
        $device->save();

        //NB: Devices are attached using DeviceEvent -> DeviceCreatedListener
        event(new DeviceEvent($user, $device));

        //send account activation notification
        $user->notify(new AccountActivate($user));

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

        //check if user is verified
        if ($user->email_verified_at == null) {
            return response()->json([
                'message' => 'Account not verified'
            ], 403);
        }

        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);

        $token->save();

        //if device with same device_id and os exists [update token], else [create new device]
        $device = Device::updateOrCreate(
            ['device_id' => $request->input('device.device_id'), 'os'=>$request->input('device.os')],
            ['token'=>$request->input('device.token')]
        );
        Log::info(
            'device_id: '. $request->input('device.device_id')
            . ' os: '.$request->input('device.os')
            . ' token '.$request->input('device.token'));
        $device->save();

        if($device->wasRecentlyCreated){
            //NB: Devices are attached using DeviceEvent -> DeviceCreatedListener
            event(new DeviceEvent($user, $device));
            Log::info('Device:'. $device->id . ' was created');
        }else{
            Log::info('Device:'.$device->id . ' was updated');
        }

        return response()->json([
            'message' => 'Signed in Successfully',
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString(),
            'data' => new UserResource($user)
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
