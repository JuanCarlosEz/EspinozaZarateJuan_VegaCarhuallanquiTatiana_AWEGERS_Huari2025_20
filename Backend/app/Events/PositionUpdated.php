<?php

namespace App\Events;

use App\Models\Vehicle;
use App\Models\VehiclePosition;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PositionUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $vehicle;
    public $position;

    /**
     * Create a new event instance.
     */
    public function __construct(Vehicle $vehicle, VehiclePosition $position)
    {
        $this->vehicle = $vehicle;
        $this->position = $position;
    }

    /**
     * Canal donde se transmitirá el evento (puedes ajustarlo).
     */
    public function broadcastOn(): Channel
    {
        return new PrivateChannel('vehicle.' . $this->vehicle->id);
    }

    /**
     * Nombre del evento en frontend.
     */
    public function broadcastAs()
    {
        return 'position.updated';
    }
}
