<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable,HasApiTokens;
    use HasRoles; 

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'city',
        'mobile_number',
        'street',
        'district',
        'city',
        'role',
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

    public function realEstates()
    {
        return $this->hasMany(Real_estate::class);
    }
}
