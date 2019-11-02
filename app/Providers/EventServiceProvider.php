<?php

namespace App\Providers;

use App\Events\DeviceEvent;
use App\Events\IncidentCreated;
use App\Events\IncidentUpdatedEvent;
use App\Events\SystemNotificationReadEvent;
use App\Listeners\DeviceCreatedListener;
use App\Listeners\IncidentCreatedListener;
use App\Listeners\FCMSendToDeviceListener;
use App\Listeners\IncidentUpdatedListener;
use App\Listeners\SystemNotificationReadListener;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        DeviceEvent::class => [
            DeviceCreatedListener::class
        ],
        IncidentCreated::class => [
            IncidentCreatedListener::class
        ],
        IncidentUpdatedEvent::class => [
            FCMSendToDeviceListener::class,
            IncidentUpdatedListener::class,
        ],
        SystemNotificationReadEvent::class => [
            SystemNotificationReadListener::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
