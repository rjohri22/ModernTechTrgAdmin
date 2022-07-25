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
            $table->integer('oppertunity_id');
            $table->integer('jobseeker_id');
            $table->integer('hod_id');
            $table->string('js_interview_datetime');
            $table->dateTime('company_interview_datetime');
            $table->integer('offer_salary');
            $table->date('joining_date');
            $table->string('jobseeker_remarks');
            $table->integer('offer_letter_status');
            $table->integer('status');
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
