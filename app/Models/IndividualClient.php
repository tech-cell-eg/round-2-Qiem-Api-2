<?php

namespace App\Models;

<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;
>>>>>>> main
use Illuminate\Database\Eloquent\Model;

class IndividualClient extends Model
{
<<<<<<< HEAD
    protected $fillable = ['user_id'];
    
=======
    use HasFactory;

    protected $fillable = [
        'user_id',
    ];

    /**
     * Get the user that owns the individual client.
     */
>>>>>>> main
    public function user()
    {
        return $this->belongsTo(User::class);
    }
<<<<<<< HEAD

=======
>>>>>>> main
}
