<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Real_estate extends Model
{
    protected $fillable = [
        'type',
        'street',
        'district',
        'city',
        'area',
        'region',
        'advantages',
        'more_details',
        'client_id'
    ];

    public function client(){
        return $this->belongsTo(User::class);
    }

    public function payments(){
        return $this->hasMany(Payment::class);
    }
}
