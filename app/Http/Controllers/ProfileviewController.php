<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;

class ProfileviewController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }
    public function profileView( $id )
    {
    	$profile = DB::table('employees')
            ->join('profile', 'profile.employee_id', '=', 'employees.profile_id')
            ->join('designation', 'designation.id', '=', 'profile.designation_id')
            ->join('shift', 'shift.id', '=', 'profile.shift')
            ->select('employees.*','profile.*', 'designation.designation_name', 'shift.*')
            ->where('employees.id', '=',$id )
            //->get()
            ->first();
            return view('pages-admin.profile', compact('profile'));
    }
}
