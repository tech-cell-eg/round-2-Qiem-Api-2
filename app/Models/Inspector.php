<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inspector extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'inspection_fee',
        'national_id',
        'certificate',
        'province', // المحافظة
        'area',     // المنطقة
        'balance', // رصيد الحساب
        'outstanding_balance', // الرصيد المستحق
    ];

    /**
     * Get the user that owns the inspector.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
