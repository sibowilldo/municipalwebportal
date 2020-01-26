<?php

namespace App\Listeners;

use App\Events\IncidentUpdatedEvent;
use App\FCMNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class FCMSendToDeviceListener implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  IncidentUpdatedEvent  $event
     * @return void
     */
    public function handle(IncidentUpdatedEvent $event)
    {
        $devices = $event->user->devices()->get();
        if(count($devices)){
            foreach ($devices as $device){
                $fcm = new FCMNotification();
                if ($device->token){
                    $fcm->sendToDevice(
                        $device->token,
                        'Incident Updated',
                        $event->message,
                        ['user_id' => $event->user->uuid, 'incident_id' => $event->incident->id]);
                    Log::error("Device Token:" . $device->token . " send was attempted");

                }else{
                    Log::error("Device ID:" . $device->id . " token was null");
                }
            }
        }
    }
}
