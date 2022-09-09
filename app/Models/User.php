<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'group_id',
        'email',
        'password',
        'phone',
        'address',
        'first_name',
        'last_name',
        'country',
        'state',
        'city',
        'postal_code',
        'address_primary',
        'address_secondary',
        'headline',
        'summery',
        'addition_information',
        'skills',
        'resume_type',
        'status',
        'desired_job_title',
        'desired_salary',
        'desired_period',
        'desired_jobtype',
        'resume_attachment',
        'country_code',
        'occupation',
        'curruntly_employeed',
        'total_work_experience',
        'last_job_title',
        'last_job_company_name',
        'last_job_company_duration',
        'annual_inhand_salary',
        'recent_industries',
        'available_to_join',
        'education',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
