<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            // $table->id();
            $table->increments('id');
            $table->string('name',100);
            $table->string('first_name',100)->nullable();
            $table->string('last_name',100)->nullable();
            $table->text('headline')->nullable();
            $table->text('summery')->nullable();
            $table->text('addition_information')->nullable();
            $table->string('email',100)->unique();
            $table->string('phone',100)->nullable();
            $table->string('address',100)->nullable();
            $table->string('address_primary',100)->nullable();
            $table->string('address_secondary',100)->nullable();
            $table->string('country',100)->nullable();
            $table->string('state',100)->nullable();
            $table->string('city',100)->nullable();
            $table->string('postal_code',50)->nullable();
            $table->tinyInteger('email_verified', false, true)->default(0)->index()->comment('0 => UnVerified, 1 => Verified');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('skills',255)->nullable();
            $table->tinyInteger('resume_type', false, true)->default(0)->index()->comment('1 => Private, 0=> Public');
            $table->tinyInteger('status', false, true)->default(0)->index()->comment('1=> Active, 0 => Inactive');
            $table->string('desired_job_title',255)->nullable();
            $table->integer('desired_salary',false)->nullable()->index();
            $table->string('desired_period',20)->nullable();
            $table->string('desired_jobtype',20)->nullable();
            $table->string('profile_pic',255)->nullable();
            $table->string('resume_attachment',255)->nullable();
            $table->string('password',255);
            $table->integer('group_id',false)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert(
            array(
                'name' => 'Admin',
                'first_name' => 'Admin',
                'last_name' => 'Admin',
                'headline' => "",
                'summery' => "",
                'addition_information' => "",
                'email' => 'admin@gmail.com',
                'phone' => '0000000000',
                'address' => 'Abc',
                'address_primary' => "",
                'address_secondary' => "",
                'country' => 'india',
                'state' => "",
                'city' => "",
                'postal_code' => "",
                'email_verified' => '1',
                'skills' => "",
                'resume_type' => "1",
                'status' => "1",
                'desired_job_title' => "",
                'desired_salary' => "0",
                'desired_period' => "",
                'desired_jobtype' => "1",
                'resume_attachment' => "",
                'group_id' => 1,
                'password' => '$2y$10$pNqEy1GXU5NH5CpYN1HWoejY2TxZy/uITLadDOH7EPmxPXJvZjsie',
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
        Schema::dropIfExists('users');
    }
}
