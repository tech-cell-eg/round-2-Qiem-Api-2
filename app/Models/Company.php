<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'company_id',
        'tax_number',
        'authorization',
        'balance',
        'outstanding_balance',
    ];
    public function requests()
    {
        return $this->hasMany(Request::class);
    }
}
