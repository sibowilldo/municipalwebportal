<?php

namespace App\Http\Controllers\Api;

use App\Device;
use App\Events\DeviceEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordFormRequest;
use App\Http\Resources\User as UserResource;
use App\Notifications\AccountActivate;
use App\Status;
use App\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response as HTTPResponse;

class AuthController extends Controller
{
    use SendsPasswordResetEmails, ResetsPasswords {
        SendsPasswordResetEmails::broker insteadof ResetsPasswords;
        ResetsPasswords::credentials insteadof SendsPasswordResetEmails;
    }

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create user
     *
     * @return UserResource
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
            'token' => $request->token,
            'is_active' => true
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
     * @param Request $request
     * @return Response
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
            ], HTTPResponse::HTTP_UNAUTHORIZED);
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
            ['token'=>$request->input('device.token'), 'is_active' => true]
        );
        Log::info( 'login request ' . $request);
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
        ], HTTPResponse::HTTP_OK);
    }

    /**
     * Logout user (Revoke the token)
     *
     * @param Request $request
     * @return JsonResponse [string] message
     */
    public function logout(Request $request)
    {
        $device = Device::where('device_id', $request->device_id)->first();
        if($device){
            $device->update(['is_active' => false]);
            $device->save();
        }
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ], HTTPResponse::HTTP_OK);
    }

    /**
     * Change password of the logged in user
     *
     * @param ChangePasswordFormRequest $request
     * @return false|string
     */
    public function changePassword(ChangePasswordFormRequest $request) {
        $user = Auth::guard('api')->user();

        //check the old password first
        $check_old  = Auth::guard('web')->attempt([
            'email' => $user->email,
            'password' => $request->old_password
        ]);

        //if it doesn't match, assume brute force attack and (revoke token) log user out.
        if(!$check_old){
            $user->token()->revoke();
            return response()->json([
                'message' => 'The old password you entered does not match our records. For security reasons your session has been terminated, please login to try again!'
            ], HTTPResponse::HTTP_UNAUTHORIZED);
        }

        $user->password = bcrypt($request->password);

        $user->token()->revoke();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        $user->save();

        return response()->json([
            'message' => 'Your password was changed successfully',
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $token->expires_at
            )->toDateTimeString(),
            'data' => new UserResource($user)
        ], HTTPResponse::HTTP_OK);
    }

    /**
     * Activates user Account
     *
     * @param $token
     * @return JsonResponse
     */
    public function AccountActivate($token)
    {
        $user = User::where('activation_token', $token)->first();
        if (!$user) {
            return response()->json([
                'message' => 'This activation token is invalid.'
            ], HTTPResponse::HTTP_NOT_FOUND);
        }
        $status = Status::where(['name'=>'active', 'group'=>'both'])->firstOrFail();
        $user->status_id = $status->id;
        $user->email_verified_at = Carbon::now();
        $user->activation_token = '';
        $user->save();

        return response()->json([
            'data' => new UserResource($user),
            'message' => 'Account Verified Successfully.'
        ], HTTPResponse::HTTP_OK);
    }

    /**
     * Send password reset link.
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
    public function sendPasswordResetLink(Request $request)
    {
        return $this->sendResetLinkEmail($request);
    }

    /**
     * Get the response for a successful password reset link.
     *
     * @param Request $request
     * @param  string  $response
     * @return RedirectResponse|JsonResponse
     */
    protected function sendResetLinkResponse(Request $request, $response)
    {
        return response()->json([
            'message' => 'Password reset email sent.'
        ]);
    }
    /**
     * Get the response for a failed password reset link.
     *
     * @param Request $request
     * @param  string  $response
     * @return RedirectResponse|JsonResponse
     */
    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        return response()->json(['message' => 'Email could not be sent to this email address.']);
    }

    /**
     * Handle reset password
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
    public function callResetPassword(Request $request)
    {
        return $this->reset($request);
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
     * @param  string  $password
     * @return void
     */
    protected function resetPassword($user, $password)
    {
        $user->password = Hash::make($password);
        $user->save();
        event(new PasswordReset($user));
    }

    /**
     * Get the response for a successful password reset.
     *
     * @param Request $request
     * @param  string  $response
     * @return RedirectResponse|JsonResponse
     */
    protected function sendResetResponse(Request $request, $response)
    {
        return response()->json(['message' => 'Password reset successfully.']);
    }
    /**
     * Get the response for a failed password reset.
     *
     * @param Request $request
     * @param  string  $response
     * @return RedirectResponse|JsonResponse
     */
    protected function sendResetFailedResponse(Request $request, $response)
    {
        return response()->json(['message' => 'Failed, Invalid Token.']);
    }
}
