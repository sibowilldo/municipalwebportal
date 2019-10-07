<?php

namespace App\Observers;

use App\Events\IncidentCreated;
use App\Events\IncidentStatusUpdated;
use App\Events\IncidentUpdatedEvent;
use App\FCMNotification;
use App\Incident;
use App\Status;
use Illuminate\Support\Facades\Log;
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
        $message = null;
        //Check if the status was updated and send specific message to user
        if($incident->isDirty('status_id')) {
            $oldStatus = Status::where('id', $incident->getOriginal('status_id'))->firstOrFail();
            $message = "The status of the incident that you reported was changed from " . $oldStatus->name . " to " . $incident->status->name;
        }
        event(new IncidentUpdatedEvent($incident, Auth::user(), $message));


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
