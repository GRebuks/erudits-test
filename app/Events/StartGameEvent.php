<?php

namespace App\Events;

use App\Models\Test;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StartGameEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $testId;

    /**
     * Create a new event instance.
     */
    public function __construct($id)
    {
        $this->testId = $id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel
     */
    public function broadcastOn(): Channel
    {
        return new Channel('start-' . $this->testId);
    }

    public function broadcastAs()
    {
        return 'start';
    }

    public function broadcastWith(): array {
        return [
            'test' => Test::findOrFail($this->testId),
            'message' => 'GAME START!',
        ];
    }
}
