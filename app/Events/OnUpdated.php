<?php
namespace App\Events;

use App;
use App\I18n\Translation;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OnUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $model;
    public $data;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($model, $data)
    {
        $this->model = $model;
        $this->data = $data;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('on-updated');
    }
}
