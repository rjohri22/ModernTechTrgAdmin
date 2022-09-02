<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateJobTbl31082022 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->string('work_shift',100)->nullable();
            $table->string('work_style',100)->nullable();
            $table->string('hr_remarks',100)->nullable();
            $table->integer('country_head_approval',false)->nullable();
            $table->string('compensation_mode',100)->nullable();
            $table->integer('hr_head_approval',false)->nullable();
            $table->integer('round_1_pass_mark',false)->nullable();
            $table->integer('round_2_pass_mark',false)->nullable();
            $table->integer('round_3_pass_mark',false)->nullable();
            $table->string('oppertunity_id',100)->nullable();
            $table->string('job_unique_id',100)->nullable();
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
            $table->dropColumn('work_shift');
            $table->dropColumn('work_style');
            $table->dropColumn('hr_remarks');
            $table->dropColumn('country_head_approval');
            $table->dropColumn('compensation_mode');
            $table->dropColumn('hr_head_approval');
            $table->dropColumn('round_1_pass_mark');
            $table->dropColumn('round_2_pass_mark');
            $table->dropColumn('round_3_pass_mark');
            $table->dropColumn('oppertunity_id');
            $table->dropColumn('job_unique_id');
        });
    }
}
