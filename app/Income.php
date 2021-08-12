<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    protected $table = 'incomes';
    protected $fillable = [
        'title', 'description', 'amount','account_id','income_category_id'
    ];
}
