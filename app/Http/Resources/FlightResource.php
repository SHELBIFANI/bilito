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
            'origin_id' => $this->origin_id,
            'destination_id' => $this->destination_id,
            'arrival' => $this->arrival,
            'departure' => $this->departure,
            'capacity' => $this->capacity,
            'price' => $this->price,
            'airline_id' => $this->airline_id,
        ];
    }
}
