<?php

namespace App\Listeners;

use App\Events\IncidentUpdatedEvent;
use App\Notifications\IncidentUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class IncidentUpdatedListener implements ShouldQueue
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
        $event->user->notify(new IncidentUpdated($event->user, $event->incident, $event->message));

    }
}
