<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BendLocations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_locations', function (Blueprint $table) {
            $table->id();
    		$table->integer('company_id')->nullable();
    		$table->integer('country_id')->nullable();
    		$table->integer('state_id')->nullable();
            $table->integer('city')->nullable();
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
        Schema::dropIfExists('business_locations');
    }
}
