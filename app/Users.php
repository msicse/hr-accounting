<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = 'users';
    protected $fillable = array(
    		'name', 'email', 'password','profile_id','role'
    	);

    protected $hidden = [
        'password', 'remember_token',
    ];
}
