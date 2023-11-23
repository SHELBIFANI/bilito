<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FlightResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'arrival' => $this->arrival,
            'departure' => $this->departure,
            'capacity' => $this->capacity,
            'price' => $this->price,
            'origin_id' => $this->origin,
            'destination_id' => $this->destination,
            'airline_id' => $this->airline,
        ];
    }
}
