<?php

namespace App\Observers;

use App\Events\IncidentCreated;
use App\Events\IncidentStatusUpdated;
use App\Incident;
use Illuminate\Support\Facades\Log;

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
        event(new IncidentStatusUpdated($incident));
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
