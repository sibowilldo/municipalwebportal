<?php

namespace App\Http\Controllers\Api;

use App\Device;
use App\Events\DeviceEvent;
use App\Http\Resources\DeviceResource;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DeviceResource::collection(Device::all());
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return DeviceResource
     */
    public function store(Request $request)
    {
        $user = User::whereUuid($request->user)->firstOrFail();

        $device = new Device([
            'device_id' => $request->device_id,
            'os' => $request->os,
            'token' => $request->token,
            'is_active' => true
        ]);
        $device->save();

        //NB: Devices are attached using DeviceEvent -> DeviceCreatedListener
        event(new DeviceEvent($user, $device));

        return new DeviceResource($device);
    }

    /**
     * Display the specified resource.
     *
     * @param Device $device
     * @return DeviceResource
     */
    public function show(Device $device)
    {
        return new DeviceResource($device);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Device $device
     * @return DeviceResource
     */
    public function update(Request $request, Device $device)
    {
        $device->update($request->only(['device_id', 'os', 'token']));
        return new DeviceResource($device);
    }

    /**
     * @param Request $request
     * @param $device_id
     * @return DeviceResource
     */
    public function updateToken(Request $request, $device_id)
    {

        //if device with same device_id and os exists [update token], else [create new device]
        $device = Device::updateOrCreate(
            ['device_id' => $request->device_id, 'os'=>$request->os],
            ['token'=>$request->token]
        );

        //NB: Devices are attached using DeviceEvent -> DeviceCreatedListener
        event(new DeviceEvent(Auth::user(), $device));

        return new DeviceResource($device);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Device $device
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Device $device)
    {
        $device->users()->detach();
        $device->delete();
        return response()->json(['message'=>'Device Deleted Successfully!'], 200);
    }
}
