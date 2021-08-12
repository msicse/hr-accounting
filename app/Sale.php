<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sale';
    protected $fillable = array('sale_code','customer_id','account_id','vat_id','amount','discount','due_date');
}
