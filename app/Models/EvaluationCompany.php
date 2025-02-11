<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EvaluationCompany extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tax_number',
        'authorization',
    ];

    /**
     * Get the user that owns the evaluation company.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
