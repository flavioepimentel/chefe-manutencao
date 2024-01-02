<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VehicleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'vehicleName' => $this->vehicleName,
            'vehicleOwner' => $this->vehicleOwner,
            'vehicleModel' => $this->vehicleModel,
            'vehicleYear' => $this->vehicleYear,
            'vehiclePlate' => $this->vehiclePlate,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
