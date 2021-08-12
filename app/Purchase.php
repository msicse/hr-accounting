<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $table = 'purchase';
    protected $fillable = array('purchase_code','supplier_id','account_id','vat_id','amount','discount','due_date');
}
