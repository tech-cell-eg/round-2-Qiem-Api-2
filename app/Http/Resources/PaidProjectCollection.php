<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PaidProjectCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($project) {
            return [
                'id' => $project->id,
                'description' => $project->description,
                'comment' => $project->comment,
                'resume_file' => $project->resume_file,
                'status' => $project->status,
                'is_paid' => $project->is_paid ? 'مدفوع' : 'غير مدفوع',
                'created_at' => $project->created_at->format('Y-m-d H:i:s'),
            ];
        });
    }
}
