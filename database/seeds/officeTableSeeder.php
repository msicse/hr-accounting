<?php

use Illuminate\Database\Seeder;
use App\Office;

class officeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $office = new Office;
        $office->employee_id  = "104";
        $office->in_ip        = "127.0.0.1";
        $office->out_ip       = "127.0.0.1";
        $office->in     		= "2016-11-01 10:12:25";
        $office->out           = "2016-11-01 17:12:25";
        $office->save();

        $office = new Office;
        $office->employee_id  = "104";
        $office->in_ip        = "127.0.0.1";
        $office->out_ip       = "127.0.0.1";
        $office->in     		= "2016-11-02 10:12:25";
        $office->out           = "2016-11-02 17:12:25";
        $office->save();

        $office = new Office;
        $office->employee_id  = "104";
        $office->in_ip        = "127.0.0.1";
        $office->out_ip       = "127.0.0.1";
        $office->in     		= "2016-11-03 10:12:25";
        $office->out           = "2016-11-03 17:12:25";
        $office->save();

        $office = new Office;
        $office->employee_id  = "104";
        $office->in_ip        = "127.0.0.1";
        $office->out_ip       = "127.0.0.1";
        $office->in     		= "2016-11-04 10:12:25";
        $office->out           = "2016-11-04 17:12:25";
        $office->save();

        $office = new Office;
        $office->employee_id  = "104";
        $office->in_ip        = "127.0.0.1";
        $office->out_ip       = "127.0.0.1";
        $office->in     		= "2016-11-05 10:12:25";
        $office->out           = "2016-11-05 17:12:25";
        $office->save();

        $office = new Office;
        $office->employee_id  = "104";
        $office->in_ip        = "127.0.0.1";
        $office->out_ip       = "127.0.0.1";
        $office->in     		= "2016-11-06 10:12:25";
        $office->out           = "2016-11-06 17:12:25";
        $office->save();

        $office = new Office;
        $office->employee_id  = "104";
        $office->in_ip        = "127.0.0.1";
        $office->out_ip       = "127.0.0.1";
        $office->in     		= "2016-11-07 10:12:25";
        $office->out           = "2016-11-07 17:12:25";
        $office->save();

        $office = new Office;
        $office->employee_id  = "104";
        $office->in_ip        = "127.0.0.1";
        $office->out_ip       = "127.0.0.1";
        $office->in     		= "2016-11-08 10:12:25";
        $office->out           = "2016-11-08 17:12:25";
        $office->save();

        $office = new Office;
        $office->employee_id  = "104";
        $office->in_ip        = "127.0.0.1";
        $office->out_ip       = "127.0.0.1";
        $office->in     		= "2016-11-09 10:12:25";
        $office->out           = "2016-11-09 17:45:25";
        $office->save();

        $office = new Office;
        $office->employee_id  = "104";
        $office->in_ip        = "127.0.0.1";
        $office->out_ip       = "127.0.0.1";
        $office->in     		= "2016-11-10 12:12:25";
        $office->out           = "2016-11-10 17:12:25";
        $office->save();

        $office = new Office;
        $office->employee_id  = "104";
        $office->in_ip        = "127.0.0.1";
        $office->out_ip       = "127.0.0.1";
        $office->in     		= "2016-11-11 12:12:25";
        $office->out           = "2016-11-11 17:45:25";
        $office->save();

        $office = new Office;
        $office->employee_id  = "104";
        $office->in_ip        = "127.0.0.1";
        $office->out_ip       = "127.0.0.1";
        $office->in     		= "2016-11-12 12:12:25";
        $office->out           = "2016-11-12 17:40:25";
        $office->save();

        
    }
}