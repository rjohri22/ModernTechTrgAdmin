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
            $table->integer('oppertunity_id')->nullable();
            $table->integer('jobseeker_id')->nullable();
            $table->integer('hod_id')->nullable();
            $table->string('js_interview_datetime')->nullable();
            $table->dateTime('company_interview_datetime')->nullable();
            $table->integer('offer_salary')->nullable();
            $table->date('joining_date')->nullable();
            $table->string('jobseeker_remarks')->nullable();
            $table->integer('offer_letter_status')->nullable();
            $table->integer('status')->nullable();
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
