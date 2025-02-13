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

    public function requests()
    {
        return $this->hasMany(Request::class);
    }

    public function user(){
        return $this->belongsTo(User::class,'client_id');
    }
}
