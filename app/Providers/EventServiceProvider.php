<?php

namespace App\Providers;

use App\Events\DeviceEvent;
use App\Events\IncidentUpdatedEvent;
use App\Listeners\DeviceCreatedListener;
use App\Listeners\FCMSendToDeviceListener;
use App\Listeners\UpdateIncidentMailListener;
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
        IncidentUpdatedEvent::class => [
            FCMSendToDeviceListener::class,
            UpdateIncidentMailListener::class,
        ],
        DeviceEvent::class => [
            DeviceCreatedListener::class
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
