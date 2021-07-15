<?php

namespace App\Providers;

use App\Events\userCreatedEvent;
use App\Events\userDetailsUpdatedEvent;
use App\Listeners\sendUserCreatedMailListener;
use App\Listeners\sendUserDeatilsUpdatedMailListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        userDetailsUpdatedEvent::class => [
            sendUserDeatilsUpdatedMailListener::class,
        ],
        userCreatedEvent::class => [
            sendUserCreatedMailListener::class,
        ],
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
