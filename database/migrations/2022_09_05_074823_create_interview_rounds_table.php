<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterviewRoundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interview_rounds', function (Blueprint $table) {
            $table->id();
            $table->integer('profile_id',false, true)->default(0);
            $table->integer('interview_time',false, true)->default(0);
            $table->integer('created_by',false, true)->default(0);
            $table->timestamps();
            $table->integer('status',false, true)->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('interview_rounds');
    }
}
