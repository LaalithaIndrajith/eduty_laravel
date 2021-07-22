<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class newJobTicketIssued extends Mailable
{
    use Queueable, SerializesModels;
    public $client;
    public $jobTicketDetails;
    public $taskflow;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($client,$jobTicketDetails,$taskflow)
    {
        $this->client           = $client;
        $this->jobTicketDetails = $jobTicketDetails;
        $this->taskflow         = $taskflow;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Job ticket is issued to your requirement')->markdown('emails.jobTickets.issue');
    }
}
