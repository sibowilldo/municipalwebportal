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

class IncidentUpdatedEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Information about the shipping status update.
     *
     * @var string
     */
    public $incident;
    public $message;
    public $user;

    /**
     * Create a new event instance.
     *
     * @param Incident $incident
     * @param User $user
     * @param null $message
     */
    public function __construct(Incident $incident, User $user, $message=null)
    {
        $this->user = $user;
        $this->incident = $incident;
        $this->message = $message?:$incident->name . " was updated!";
    }

    public function broadcastAs()
    {
        return 'incidentUpdatedEvent';
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('incidentUpdatedChannel');
    }
}
