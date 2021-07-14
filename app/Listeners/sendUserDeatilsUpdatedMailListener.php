<?php

namespace App\Listeners;

use App\Mail\userEdited;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class sendUserDeatilsUpdatedMailListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        Mail::to("laalithagajanayake@gmail.com")->send(new userEdited($event->user, $event->updatedBy));  
    }
}
