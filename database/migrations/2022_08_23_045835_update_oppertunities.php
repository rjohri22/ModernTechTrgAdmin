<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOppertunities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('oppertunities', function (Blueprint $table) {
            $table->string('daily_job',500)->nullable();
            $table->string('team_engagement',500)->nullable();
            $table->string('reporting',500)->nullable();
            $table->string('Responsibilities',500)->nullable();
            $table->string('profile',500)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
