<?php

namespace App\Http\Resources\Client;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Real_estateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => $this->type,
            'street' => $this->street,
            'district' => $this->district,
            'city' => $this->city,
            'area' => $this->area,
            'region' => $this->region,
            'advantages' => $this->advantages,
            'more_details' => $this->more_details,
        ];
    }
}
