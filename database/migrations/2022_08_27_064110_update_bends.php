<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateBends extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $data = array(
            'name' => 'CEO',
            'band_type' => '0',
         );

         DB::table('bends')->where('name','OWNER')->where('band_type','1')->update($data);


         $data = array(
            'name' => 'HRManager',
            'band_type' => '0',
            'level' => '6',
            'status' => '1',
            'special'=> '0',

         );

         DB::table('bends')->insert($data);
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
