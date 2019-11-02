<?php

namespace App\Listeners;

use App\Events\DeviceEvent;
use Carbon\Carbon;

class DeviceCreatedListener
{
    /**
     * Handle the event.
     *
     * @param  DeviceEvent  $event
     * @return void
     */
    public function handle(DeviceEvent $event)
    {
        $event->user->devices()->attach($event->device,[
            'is_verified' =>true,
            'is_active' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()]);
    }
}
