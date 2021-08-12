<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Housekeeping extends Model
{
    protected $table = 'housekeeping';
    protected $fillable = array(
    	'name','quantity','description'
    	);
}
