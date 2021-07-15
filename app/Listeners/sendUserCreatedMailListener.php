<?php

namespace App\Listeners;

use App\Mail\userCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class sendUserCreatedMailListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        Mail::to("laalithagajanayake@gmail.com")->send(new userCreated($event->user, $event->createdBy)); 
    }
}
