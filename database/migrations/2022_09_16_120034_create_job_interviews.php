<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobInterviews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_interviews', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('job_id',false, true)->nullable();
            $table->integer('round_id',false, true)->nullable();
            $table->integer('passing_marks',false, true)->nullable();
            $table->integer('total_questions',false, true)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_interviews');
    }
}
