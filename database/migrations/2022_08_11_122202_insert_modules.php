<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertModules extends Migration
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
                'id' => '1',
                'module_name' => 'Recruitment',
                'module_code' => '0001',
                'active' => '1'
            ],
            [
                'id' => '2',
                'module_name' => 'Master',
                'module_code' => '0002',
                'active' => '1'
            ],
            [
                'id' => '3',
                'module_name' => 'Setting',
                'module_code' => '0003',
                'active' => '1'
            ],
            [
                'id' => '4',
                'module_name' => 'Bands',
                'module_code' => '0004',
                'active' => '1'
            ],
            [
                'id' => '5',
                'module_name' => 'Employees',
                'module_code' => '0005',
                'active' => '1'
            ],
            [
                'id' => '6',
                'module_name' => 'Business Location',
                'module_code' => '0006',
                'active' => '1'
            ]
        );
        DB::table('modules')->insert($data);
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
