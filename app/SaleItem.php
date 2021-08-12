<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    protected $table = 'sale_item';
    protected $fillable = array('sale_id','product_id','quantity','purchase_price');
    
}
