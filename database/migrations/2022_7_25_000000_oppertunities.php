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
            $table->string('title',500)->nullable();
            $table->integer('company_id',false)->nullable();
            $table->integer('min_salary',false)->nullable();
            $table->integer('max_salary',false)->nullable();
            $table->tinyInteger('salary_type',false, true)->nullable()->comment('1 => MOnthly, 2=> Yearly, 3=> daily');
            $table->tinyInteger('job_type',false, true)->nullable()->comment('1 => Internship, 2=> Fresher, 3=> Experienced');
            $table->tinyInteger('work_type',false, true)->nullable()->comment('1 => Part Time, 2=> Full Time');
            $table->text('summery')->nullable();
            $table->text('description')->nullable();
            $table->date('expires_on')->nullable();
            $table->integer('no_of_positions',false)->nullable();
            $table->tinyInteger('urgent_hiring',false, true)->nullable()->comment('0 => No, 1=> Yes');
            $table->integer('modified_by',false)->nullable();
            $table->tinyInteger('status',false, true)->nullable()->comment('1 => Open, 0 => Closed');
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
