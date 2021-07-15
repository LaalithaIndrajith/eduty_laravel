<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class userCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $createdBy;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$createdBy)
    {
        $this->user      = $user;
        $this->createdBy = $createdBy;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New User Created')->markdown('emails.user.create');
    }
}
