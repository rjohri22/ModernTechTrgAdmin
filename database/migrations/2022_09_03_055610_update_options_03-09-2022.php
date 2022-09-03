<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOptions03092022 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $data=array(
            'option_name' => 'Question Banks',
            'option_slug' => 'question-banks',
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
            'active' => '1',
            'redirect_link' => 'admin.question_banks'
        );
        DB::table('options')->insert($data);


        $data_per=array(
            'bend_id' => '1',
            'option_slug' => 'question-banks',
            'option_type' => 'form',
            'user_id' => '0',
            '_index' => '1',
            '_view' => '0',
            '_add' => '0',
            '_edit' => '0',
            '_delete' => '0',
            '_pdf' => '0',
            '_excel' => '0',
            '_email' => '0',
            '_print' => '0',
        );
        DB::table('option_permissions')->insert($data_per);


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
