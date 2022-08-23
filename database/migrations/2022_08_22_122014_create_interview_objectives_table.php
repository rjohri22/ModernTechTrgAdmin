<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterviewObjectivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interview_objectives', function (Blueprint $table) {
            $table->id();
            $table->string('name','255');
            $table->integer('round_1_passing_marks',false, true)->default(0);
            $table->integer('round_2_passing_marks',false, true)->default(0);
            $table->integer('round_3_passing_marks',false, true)->default(0);
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
        Schema::dropIfExists('interview_objectives');
    }
}
