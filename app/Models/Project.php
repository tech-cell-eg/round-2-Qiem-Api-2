<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['property_id' , 'status' , 'is_paid'];
    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
