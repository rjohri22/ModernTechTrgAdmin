<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertBandPermission extends Migration
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
                'option_slug' => 'job-description',
                'option_type' => 'form',
                'user_id' => 0,
                '_index' => 1,
                '_view' => 0,
                '_add' => 0,
                '_edit' => 0,
                '_delete' => 0,
                '_pdf' => 0,
                '_excel' => 0,
                '_email' => 0,
                '_print' => 0,
            ],
            [
                'bend_id' => '1',
                'option_slug' => 'jobs',
                'option_type' => 'form',
                'user_id' => 0,
                '_index' => 1,
                '_view' => 0,
                '_add' => 0,
                '_edit' => 0,
                '_delete' => 0,
                '_pdf' => 0,
                '_excel' => 0,
                '_email' => 0,
                '_print' => 0,
            ],
            [
                'bend_id' => '1',
                'option_slug' => 'approved-jobs',
                'option_type' => 'form',
                'user_id' => 0,
                '_index' => 1,
                '_view' => 0,
                '_add' => 0,
                '_edit' => 0,
                '_delete' => 0,
                '_pdf' => 0,
                '_excel' => 0,
                '_email' => 0,
                '_print' => 0,
            ],
            [
                'bend_id' => '1',
                'option_slug' => 'groups',
                'option_type' => 'form',
                'user_id' => 0,
                '_index' => 1,
                '_view' => 0,
                '_add' => 0,
                '_edit' => 0,
                '_delete' => 0,
                '_pdf' => 0,
                '_excel' => 0,
                '_email' => 0,
                '_print' => 0,
            ],
            [
                'bend_id' => '1',
                'option_slug' => 'departments',
                'option_type' => 'form',
                'user_id' => 0,
                '_index' => 1,
                '_view' => 0,
                '_add' => 0,
                '_edit' => 0,
                '_delete' => 0,
                '_pdf' => 0,
                '_excel' => 0,
                '_email' => 0,
                '_print' => 0,
            ],
            [
                'bend_id' => '1',
                'option_slug' => 'designations',
                'option_type' => 'form',
                'user_id' => 0,
                '_index' => 1,
                '_view' => 0,
                '_add' => 0,
                '_edit' => 0,
                '_delete' => 0,
                '_pdf' => 0,
                '_excel' => 0,
                '_email' => 0,
                '_print' => 0,
            ],
            [
                'bend_id' => '1',
                'option_slug' => 'states',
                'option_type' => 'form',
                'user_id' => 0,
                '_index' => 1,
                '_view' => 0,
                '_add' => 0,
                '_edit' => 0,
                '_delete' => 0,
                '_pdf' => 0,
                '_excel' => 0,
                '_email' => 0,
                '_print' => 0,
            ],
            [
                'bend_id' => '1',
                'option_slug' => 'cities',
                'option_type' => 'form',
                'user_id' => 0,
                '_index' => 1,
                '_view' => 0,
                '_add' => 0,
                '_edit' => 0,
                '_delete' => 0,
                '_pdf' => 0,
                '_excel' => 0,
                '_email' => 0,
                '_print' => 0,
            ],
            [
                'bend_id' => '1',
                'option_slug' => 'business',
                'option_type' => 'form',
                'user_id' => 0,
                '_index' => 1,
                '_view' => 0,
                '_add' => 0,
                '_edit' => 0,
                '_delete' => 0,
                '_pdf' => 0,
                '_excel' => 0,
                '_email' => 0,
                '_print' => 0,
            ],
            [
                'bend_id' => '1',
                'option_slug' => 'employees',
                'option_type' => 'form',
                'user_id' => 0,
                '_index' => 1,
                '_view' => 0,
                '_add' => 0,
                '_edit' => 0,
                '_delete' => 0,
                '_pdf' => 0,
                '_excel' => 0,
                '_email' => 0,
                '_print' => 0,
            ],
            [
                'bend_id' => '1',
                'option_slug' => 'business-location',
                'option_type' => 'form',
                'user_id' => 0,
                '_index' => 1,
                '_view' => 0,
                '_add' => 0,
                '_edit' => 0,
                '_delete' => 0,
                '_pdf' => 0,
                '_excel' => 0,
                '_email' => 0,
                '_print' => 0,
            ],[
                'bend_id' => '1',
                'option_slug' => 'bands',
                'option_type' => 'form',
                'user_id' => 0,
                '_index' => 1,
                '_view' => 0,
                '_add' => 0,
                '_edit' => 0,
                '_delete' => 0,
                '_pdf' => 0,
                '_excel' => 0,
                '_email' => 0,
                '_print' => 0,
            ],
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
