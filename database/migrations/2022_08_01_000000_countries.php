<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Countries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $data = array(
            [
                'name' => 'China',
                'code' => 'CN',
                'active' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Taiwan',
                'code' => 'TW',
                'active' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],

        );
        Schema::create('countries', function (Blueprint $table) {
            // $table->id();
            $table->increments('id');
            $table->string('name',100);
            $table->string('code',100)->nullable();
            $table->tinyInteger('active', false, true)->default(0)->index()->comment('0 => Inactive, 1 => Active');
            $table->timestamps();
        });

        DB::table('countries')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
    }
}
