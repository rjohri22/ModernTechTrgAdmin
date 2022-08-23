<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->integer('interview_id',false, true)->default(0);
            $table->integer('round_no',false, true)->default(0);
            $table->string('question','255');
            $table->string('option_a','255');
            $table->string('option_b','255');
            $table->string('option_c','255');
            $table->string('option_d','255');
            $table->string('correct_answer','10');
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
        Schema::dropIfExists('questions');
    }
}
