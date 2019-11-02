<?php

namespace App\Listeners;

use App\Events\SystemNotificationReadEvent;
use Carbon\Carbon;

class SystemNotificationReadListener
{
    /**
     * Handle the event.
     * Update the read_at field
     *
     * @param  SystemNotificationReadEvent  $event
     * @return void
     */
    public function handle(SystemNotificationReadEvent $event)
    {
        $notification = $event->notification;

        //Only if the read_at field is null
        if(!$notification->read_at){
            $notification->update(['read_at' => Carbon::now()]);
        }
    }
}
