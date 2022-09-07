<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterviewRoundQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interview_round_questions', function (Blueprint $table) {
            $table->id();
            $table->integer('interview_round_id',false, true)->default(0);
            $table->integer('round_id',false, true)->default(0);
            $table->integer('department_id',false, true)->default(0);
            $table->string('question','255');
            $table->integer('question_type',false, true)->default(0);
            $table->string('option_a','255')->nullable();
            $table->string('option_b','255')->nullable();
            $table->string('option_c','255')->nullable();
            $table->string('option_d','255')->nullable();
            $table->string('correct_answer','255');
            $table->integer('marks',false, true)->default(0);
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
        Schema::dropIfExists('interview_round_questions');
    }
}
