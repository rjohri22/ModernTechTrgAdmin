<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertOptionPermission extends Migration
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
                'bend_id' => '1',
                'option_slug' => 'countries',
                'option_type' => 'form',
                'user_id' => 1,
                '_index' => 1,
                '_view' => 1,
                '_add' => 1,
                '_edit' => 1,
                '_delete' => 1,
                '_pdf' => 0,
                '_excel' => 0,
                '_email' => 0,
                '_print' => 0,
            ]
        );
        DB::table('option_permissions')->insert($data);
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
