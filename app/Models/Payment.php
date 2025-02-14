<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [

        'id',
        'project_id',
        'amount',
        'Payment_date',
        'status',
        'real_estates_id'
    ];

    // realation with real estate
    public function real_estate(){
        return $this->belongsTo(Real_estate::class,'real_estates_id');
    }

    public function project(){
        return $this->belongsTo(Project::class,'project_id');
    }
}
