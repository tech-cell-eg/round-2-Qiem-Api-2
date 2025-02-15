<?php

namespace App\Http\Resources\Company;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaidProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'project_details' => [
                'description' => $this->project->description,
                'comment' => $this->project->comment,
            ],
            'real_estate' => [
                'type' => $this->real_estate->type,
                'street'=>$this->real_estate->street,
                'district'=>$this->real_estate->district,
                'city' =>$this->real_estate->city,
            ],
        ];
    }
}
