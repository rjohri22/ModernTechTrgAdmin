<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Busniess extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bands', function (Blueprint $table) {
            $table->id();
    		$table->string('name',255)->nullable();
    		$table->tinyInteger('band_type',false, true)->default('0')->comment('1 => Businness Specific, 2 => Country Specific');
    		$table->tinyInteger('status',false, true)->default('0')->comment('0 => Inactive, 1 => Active');
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
        Schema::dropIfExists('bands');
    }
}
