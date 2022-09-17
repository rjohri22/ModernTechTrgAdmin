<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUserTbl07092022 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('country_code',100)->nullable();
            $table->string('occupation',100)->nullable();
            $table->tinyInteger('curruntly_employeed',false, true)->default(0);
            $table->string('total_work_experience',100)->nullable();
            $table->string('last_job_title',255)->nullable();
            $table->string('last_job_company_name',255)->nullable();
            $table->string('last_job_company_duration',255)->nullable();
            $table->string('annual_inhand_salary',100)->nullable();
            $table->string('curruncy',100)->nullable();
            $table->string('recent_industries',100)->nullable();
            $table->string('available_to_join',100)->nullable();
            $table->string('education',100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table) {
            $table->dropColumn('country_code');
            $table->dropColumn('occupation');
            $table->dropColumn('curruntly_employeed');
            $table->dropColumn('total_work_experience');
            $table->dropColumn('last_job_title');
            $table->dropColumn('last_job_company_name');
            $table->dropColumn('last_job_company_duration');
            $table->dropColumn('annual_inhand_salary');
            $table->dropColumn('curruncy');
            $table->dropColumn('recent_industries');
            $table->dropColumn('available_to_join');
            $table->dropColumn('education');
        });
    }
}
