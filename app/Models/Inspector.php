<?php

namespace App\Models;

use App\Models\InspectorReport;
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
        'province',
        'area',
        'account_balance',
        'outstanding_balance',
    ];

    /**
     * Get the user that owns the inspector.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function projects()
    {
        return $this->hasMany(Project::class, 'inspector_id');
    }
    public function reports()
    {
        return $this->hasMany(InspectorReport::class, 'inspector_id','inspector_id');
    }
}
