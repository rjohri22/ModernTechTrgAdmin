<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignationsTable extends Migration
{
    public function up()
    {
        Schema::create('designations', function (Blueprint $table) {
            $table->id();
            $table->string('title',255)->nullable();
    		$table->string('description',500)->nullable();
    		$table->tinyInteger('active',false, true)->default(0)->comment('0 => Inactive, 1 => Active');
    		$table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('designations');
    }
}