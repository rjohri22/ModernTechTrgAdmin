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
            $table->id();
            $table->string('name');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('headline');
            $table->string('summery');
            $table->string('addition_information');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('address');
            $table->string('address_primary');
            $table->string('address_secondary');
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->string('postal_code');
            $table->integer('email_verified');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('skills');
            $table->integer('resume_type');
            $table->integer('status');
            $table->string('desired_job_title');
            $table->integer('desired_salary');
            $table->string('desired_period');
            $table->string('desired_jobtype');
            $table->string('resume_attachment');
            $table->string('password');
            $table->integer('group_id');
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
                'email_verified' => 1,
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
