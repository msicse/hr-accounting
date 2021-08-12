<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerformanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('performance', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('month');
            $table->date('start_date');
            $table->date('end_date');
            $table->text('working_report');
            $table->text('achivement');
            $table->text('goal');
            $table->text('goal_report');
            $table->text('target');
            $table->string('present');
            $table->string('absent');
            $table->string('leave');
            $table->string('payment');
            $table->string('bonus');
            $table->string('overtime');
            $table->string('due_work_time');
            $table->string('gap_time');
            $table->text('complain');
            $table->text('remark');
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
        Schema::drop('performance');
    }
}
