<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'gateway_ref' => $this->gateway_ref,
            'flight' => FlightResource::make($this->whenLoaded('flight')),
            'user' => UserResource::make($this->whenLoaded('user')),
            'passengers'=> PassengerResource::collection($this->whenLoaded('passengers')),
            'payments' => PaymentResource::collection($this->whenLoaded('payments')),
        ];
    }
}
