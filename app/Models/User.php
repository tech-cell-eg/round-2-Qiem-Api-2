<?php

namespace App\Models;

use App\Models\CompanyClient;
use App\Models\IndividualClient;
use App\Models\EvaluationCompany;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    use HasFactory,Notifiable,HasApiTokens;
    use HasRoles;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'city',
        'street',
        'district',
        'city',
        'role',
        'whatsapp_link',
        'comments',
        'sms_number',
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

    /**
     * Get the evaluation company associated with the user.
     */
    public function evaluationCompany()
    {
        return $this->hasOne(EvaluationCompany::class);
    }
    public function inspector()
    {
        return $this->hasOne(Inspector::class, 'user_id');
    }

    public function realEstates()
    {
        return $this->hasMany(Real_estate::class);
    }
    public function teamMember()
    {
        return $this->hasOne(TeamMember::class, 'user_id');
    }

}

