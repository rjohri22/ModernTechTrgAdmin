<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CountryOption extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $data=array(
          
            'option_name' => 'Country',
            'option_slug' => 'countries',
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
            'redirect_link' => 'admin.countries'
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
