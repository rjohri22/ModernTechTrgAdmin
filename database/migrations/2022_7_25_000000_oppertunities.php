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
            $table->string('title')->nullable();
            $table->integer('company_id')->nullable();
            $table->integer('min_salary')->nullable();
            $table->integer('max_salary')->nullable();
            $table->integer('salary_type')->nullable();
            $table->integer('job_type')->nullable();
            $table->integer('work_type')->nullable();
            $table->string('summery')->nullable();
            $table->string('description')->nullable();
            $table->date('expires_on')->nullable();
            $table->integer('no_of_positions')->nullable();
            $table->integer('urgent_hiring')->nullable();
            $table->integer('modified_by')->nullable();
            $table->integer('status')->nullable();
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
