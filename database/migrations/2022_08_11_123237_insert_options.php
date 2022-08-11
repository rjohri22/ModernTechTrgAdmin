<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertOptions extends Migration
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
                'option_name' => 'Job Description',
                'option_slug' => 'job-description',
                'module_id' => '1',
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
                'active' => '1'
            ],
            [
                'id' => '2',
                'option_name' => 'Jobs',
                'option_slug' => 'jobs',
                'module_id' => '1',
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
                'active' => '1'
            ],
            [
                'id' => '3',
                'option_name' => 'Approved Jobs',
                'option_slug' => 'approved-jobs',
                'module_id' => '1',
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
                'active' => '1'
            ],
            [
                'id' => '4',
                'option_name' => 'Groups',
                'option_slug' => 'groups',
                'module_id' => '2',
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
                'active' => '1'
            ],
            [
                'id' => '5',
                'option_name' => 'Departments',
                'option_slug' => 'departments',
                'module_id' => '2',
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
                'active' => '1'
            ],
            [
                'id' => '6',
                'option_name' => 'Designations',
                'option_slug' => 'designations',
                'module_id' => '2',
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
                'active' => '1'
            ],
            [
                'id' => '7',
                'option_name' => 'States',
                'option_slug' => 'states',
                'module_id' => '2',
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
                'active' => '1'
            ],
            [
                'id' => '8',
                'option_name' => 'Cities',
                'option_slug' => 'cities',
                'module_id' => '2',
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
                'active' => '1'
            ],
            [
                'id' => '9',
                'option_name' => 'Business',
                'option_slug' => 'business',
                'module_id' => '2',
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
                'active' => '1'
            ],
            [
                'id' => '10',
                'option_name' => 'Email SMTP',
                'option_slug' => 'email-smtp',
                'module_id' => '3',
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
                'active' => '1'
            ],
            [
                'id' => '11',
                'option_name' => 'Bands',
                'option_slug' => 'bands',
                'module_id' => '4',
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
                'active' => '1'
            ],
            [
                'id' => '12',
                'option_name' => 'Employees',
                'option_slug' => 'employees',
                'module_id' => '5',
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
                'active' => '1'
            ],
            [
                'id' => '13',
                'option_name' => 'Business Location',
                'option_slug' => 'business-location',
                'module_id' => '6',
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
                'active' => '1'
            ]
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
