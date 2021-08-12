<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Leave;
use Session;
use Validator;
use DB;
use Auth;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $leaves = Leave::all();
        return view('pages-admin.leave.index')->withLeaves($leaves);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages-admin.leave.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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

                $rejoin_date = $request->input('rejoin_date');

                $leave_create->name                       = $request->input('name');
                $leave_create->designation                = $request->input('designation');
                $leave_create->year                       = $request->input('year');
                $leave_create->month                      = $request->input('month');
                $leave_create->days                       = $request->input('days');
                $leave_create->rejoin_date                = $rejoin_date ;
                $leave_create->total_days                 = $request->input('total_days') ;
                $leave_create->contact_no                 = $request->input('contact_no') ;
                $leave_create->contact_address            = $request->input('contact_address') ;
                $leave_create->recommened                 = $request->input('recommened') ;
                $leave_create->employee_id                 =  $id;
               
               
                $leave_create->save();
                Session::flash('message', 'Successfully posted Request ');
                    return redirect('profile');
            //}
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $leave = Leave::find($id);
        return view('pages-admin.leave.show')->withLeave($leave);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $update_leave = Leave::find($id);
       $update_leave->sanctioned = $request->input('sanctioned');
       $update_leave->save();
       if ( $update_leave->sanctioned == 1 ) {
           Session::flash('message', 'Request Apporved');
                    return redirect('leave');
       }else{
       Session::flash('message', 'Request Not Apporved');
                    return redirect('leave');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
