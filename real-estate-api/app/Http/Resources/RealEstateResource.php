<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RealEstateResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'real_state_type' => $this->real_state_type,
            'street' => $this->street,
            'external_number' => $this->external_number,
            'internal_number' => $this->internal_number,
            'neighborhood' => $this->neighborhood,
            'city' => $this->city,
            'country' => $this->country,
            'rooms' => $this->rooms,
            'bathrooms' => $this->bathrooms,
            'comments' => $this->comments,
        ];
    }
}
