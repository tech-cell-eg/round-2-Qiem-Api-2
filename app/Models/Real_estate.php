<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Real_estate extends Model
{
    protected $table = 'real_estates';
    protected $fillable = [
        'type',
        'street',
        'district',
        'city',
        'area',
        'region',
        'advantages',
        'more_details',
        'client_id',
        'reviewer_id',
        'review_notes',
        'review_file',
    ];

    public function client(){
        return $this->belongsTo(User::class);
    }

    public function payments(){
        return $this->hasMany(Payment::class);
    }

    public function reviewers()
    {
        return $this->belongsTo(Reviewer::class, 'reviewer_id', 'reviewer_id');
    }
}
