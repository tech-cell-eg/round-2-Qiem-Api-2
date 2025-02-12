<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'company_id',
        'tax_number',
        'authorization'
    ];
    public function requests()
    {
        return $this->hasMany(Request::class);
    }
}
