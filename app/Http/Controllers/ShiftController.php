<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Shift;
use App\Profile;
use Session;

class ShiftController extends Controller
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
        $shift_list = Shift::all();
        return view('pages-admin.shift.shift_list')->with('shifts',$shift_list);
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages-admin.shift.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //dd($request);
         $start = $request->input('start');
         $end = $request->input('end');
         $c_start = date('H:i:s',strtotime($start));
         $c_end   = date('H:i:s',strtotime($end));
        
        //return $c_start . $c_end;

        $shift_create = new Shift;
        $shift_create->start                  = $c_start;
        $shift_create->end                    = $c_end;
        $shift_create->save();  
		
		Session::flash('message', 'Successfully Created !');    
        return redirect('shift');

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $designation = Shift::find($id);

        $result = Profile::where('shift', '=', $designation->id )
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
