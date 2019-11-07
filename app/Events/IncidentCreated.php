<?php

namespace App\Events;

use App\Incident;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class IncidentCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $incident, $message, $user;

    /**
     * Create a new event instance.
     *
     * @param User $user
     * @param Incident $incident
     */
    public function __construct(User $user, Incident $incident)
    {
        $this->user = $user;
        $this->incident = $incident;
        $this->message = "You reported this incident: \"". $this->incident->name . "\"";
    }

    public function broadcastAs()
    {
        return 'newIncidentEvent';
    }

    public function broadcastOn()
    {
        return new Channel('newIncidentChannel');
    }
}
