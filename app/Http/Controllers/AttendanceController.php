<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Office;
use Auth;


class AttendanceController extends Controller
{
   function __construct()
    {
        $this->middleware('auth');
    }

   public function index(){
    	$employees = Office::all();
    	return view('pages-admin.office-attendence.index')->with('employees',$employees);
    }
    public function employee(){
    	$employees = Office::where('employee_id', Auth::user()->profile_id )->get();
    	return view('pages-admin.office-attendence.all-attendance')->with('employees',$employees);
    }
}
