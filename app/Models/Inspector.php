<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inspector extends Model
{
    use HasFactory;

    protected $fillable = [
        'national_id',
        'years_of_experience',
        'field_of_experience',
        'fee',
        'account_balance',
        'outstanding_balance',

    ];
    public function projects()
        {
            return $this->hasMany(Project::class, 'inspector_id');
        }

}
