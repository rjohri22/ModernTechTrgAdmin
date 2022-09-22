<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOptionsAndModelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $data=array(
            'module_name' => 'Rounds',
            'module_code' => 'rounds',
            'active' => '1',
            'redirect_link' => 'admin.jobapplications'
        );
        DB::table('modules')->insert($data);
        $data=array(
            'option_name' => 'Job Applications',
            'option_slug' => 'job_applications',
            'module_id' => '8',
            'option_type' => 'form',
            '_index' => '0',
            '_view' => '0',
            '_add' => '0',
            '_edit' => '0',
            '_delete' => '0',
            '_pdf' => '0',
            '_excel' => '0',
            '_email' => '0',
            '_print' => '0',
            'active' => '1',
            'redirect_link' => 'admin.jobapplications'
        );
        DB::table('options')->insert($data);
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
