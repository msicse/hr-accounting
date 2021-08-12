<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    protected $table = 'leave';
    protected $fillable = array(
    		'name','designation', 'type', 'contact_no', 'contact_address','year','month','days','rejoin_date','total_days','total_days','sanctioned' 
    	);
     protected $dates = ['leave_from', 'leave_to'];
}
