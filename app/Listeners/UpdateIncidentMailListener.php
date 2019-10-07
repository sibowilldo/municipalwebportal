<?php

namespace App\Listeners;

use App\Events\IncidentUpdatedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateIncidentMailListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  IncidentUpdatedEvent  $event
     * @return void
     */
    public function handle(IncidentUpdatedEvent $event)
    {
        //Todo: Send mail notification
//        dump("Mail: " .$event->user .  ", ". $event->incident->name . ", ". $event->message);
    }
}
