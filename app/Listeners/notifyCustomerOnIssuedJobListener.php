<?php

namespace App\Listeners;

use App\Mail\newJobTicketIssued;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class notifyCustomerOnIssuedJobListener
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
        Mail::to($event->client->client_email)->send(new newJobTicketIssued($event->client, $event->jobTicketDetails,  $event->taskflow)); 
    }
}
