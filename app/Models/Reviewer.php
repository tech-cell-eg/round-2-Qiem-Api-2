<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reviewer extends Model
{
    use HasFactory;

    protected $fillable = ['experience', 'bio', 'evaluation_company_id'];
    protected $primaryKey = 'reviewer_id';


    public function properties()
    {
        return $this->belongsToMany(RealEstate::class,'reviewer_id', 'reviewer_id');
    }
}
