<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offday extends Model
{
    protected $table = 'off_day';
    protected $fillable = array(
    	'year','month','off_days'
    	);
}
