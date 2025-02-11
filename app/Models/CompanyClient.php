<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompanyClient extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'authorization',
    ];

    /**
     * Get the user that owns the company client.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
