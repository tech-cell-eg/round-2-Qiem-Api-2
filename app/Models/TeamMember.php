<?php
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
