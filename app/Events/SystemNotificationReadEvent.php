<?php

namespace App\Events;

use App\SystemNotification;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SystemNotificationReadEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $notification;

    /**
     * Create a new event instance.
     *
     * @param SystemNotification $notification
     */
    public function __construct(SystemNotification $notification)
    {
        $this->notification = $notification;
    }
}
