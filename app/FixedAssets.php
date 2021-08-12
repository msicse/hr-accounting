<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FixedAssets extends Model
{
    protected $table = 'fixed_assets';
    protected $fillable = array(
    	'name','quantity','description'
    	);
}
