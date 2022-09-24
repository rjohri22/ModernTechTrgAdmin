<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePermissionTbl24092022 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $data_module=array(
            'module_name' => 'Calender',
            'module_code' => 'calender',
            'active' => '1',
            'redirect_link' => 'admin.calendar'
        );
        DB::table('modules')->insert($data_module);


        $data_master=array(
            'option_name' => 'Calender',
            'option_slug' => 'calender',
            'module_id' => '9',
            'option_type' => 'form',
            '_index' => '0',
            '_view' => '0',
            '_add' => '0',
            '_edit' => '0',
            '_delete' => '0',
            'active' => '1',
            'redirect_link' => 'admin.calendar'
        );
        DB::table('options')->insert($data_master);

        $data=array(
            array(
                'bend_id' => '1',
                'option_slug' => 'interview_rounds',
                'option_type' => 'form',
                'user_id' => '0',
                '_index' => '1',
                '_view' => '1',
                '_add' => '1',
                '_edit' => '1',
                '_delete' => '1',
                '_pdf' => '1',
            ),
            array(
                'bend_id' => '1',
                'option_slug' => 'rounds',
                'option_type' => 'form',
                'user_id' => '0',
                '_index' => '1',
                '_view' => '1',
                '_add' => '1',
                '_edit' => '1',
                '_delete' => '1',
                '_pdf' => '1',
            ),
            array(
                'bend_id' => '1',
                'option_slug' => 'job_seeker',
                'option_type' => 'form',
                'user_id' => '0',
                '_index' => '1',
                '_view' => '1',
                '_add' => '1',
                '_edit' => '1',
                '_delete' => '1',
                '_pdf' => '1',
            ),
            array(
                'bend_id' => '1',
                'option_slug' => 'job_applications',
                'option_type' => 'form',
                'user_id' => '0',
                '_index' => '1',
                '_view' => '1',
                '_add' => '1',
                '_edit' => '1',
                '_delete' => '1',
                '_pdf' => '1',
            ),
            array(
                'bend_id' => '1',
                'option_slug' => 'calender',
                'option_type' => 'form',
                'user_id' => '0',
                '_index' => '1',
                '_view' => '1',
                '_add' => '1',
                '_edit' => '1',
                '_delete' => '1',
                '_pdf' => '1',
            ),
        );
        DB::table('option_permissions')->insert($data);

        $update=array(
            'active' => 0
        );
        DB::table('options')->where('id','14')->update($update);
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
