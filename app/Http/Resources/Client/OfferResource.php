<?php

namespace App\Http\Resources\Client;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'company_id '=>$this->company_id,
            'status'=>$this->status,
            'real_estate_id'=>$this->real_estate_id,
            'real_estate'=>[
                'type' => $this->real_estate->type,
                'street' => $this->real_estate->street,
                'district' => $this->real_estate->district,
                'city' => $this->real_estate->city,
                'area' => $this->real_estate->area,
                'region' => $this->real_estate->region,
                'advantages' => $this->real_estate->advantages,
                'more_details' => $this->real_estate->more_details,
            ]
        ];
    }
}
