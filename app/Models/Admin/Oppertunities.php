<?php

namespace App\Models\Admin;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Oppertunities extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'company_id',
        'min_salary',
        'max_salary',
        'salary_type',
        'job_type',
        'work_type',
        'summery',
        'description',
        'expires_on',
        'no_of_positions',
        'urgent_hiring',
        'created_at',
        'updated_at',
        'modified_by',
        'status',
    ];
}
