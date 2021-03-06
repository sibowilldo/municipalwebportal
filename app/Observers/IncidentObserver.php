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
     * @param  \App\Incident  $incident
     * @return void
     */
    public function created(Incident $incident)
    {
        //
        event(new IncidentCreated($incident));
    }

    /**
     * Handle the incident "updated" event.
     *
     * @param  \App\Incident  $incident
     * @return void
     */
    public function updated(Incident $incident)
    {
        $message = $incident->name . " was updated!";
        //Check if the status was updated and send specific message to user
        if($incident->isDirty('status_id')) {
            $statuses = Status::all();
            $oldStatus = $statuses->where('id', $incident->getOriginal('status_id'))->first()->name;
            $newStatus =  $statuses->where('id', $incident->status_id)->first()->name;
            $message = "The status of the incident that you reported was changed from " . $oldStatus. " to " . $newStatus;
        }
        event(new IncidentUpdatedEvent($incident, $incident->users()->first(), $message));
    }

    /**
     * Handle the incident "deleted" event.
     *
     * @param  \App\Incident  $incident
     * @return void
     */
    public function deleted(Incident $incident)
    {
        //
    }

    /**
     * Handle the incident "restored" event.
     *
     * @param  \App\Incident  $incident
     * @return void
     */
    public function restored(Incident $incident)
    {
        //
    }

    /**
     * Handle the incident "force deleted" event.
     *
     * @param  \App\Incident  $incident
     * @return void
     */
    public function forceDeleted(Incident $incident)
    {
        //
    }
}
