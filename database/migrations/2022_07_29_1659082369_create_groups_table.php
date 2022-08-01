<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    public function up()
    {

        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('title',100)->nullable();
            $table->string('description',500)->nullable(); 
            $table->string('active',1)->default(0)->nullable()->comment('0 => Inactive, 1 => Active');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('groups');
    }
}