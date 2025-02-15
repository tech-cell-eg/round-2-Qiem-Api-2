<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $fillable = [
        'company_id',
        'real_estate_id',
        'message',
        'status',
    ];
    public function company()
{
    return $this->belongsTo(Company::class, 'company_id', 'company_id');
}
    public function real_estate()
    {
        return $this->belongsTo(Real_estate::class);
    }
}
