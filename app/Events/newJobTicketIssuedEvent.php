<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class newJobTicketIssuedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $client;
    public $jobTicketDetails;
    public $taskflow;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($client,$jobTicketDetails, $taskflow)
    {
        $this->client           = $client;
        $this->jobTicketDetails = $jobTicketDetails;
        $this->taskflow         = $taskflow;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
