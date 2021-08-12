<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stationaery extends Model
{
    protected $table = 'stationaery';
    protected $fillable = array(
    	'name','quantity','description'
    	);
}
