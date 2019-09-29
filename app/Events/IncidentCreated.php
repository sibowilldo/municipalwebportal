<?php

namespace App\Events;

use App\Incident;
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

    public $incident;
    public $message;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Incident $incident)
    {
        $this->incident = $incident;
        $this->message = " was created!";
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
