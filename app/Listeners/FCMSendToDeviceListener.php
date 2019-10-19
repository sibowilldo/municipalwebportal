<?php

namespace App\Listeners;

use App\Events\IncidentUpdatedEvent;
use App\FCMNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class FCMSendToDeviceListener
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
                $fcm->sendToDevice(
                            $device->token,
                        'Incident Updated',
                            $event->message,
                            ['user_id' => $event->user->id, 'incident_id' => $event->incident->id]);
            }
        }
    }
}
