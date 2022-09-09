<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionAttemptTbl08092022 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_attempts', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id',false, true)->nullable();
            $table->integer('job_id',false, true)->nullable();
            $table->integer('round_id',false, true)->nullable();
            $table->integer('department_id',false, true)->nullable();
            $table->string('question',255)->nullable();
            $table->integer('question_type',false, true)->nullable();
            $table->string('option_a',255)->nullable();
            $table->string('option_b',255)->nullable();
            $table->string('option_c',255)->nullable();
            $table->string('option_d',255)->nullable();
            $table->string('user_answer',255)->nullable();
            $table->string('correct_answer',10)->nullable();
            $table->integer('mark',false, true)->nullable();
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
        Schema::dropIfExists('question_attempts');
    }
}
