<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id');
            $table->integer('month');
            $table->integer('year');
            $table->text('add_des');
            $table->text('add_taka');
            $table->text('sub_des');
            $table->text('sub_taka');
            $table->$table->float('total_salary', 8, 8);
            $table->$table->float('gross_salary', 8, 8);
            $table->tinyInteger('paid');
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
        Schema::drop('payment');
    }
}
