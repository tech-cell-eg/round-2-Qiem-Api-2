<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class TeamMember extends Model
{
    use HasFactory;

    protected $fillable = ['role','inspector_id','reviewer_id'];
    public function inspector()
    {
        return $this->belongsTo(Inspector::class,'inspector_id');
    }

    public function reviewer()
    {
        return $this->belongsTo(Reviewer::class,'reviewer_id');
    }
}
