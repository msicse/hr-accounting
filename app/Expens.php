<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expens extends Model
{
    protected $table = 'expenses';
    protected $fillable = [
        'title', 'description', 'amount','account_id','income_category_id'
    ];
    

  
}
