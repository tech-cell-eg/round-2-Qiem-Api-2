<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{

    protected $fillable = ['copmany_id' , 'details' , 'amount' , 'file' , 'status'];
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
