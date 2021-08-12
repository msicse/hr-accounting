<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Designation;
use App\Profile;
use Session;
use Validator;


class DesignationController extends Controller
{

    function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $designation_list = Designation::all();
        return view('pages-admin.designation.designation')-> with('designation_list', $designation_list);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages-admin.designation.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $validator = Validator::make($request->all(), [
            'designation_name'        => 'required|min:5|regex:/^[(a-zA-Z\s)]+$/u',
            'designation_short_name'  => 'required|regex:/^[\pL\s\-]+$/u',
            'designation_status'      => 'required|not_in:0'
        ]);

        if ($validator->fails()) {
            return redirect('designaion/create')
                        ->withErrors($validator)
                        ->withInput();
        } else {

        //return $request;
        $designation = new Designation;
        $designation->designation_name           = $request->input('designation_name');
        $designation->designation_short_name     = $request->input('designation_short_name');
        $designation->designation_status         = $request->input('designation_status');
        $designation->save();
        Session::flash('message', 'Successfully created designaion!');
            return redirect('designaion');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $designation_edit = Designation::find($id);
        return $designation_edit;// view('pages-admin.designation.edit')->with('designation_edit',$designation_edit);
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
        $designation = Designation::find($id);


        $validator = Validator::make($request->all(), [
            'designation_name'        => 'required|min:5|regex:/^[(a-zA-Z\s)]+$/u',
            'designation_short_name'  => 'required|regex:/^[\pL\s\-]+$/u',
            'designation_status'      => 'required|not_in:0'
        ]);
        if ($validator->fails()) {
            return redirect('designaion/'.$designation->id.'/edit')
                        ->withErrors($validator)
                        ->withInput();
        } else {
            
            $designation->designation_name           = $request->input('designation_name');
            $designation->designation_short_name     = $request->input('designation_short_name');
            $designation->designation_status         = $request->input('designation_status');
            $designation->save();
        
            // redirect
            Session::flash('message', 'Successfully updated');
                return redirect('designaion');
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
        $designation = Designation::find($id);

        $result = Profile::where('designation_id', '=', $designation->id )
                            ->exists();

        if ( $result ) {
            
            Session::flash('error-message', 'Please Employee Profile  Delete first !');    
            return redirect('profile');
        } else {

            $designation->delete();
            return redirect()->back()->with('message','Delete Succesfully');
        }

        
    }
}
