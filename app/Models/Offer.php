<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = [
        'company_id',
        'real_estate_id',
        'details',
        'amount',
        'status',
        'client_id'
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function real_estate()
    {
        return $this->belongsTo(Real_estate::class, 'real_estate_id');
    }

    public function scopeFilterByStatus($query, $status)
    {
        return $query->when($status, function ($q) use ($status) {
            return $q->where('status', $status);
        });
    }

    public function project()
    {
        return $this->hasOne(Project::class);

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
