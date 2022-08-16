<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminPermissionEmailSmtp extends Migration
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
                'option_slug' => 'email-smtp',
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


        $update_red_1 = array(
            'redirect_link' => 'admin.jobs'
        );

        DB::table('options')->where('option_slug','approved-jobs')->update($update_red_1);

        $update_red_2 = array(
            'redirect_link' => 'admin.departments'
        );

        DB::table('options')->where('option_slug','departments')->update($update_red_2);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
