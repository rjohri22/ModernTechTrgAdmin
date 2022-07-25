<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Oppertunities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oppertunities', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('company_id');
            $table->integer('min_salary');
            $table->integer('max_salary');
            $table->integer('salary_type');
            $table->integer('job_type');
            $table->integer('work_type');
            $table->string('summery');
            $table->string('description');
            $table->date('expires_on');
            $table->integer('no_of_positions');
            $table->integer('urgent_hiring');
            $table->date('modified_by');
            $table->integer('status');
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
        Schema::dropIfExists('oppertunities');
    }
}
