<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payment';
    protected $fillable = array(
    	'employee_id','month','year','add_des','add_taka','sub_des','sub_taka','total_salary','gross_salary','paid'
    	);

   
}
