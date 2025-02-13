<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'company_id',
        'offer_id',
        'status',
        'description',
        'comment',
        'resume_file',
        'is_paid',
    ];

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }

    public function scopeFilterByStatus($query, $status)
    {
        return $query->when($status, function ($q) use ($status) {
            return $q->where('status', $status);
        });
    }
      public function property()
    {
        return $this->belongsTo(Real_estate::class);
    }
}
