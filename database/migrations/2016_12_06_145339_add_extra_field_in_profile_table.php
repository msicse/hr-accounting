<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExtraFieldInProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profile', function (Blueprint $table) {
            $table->renameColumn('full_name', 'first_name');
            $table->tinyInteger('employee_type');
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('ssc')->nullable();
            $table->string('hsc')->nullable();
            $table->string('hons')->nullable();
            $table->string('masters')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profile', function (Blueprint $table) {
            $table->dropColumn('employee_type');
            $table->dropColumn('middle_name');
            $table->dropColumn('last_name');
            $table->dropColumn('ssc');
            $table->dropColumn('hsc');
            $table->dropColumn('hons');
            $table->dropColumn('masters');
        });
    }
}
