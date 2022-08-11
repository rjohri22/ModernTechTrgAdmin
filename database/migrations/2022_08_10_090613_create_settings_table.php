<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('smtp_host');
            $table->string('smtp_username');
            $table->string('smtp_port');
            $table->string('smtp_password');
            $table->string('smtp_mail_encryption');
            $table->string('smtp_mail_from_name');
            $table->string('date');
            $table->timestamps();
        });

        DB::table('settings')->insert(
            array(
                'smtp_host' => 'info@gmail.com',
                'smtp_username' => 'info@moderntech.com',
                'smtp_port' => '456',
                'smtp_password' => "password",
                'smtp_mail_encryption' => "ssl",
                'smtp_mail_from_name' => "Modern tech",
                'date' => 'dd-mm-yyyy',
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
