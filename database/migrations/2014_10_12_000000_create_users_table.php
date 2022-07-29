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
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->text('headline')->nullable();
            $table->text('summery')->nullable();
            $table->text('addition_information')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('address_primary')->nullable();
            $table->string('address_secondary')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('postal_code')->nullable();
            $table->integer('email_verified')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('skills')->nullable();
            $table->integer('resume_type')->nullable();
            $table->integer('status')->nullable();
            $table->string('desired_job_title')->nullable();
            $table->integer('desired_salary')->nullable();
            $table->string('desired_period')->nullable();
            $table->string('desired_jobtype')->nullable();
            $table->string('profile_pic')->nullable();
            $table->string('resume_attachment')->nullable();
            $table->string('password');
            $table->integer('group_id')->nullable();
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
