<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Companies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->string('description')->nullable();
            $table->string('logo')->nullable();
            $table->string('company_type')->nullable();
            $table->integer('status')->nullable();
            $table->timestamps();
        });

        DB::table('companies')->insert(
            array(
                'name' => 'Modern tech',
                'country' => 'india',
                'state' => "",
                'city' => "",
                'address' => "",
                'description' => 1,
                'logo' => "",
                'company_type' => "1",
                'status' => "1",
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
