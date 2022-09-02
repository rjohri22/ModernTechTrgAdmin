<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateNavigations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $data = array(
            'option_name' => 'Interview Objectives',
            'option_slug' => 'interview-objective',
            'module_id' => '2',
            'option_type' => 'form',
            'redirect_link' => 'admin.interview_objectives',
            'active' => '1',
         );

         DB::table('options')->insert($data);


        $data_2 = array(
            'bend_id' => '1',
            'option_slug' => 'interview-objective',
            'option_type' => 'form',
            'user_id' => '0',
            '_index' => '1',
         );

         DB::table('option_permissions')->insert($data_2);
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
