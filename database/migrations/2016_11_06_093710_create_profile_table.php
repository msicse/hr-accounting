<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_name');
            $table->string('father_name');
            $table->string('mother_name');
            $table->text('present_address');
            $table->text('permanent_address');
            $table->string('nid');
            $table->tinyInteger('gender');
            $table->tinyInteger('religion');
            $table->tinyInteger('maritial_status');
            $table->tinyInteger('blood_group');
            $table->date('date_of_birth');
            $table->string('phone');
            $table->string('email');
            $table->string('fb');
            $table->string('skype');
            $table->string('emergency_contact_number');
            $table->text('emergency_address');
            $table->date('date_of_join');
            $table->tinyInteger('shift');
            $table->text('marks');
            $table->text('reference');
            $table->longText('profile_pic');
            $table->longText('nid_upload');
            $table->integer('designation_id')->unsigned();
            $table->foreign('designation_id')->references('id')->on('designation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('profile');
    }
}
