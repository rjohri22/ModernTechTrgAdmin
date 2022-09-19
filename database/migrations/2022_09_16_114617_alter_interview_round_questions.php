<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterInterviewRoundQuestions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('interview_round_questions', function (Blueprint $table) {
            $table->integer('interview_time',false, true)->default(0);
            $table->string('disclaimer',255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('interview_round_questions', function($table) {
            $table->integer('interview_time',false, true)->default(0);
            $table->dropColumn('disclaimer');
        });
    }
}
