<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    protected $table = 'office';
    protected $fillable = array('notes', 'ip');
    protected $dates = ['in', 'out'];
}
