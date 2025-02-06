<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory,Notifiable;
    use HasRoles; // لإضافة دعم الأدوار والأذونات

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'city',
    ];

    /**
     * Get the individual client associated with the user.
     */
    public function individualClient()
    {
        return $this->hasOne(IndividualClient::class);
    }

    /**
     * Get the company client associated with the user.
     */
    public function companyClient()
    {
        return $this->hasOne(CompanyClient::class);
    }

    /**
     * Get the inspector associated with the user.
     */
    public function inspector()
    {
        return $this->hasOne(Inspector::class);
    }

    /**
     * Get the evaluation company associated with the user.
     */
    public function evaluationCompany()
    {
        return $this->hasOne(EvaluationCompany::class);
    }
}
