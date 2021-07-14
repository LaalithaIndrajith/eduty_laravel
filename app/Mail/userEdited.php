<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class userEdited extends Mailable
{
    use Queueable, SerializesModels;
    
    public $user;
    public $updatedBy;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$updatedBy)
    {
        $this->user      = $user;
        $this->updatedBy = $updatedBy;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('User Details Updated')->markdown('emails.user.edit');
    }
}

