<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExtraCulmnInOfficeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('office', function (Blueprint $table) {
             
             $table->renameColumn('ip', 'out_ip' );
             $table->renameColumn('status', 'in' );
             $table->ipAddress('in_ip')->after('employee_id')->nullable();
             $table->string('out')->after('in');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('office', function (Blueprint $table) {
            //
        });
    }
}
