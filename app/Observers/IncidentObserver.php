<?php

namespace App\Observers;

use App\Events\IncidentCreated;
use App\Events\IncidentUpdatedEvent;
use App\Incident;
use App\Status;
use Auth;

class IncidentObserver
{
    /**
     * Handle the incident "created" event.
     *
     * @param Incident $incident
     * @return void
     */
    public function created(Incident $incident)
    {
        event(new IncidentCreated($incident->user()?:Auth::user(), $incident));
    }

    /**
     * Handle the incident "updated" event.
     *
     * @param Incident $incident
     * @return void
     */
    public function updated(Incident $incident)
    {
        $message =  "You reported this incident: $incident->name";

//        Check if the status was updated and send specific message to user
        if($incident->isDirty('status_id')) {
            $statuses = Status::whereIn('id', [$incident->getOriginal('status_id'),  $incident->status_id])->get();
            $oldStatus = $statuses->where('id', $incident->getOriginal('status_id'))->first()->name;
            $newStatus =  $statuses->where('id', $incident->status_id)->first()->name;
            $message = "Incident Status changed from " . strtoupper($oldStatus). " to " . strtoupper($newStatus);
        }
        event(new IncidentUpdatedEvent($incident, $incident->user(), $message));
    }
}
