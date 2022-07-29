<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentsTable extends Migration
{
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {

		$table->integer('id',11)->unsigned();
		$table->string('title')->nullable()->default('NULL');
		$table->string('description',500)->nullable()->default('NULL');
		$table->integer('hod_id',11)->nullable()->default('NULL');
		$table->tinyInteger('active',1)->default('0');
		$table->datetime('created_at')->nullable()->default('NULL');
		$table->datetime('updated_at')->nullable()->default('NULL');
		$table->primary('id');

        });
    }

    public function down()
    {
        Schema::dropIfExists('departments');
    }
}