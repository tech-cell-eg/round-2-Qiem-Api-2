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
        'resume_file'
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
    public function paymentProject(){
        return $this->hasOne(Payment::class);
    }
    public function inspector()
    {
        return $this->belongsTo(Inspector::class,'inspector_id');
    }

    public function clinet()
    {
        return $this->belongsTo(User::class);
    }
}
