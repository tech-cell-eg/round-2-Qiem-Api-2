<?php

namespace App\Http\Resources\Client;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'client_id'=>$this->real_estate->client_id,
            'payment_id' => $this->id,
            'amount' => $this->amount,  // Assuming Payment has an amount field
            'payment_date' => $this->payment_date,  // Assuming there's a payment_date field
            'real_estate' => [
                'type' => $this->real_estate->type,
                'street' => $this->real_estate->street,
                'district' => $this->real_estate->district,
                'city' => $this->real_estate->city,
                'area' => $this->real_estate->area,
                'region' => $this->real_estate->region,
                'advantages' => $this->real_estate->advantages,
                'more_details' => $this->real_estate->more_details,
            ],
        ];
    }
}
