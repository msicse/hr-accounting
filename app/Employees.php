<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
/*
class Employees extends Model
{
    protected $table = 'employees';
    protected $fillable = [
        'name', 'email', 'password','profile_id','role'
    ];
	
}
*/

class Employees extends Authenticatable
{
    protected $table = 'employees';
    protected $fillable = [
        'name', 'email', 'password','profile_id','role'
    ];
	
	public function profiles () {
	
		return $this->hasOne('App\Profile','employee_id','profile_id');
	
	}
	
}
