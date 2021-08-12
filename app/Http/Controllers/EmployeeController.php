<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Employees;
use App\Profile;
use Validator;
use Session;
use Auth;

class EmployeeController extends Controller
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
        $users = Employees::all();
        return view('pages-admin.user.index')->withUsers($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $profile = Profile::all();
        $employees = Employees::all();

        $profile_array = array();
        $employees_array = array();

        foreach ($profile as $value) {
            $profile_array[] = $value->employee_id;
        }

        foreach ($employees as $value) {
            $employees_array[] = $value->profile_id;
        }


        $profileids =array();


        foreach($profile_array as $profile) {
            
            if (!in_array($profile,$employees_array)) {
                $profileids[] = $profile;
            } 
        }

        return view('pages-admin.user.create')->withProfileids($profileids);
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
            'name'=> 'required|max:255',
            'email'=> 'required|unique:employees,email|email',
            'password'=> 'required|min:4',
            'profile_id'=> 'required|numeric',
            'role'=> 'required'
            ]);
        
        if ($validator->fails()) {
            return redirect('user/create')
                        ->withErrors($validator)
                        ->withInput();
        } else {

            $user = new Employees;
            $user->name           = $request->input('name');
            $user->email          = $request->input('email');
            $user->password       = bcrypt($request->input('password'));
            $user->profile_id     = $request->input('profile_id');
            $user->role           = $request->input('role');
            $user->save();

            Session::flash('message', "Successfully created");

            return redirect()->route('user.index');
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
        $user = Employees::find($id);
        return view('pages-admin.user.show')->withUser($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Employees::find($id);
        $profile = Profile::all();
        $employees = Employees::all();

        $profile_array = array();
        $employees_array = array();

        foreach ($profile as $value) {
            $profile_array[] = $value->employee_id;
        }

        foreach ($employees as $value) {
            $employees_array[] = $value->profile_id;
        }


        $profileids =array();


        foreach($profile_array as $profile) {
            
            if (!in_array($profile,$employees_array)) {
                $profileids[] = $profile;
            } 
        }

        return view('pages-admin.user.edit')->withUser($user)->withProfileids($profileids);
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
           //return $request->all(); 
            $user = Employees::find($id);
            $validator = Validator::make($request->all(), [ 
            'name'=> 'required|max:255',
            'email'=> 'required|unique:employees,email,'.$request->input('email').',email|email',
            'password'=> 'min:6',
            'profile_id'=> 'numeric',
            'role'=> 'required'
            ]);
        
        if ($validator->fails()) {
            return redirect('user/'.$id.'/edit')
                        ->withErrors($validator)
                        ->withInput();
        } else {
            $user->name           = $request->input('name');
            $user->email          = $request->input('email');
			if (!empty($request->input('password'))){
				$user->password       = bcrypt($request->input('password'));
			}
            //$user->profile_id     = $request->input('profile_id');
            $user->role           = $request->input('role');
            $user->save();

            Session::flash('message', "Successfully Updated");

            return redirect()->route('user.index');
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
        //return $id;
       $u = Auth::user()->id;
        if ( $u == $id) {
            return redirect()->back()->with('error-message','You have No permision to delete');
        }
        $designation = Employees::find($id);
        $designation->delete();
        return redirect()->back()->with('message','Delete Succesfully');
    }
}
