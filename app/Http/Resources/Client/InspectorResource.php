<?php

namespace App\Http\Resources\Client;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InspectorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'project_description'=>$this->description,
            'inspector' => ['name' => $this->name,
                'phone' => $this->phone,
                'years_of_experience' => $this->inspector->years_of_experience,
                'field_of_experience' => $this->inspector->field_of_experience,
            ]
        ];
    }
}
