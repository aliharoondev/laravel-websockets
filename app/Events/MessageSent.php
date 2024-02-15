<?php

namespace App\Events;

use App\Models\Chat;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $sender;
    public $receiverId;

    /**
     * Create a new event instance.
     */
    public function __construct($message, $sender, $receiverId)
    {
        $this->message = $message;
        $this->sender = $sender;
        $this->receiverId = $receiverId; // Assign receiverId

        logger($this->message);
    }

    public function broadcastOn()
    {
        return new PrivateChannel('chat.1.2');
    }
}
