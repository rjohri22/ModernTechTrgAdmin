<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeCirtificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_cirtificates', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('title',255)->nullable();
            $table->string('institute_name',255)->nullable();
            $table->date('period_from')->nullable();
            $table->date('period_to')->nullable();
            $table->string('description',300)->nullable();
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
        Schema::dropIfExists('employee_cirtificates');
    }
}
