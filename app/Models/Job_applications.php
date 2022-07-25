<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Job_applications extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'oppertunity_id',
        'jobseeker_id',
        'hod_id',
        'js_interview_datetime',
        'company_interview_datetime',
        'offer_salary',
        'joining_date',
        'jobseeker_remarks',
        'offer_letter_status',
        'status',
    ];
}
