<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class JobApplications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->integer('oppertunity_id',false)->nullable();
            $table->integer('jobseeker_id',false)->nullable();
            $table->integer('hod_id',false)->nullable();
            $table->string('js_interview_datetime',100)->nullable();
            $table->dateTime('company_interview_datetime')->nullable();
            $table->integer('offer_salary',false)->nullable();
            $table->date('joining_date')->nullable();
            $table->string('jobseeker_remarks',255)->nullable();
            $table->tinyInteger('offer_letter_status',false, true)->default(0)->nullable()->comment('0 => Pending, 1=> Approved, 2=> Rejetc');
            $table->tinyInteger('status',false, true)->default(0)->nullable()->comment('0 => pending, 1=> Shorlisted, 2=> Rejected, 3=> INterviewd, 4=> ONboarding, 5=>Hiring');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_applications');
    }
}
