<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Ip;

use Session;

use Validator;

class IpController extends Controller
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
        $ips = Ip::all();
        return view("pages-admin.ip.index")->withIps($ips);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'ip'        => 'required|ip',
        ]);

        if ($validator->fails()) {
            return redirect('ip')
                        ->withErrors($validator)
                        ->withInput();
        } else {

        //return $request;
        $designation = new Ip;
        $designation->ip = $request->input('ip');
         $designation->timestamps = false;

        $designation->save();
        Session::flash('message', 'Successfully Saved IP !!!');
            return redirect('ip');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ip = Ip::find($id);
        return $ip;
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
        
        $designation = Ip::find($id);
        $validator = Validator::make($request->all(), [
            'edit_ip'        => 'required|ip',
        ]);

        if ($validator->fails()) {
            return redirect('ip')
                        ->withErrors($validator)
                        ->withInput();
        } else {

        //return $request;
        
        $designation->ip = $request->input('edit_ip');
         $designation->timestamps = false;

        $designation->save();
        Session::flash('message', 'Successfully Saved IP !!!');
            return redirect('ip');
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
        $designation = Ip::find($id);
        $designation->delete();
        
        return redirect()->back()->with('message','Delete Succesfully');
    }
}
