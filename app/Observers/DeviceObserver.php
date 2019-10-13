<?php

namespace App\Observers;

use App\Device;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DeviceObserver
{
    /**
     * Handle the device "created" event.
     *
     * @param  \App\Device  $device
     * @return void
     */
    public function created(Device $device)
    {
        Auth::user()->devices()->attach($device,[
            'is_verified' =>true,
            'is_active' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()]);
    }

    /**
     * Handle the device "updated" event.
     *
     * @param  \App\Device  $device
     * @return void
     */
    public function updated(Device $device)
    {
        //
    }

    /**
     * Handle the device "deleted" event.
     *
     * @param  \App\Device  $device
     * @return void
     */
    public function deleted(Device $device)
    {
        //
    }

    /**
     * Handle the device "restored" event.
     *
     * @param  \App\Device  $device
     * @return void
     */
    public function restored(Device $device)
    {
        //
    }

    /**
     * Handle the device "force deleted" event.
     *
     * @param  \App\Device  $device
     * @return void
     */
    public function forceDeleted(Device $device)
    {
        //
    }
}
