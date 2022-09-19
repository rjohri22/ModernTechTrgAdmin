<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePermissionOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $data=array(
            'redirect_link' => 'admin.employees'
        );
        DB::table('modules')->where('id',5)->update($data);

        $data=array(
            'redirect_link' => 'admin.employees'
        );
        DB::table('options')->where('id',12)->update($data);


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
