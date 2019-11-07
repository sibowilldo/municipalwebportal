<?php

namespace App\Listeners;

use App\Events\IncidentCreated;
use App\Notifications\IncidentCreated as IncidentCreatedNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class IncidentCreatedListener
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
     * @param  IncidentCreated  $event
     * @return void
     */
    public function handle(IncidentCreated $event)
    {
        $event->user->notify(new IncidentCreatedNotification($event->user, $event->incident, $event->message));
    }
}
