<?php

namespace App\Events;

use App\Incident;
use App\Status;
use App\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class IncidentHistoryEntryEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $status;
    public $incident;
    public $reason;
    public $user;
    public $account_number="";

    /**
     * Create a new event instance.
     *
     * @param Status $status
     * @param Incident $incident
     * @param User $user
     * @param null $reason
     */
    public function __construct(Status $status, Incident $incident, User $user, $reason = null)
    {
        $this->status = $status;
        $this->incident = $incident;
        $this->user = $user;
        $this->reason = $reason;
    }
}
