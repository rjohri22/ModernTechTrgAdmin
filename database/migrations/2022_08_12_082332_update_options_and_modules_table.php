<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOptionsAndModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $rows = array(
            [
                'id' => '1',
                'redirect_link' => 'dashboard'
            ],
            [
                'id' => '2',
                'redirect_link' => 'dashboard'
            ],
            [
                'id' => '3',
                'redirect_link' => 'dashboard'
            ],
            [
                'id' => '4',
                'redirect_link' => 'admin.bends'
            ],
            [
                'id' => '5',
                'redirect_link' => 'admin.job_seeker'
            ],
            [
                'id' => '6',
                'redirect_link' => 'admin.business_locations'
            ]
        );
        foreach($rows as $row){
            DB::table('modules')->where('id', $row['id'])->update(['redirect_link'=>$row['redirect_link']]);
        }
        $rows2 = array(
            [
                'id' => '1',
                'redirect_link' => 'admin.oppertunities'
            ],
            [
                'id' => '2',
                'redirect_link' => 'admin.jobs'
            ],
            [
                'id' => '3',
                'redirect_link' => 'admin.job_seeker'
            ],
            [
                'id' => '4',
                'redirect_link' => 'admin.groups'
            ],
            [
                'id' => '5',
                'redirect_link' => 'admin.oppertunities'
            ],
            [
                'id' => '6',
                'redirect_link' => 'admin.designations'
            ],
            [
                'id' => '7',
                'redirect_link' => 'admin.states'
            ],
            [
                'id' => '8',
                'redirect_link' => 'admin.cities'
            ],
            [
                'id' => '9',
                'redirect_link' => 'admin.busniess'
            ],
            [
                'id' => '10',
                'redirect_link' => 'admin.setting.emailsmtp'
            ],
            [
                'id' => '11',
                'redirect_link' => 'admin.bends'
            ],
            [
                'id' => '12',
                'redirect_link' => 'admin.job_seeker'
            ],
            [
                'id' => '13',
                'redirect_link' => 'admin.business_locations'
            ]
        );
        foreach($rows2 as $row){
            DB::table('options')->where('id', $row['id'])->update(['redirect_link'=>$row['redirect_link']]);
        }
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
