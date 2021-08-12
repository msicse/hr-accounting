<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Leave;
use App\Profile;
use App\Designation;
use Session;
use Validator;
use DB;
use Auth;


class SingleLeaveController extends Controller
{

	function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
    	$id = Auth::user()->profile_id;
    	
    	$leaves = Leave::where('employee_id',$id)->get();
    	//dd($leaves);
        return view('pages-admin.single-leave.index')->withLeaves($leaves);
    }
    public function create()
    {   
        $id = Auth::user()->profile_id;

        $profile = Profile::where('employee_id',$id)->lists('designation_id');

        //return $profile ;
        $designation = Designation::find($profile);



    	return view('pages-admin.single-leave.create')->withDesignation($designation);
    }
    
    public function store( Request $request)
    {
    	//return $request->all();
        // $validator = Validator::make($request->all(), [
        //         'name'              => 'required|max:150|regex:/^[(a-zA-Z\s)]+$/u',
        //         'designation'       => 'required',
        //         'type'              => 'required|max:150|regex:/^[\pL\s\-]+$/u',
        //         'contact_no'        => 'required|numeric',
        //         'contact_address'   => 'required',
        //         'leave_from'        => 'required|date',
        //         'leave_to'          => 'required|date',
        //         'rejoin_date'       => 'required|date',
        //         'total_days'       => 'numeric',
        //         'sanctioned'        => 'numeric|max:2',
                
                
        //     ]);

        // if ($validator->fails()) {
        //     return redirect('leave/create')
        //                 ->withErrors($validator)
        //                 ->withInput();
        //     } else {

    			$id = Auth::user()->profile_id;

              	$leave_create = new Leave;

               

                $leave_create->name                       = $request->input('name');
                $leave_create->designation                = $request->input('designation');
                $leave_create->year                       = $request->input('year');
                $leave_create->month                      = $request->input('month');
                $leave_create->days                       = $request->input('days');
                $leave_create->rejoin_date                = $request->input('rejoin_date'); 
                $leave_create->total_days                 = $request->input('total_days') ;
                $leave_create->contact_no                 = $request->input('contact_no') ;
                $leave_create->contact_address            = $request->input('contact_address') ;
                $leave_create->recommened                 = $request->input('recommened') ;
                $leave_create->employee_id                 =  $id;
               
               
                $leave_create->save();

                Session::flash('message', 'Successfully posted Request ');
                    return redirect()->route('single-leaves.index');
            //}
    }

    public function show($id)
    {
    	 $leave = Leave::find($id);
        return view('pages-admin.single-leave.show')->withLeave($leave);
    }
}
