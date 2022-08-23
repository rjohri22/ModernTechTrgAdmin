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
            $table->string('name',255)->nullable();
            $table->string('country',100)->nullable();
            $table->string('state',100)->nullable();
            $table->string('city',100)->nullable();
            $table->string('address',150)->nullable();
            $table->string('description',300)->nullable();
            $table->string('logo',255)->nullable();
            $table->string('company_type',10)->nullable();
            $table->tinyInteger('status',false, true)->default(0)->nullable()->comment('0 => Inactive, 1 => Active');
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
