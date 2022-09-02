<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableOptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('options', function (Blueprint $table) {
            $table->increments('id');
            $table->string('option_name',255);
            $table->string('option_slug',255);
            $table->integer('module_id',false, true)->default(0);
            $table->string('option_type',255)->default('form');
            $table->tinyInteger('_index',false, true)->default(0);
            $table->tinyInteger('_view',false, true)->default(0);
            $table->tinyInteger('_add',false, true)->default(0);
            $table->tinyInteger('_edit',false, true)->default(0);
            $table->tinyInteger('_delete',false, true)->default(0);
            $table->tinyInteger('_pdf',false, true)->default(0);
            $table->tinyInteger('_excel',false, true)->default(0);
            $table->tinyInteger('_email',false, true)->default(0);
            $table->tinyInteger('_print',false, true)->default(0);
            $table->tinyInteger('active',false, true)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('options');
    }
}
