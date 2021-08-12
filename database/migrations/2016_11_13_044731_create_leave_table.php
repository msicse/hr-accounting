<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->tinyInteger('designation');
            $table->string('type');
            $table->date('leave_from');
            $table->date('leave_to');
            $table->string('total_days');
            $table->date('rejoin_date');
            $table->string('contact_no');
            $table->text('contact_address');
            $table->text('recommened');
            $table->tinyInteger('sanctioned');
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
        Schema::drop('leave');
    }
}
