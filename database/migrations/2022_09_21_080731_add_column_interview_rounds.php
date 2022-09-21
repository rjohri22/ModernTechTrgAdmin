<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInterviewRounds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('interview_rounds', function (Blueprint $table) {
            $table->string('disclaimer',1000)->nullable();
        });

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('interview_rounds', function($table) {
            $table->dropColumn('disclaimer');
        });
    }
}
