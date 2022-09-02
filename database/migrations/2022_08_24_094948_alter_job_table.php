<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterJobTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->integer('objective_id',false, true)->default(0);
            $table->integer('round_1_question',false, true)->default(0);
            $table->integer('round_2_question',false, true)->default(0);
            $table->integer('round_3_question',false, true)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jobs', function($table) {
            $table->dropColumn('objective_id');
            $table->dropColumn('round_1_question');
            $table->dropColumn('round_2_question');
            $table->dropColumn('round_3_question');
        });
    }
}
