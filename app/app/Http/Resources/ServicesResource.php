<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServicesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'serviceName' => $this->serviceName,
            'shortDescription' => $this->shortDescription,
            'specialty' => $this->specialty,
            'coast' => $this->coast,
            'price' => $this->price,
            'items' => $this->items,
            'averegeTime' => $this->averegeTime,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
