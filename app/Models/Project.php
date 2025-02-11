<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'offer_id',
        'inspector_id',
        'status',
        'description',
        'comment',
        'resume_file',
        'is_paid',
    ];
    public function inspector()
    {
        return $this->belongsTo(Inspector::class, 'inspector_id');
    }
}
