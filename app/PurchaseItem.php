<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{
    protected $table = 'purchase_item';
    protected $fillable = array('purchase_id','product_id','quantity','purchase_price');
    
}
