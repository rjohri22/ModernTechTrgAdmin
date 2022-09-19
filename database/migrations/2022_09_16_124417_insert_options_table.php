<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $data=array(
            'module_name' => 'Job Seeker',
            'module_code' => '0007',
            'active' => '1',
            'redirect_link' => 'admin.job_seeker'
        );
        DB::table('modules')->insert($data);

        $data=array(
            'option_name' => 'Job Seeker',
            'option_slug' => 'job_seeker',
            'module_id' => '7',
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
            'redirect_link' => 'admin.job_seeker'
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
