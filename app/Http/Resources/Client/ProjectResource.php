<?php

namespace App\Http\Resources\Client;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'status' => $this->status,
            'real_estate' => [
                'type' => $this->offer->real_estate->type,
                'street' => $this->offer->real_estate->street,
                'district' => $this->offer->real_estate->district,
                'city' => $this->offer->real_estate->city,
                'area' => $this->offer->real_estate->area,
                'region' => $this->offer->real_estate->region,
                'advantages' => $this->offer->real_estate->advantages,
                'more_details' => $this->offer->real_estate->more_details,
            ],
        ];
    }


}
