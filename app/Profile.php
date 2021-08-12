<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profile';
    protected $fillable = array(
    	'first_name', 'father_name', 'address','nid','gender','religion','maritial_status','date_of_birth','phone','email','fb','skype','date_of_join','shift','marks','profile_pic','designation_id'
    	);

		public function employee () {
		
			return $this->belongsTo('App\Employees');
		}
   
}
