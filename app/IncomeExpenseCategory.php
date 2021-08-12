<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IncomeExpenseCategory extends Model
{
    protected $table = 'income_expense_category';
    protected $fillable = array('income_name');
    
}

