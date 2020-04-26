<?php

namespace App\Listeners;

use App\Events\IncidentHistoryEntryEvent;
use App\IncidentHistory;

class IncidentHistoryEntryListener
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
     * @param  IncidentHistoryEntryEvent  $event
     * @return void
     */
    public function handle(IncidentHistoryEntryEvent $event)
    {
        IncidentHistory::create([
            'incident_id' => $event->incident->id,
            'previous_status' => $event->status->id,
            'status_id' => $event->incident->status_id,
            'user_id' => $event->user->id,
            'account_number' => $event->account_number,
            'update_reason' => $event->reason]);
    }
}
