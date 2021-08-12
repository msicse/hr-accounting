<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Office;
use App\Shift;
use Auth;
use DateTime;
use DB;
use Carbon\Carbon;

class OfficeController extends Controller
{
 
//Check Auth   
    function __construct()
    {
        $this->middleware('auth');
    }

//getOfficein

	public function getOfficein()
	{
        //initialize variable
            $disable_out_button="";
            $buttonstatus ="";

            $user_id = Auth::user()->profile_id;
        
        //FInd Shift  

            $profile_shift = DB::table('profile')
                         ->select('shift')
                         ->where('employee_id', $user_id )
                         ->get();
            
             $st = isset($profile_shift[0]->shift) ? $profile_shift[0]->shift : false;

            
            //if ($st){

                 $shift = Shift::find( $profile_shift[0]->shift );
            
            
           // $shift = Shift::find( $profile_shift[0]->shift );

        //Calculate working hour

            $to = Carbon::createFromFormat('H:s:i', $shift->start );
            $from = Carbon::createFromFormat('H:s:i', $shift->end);
            $working_hours_in_day = $to->diffInHours($from);
            
        //}

        //find office in-time

            $officein_time = DB::table('office')
                         ->where('employee_id', $user_id )
                         ->orderBy('in','desc')
                         ->limit(1)
                         ->get();
            

            if (!empty($officein_time)) {

                $chk_time = $officein_time[0]->in;

                $date = new DateTime($chk_time);
                $date->modify("+".($working_hours_in_day * 2) ." hours");
                //$date->modify("+ 1 hours");

                $working_time = $date->format("Y-m-d H:i:s");
                $intime = new DateTime();
                $intime = $intime->format('Y-m-d H:i:s');
                
            //disable button after check   
                if ($working_time < $intime ) {
                    $buttonstatus ="office_in";
                }

            //disable all button after office_out

                if ($officein_time[0]->out != null ) {
                    $disable_out_button = "out";
                }

            }else{
               
                $intime = new DateTime();
                $intime = $intime->format('Y-m-d H:i:s');
                $buttonstatus ="";
                $buttonstatus ="office_in";
                
            }

    	$offices = Office::where('employee_id', $user_id)->get();

        //return $user_id;
		return view('office.index')->with(compact('offices','buttonstatus','disable_out_button'));
	}

//postOfficein 

    public function postOfficeIn( Request $request )
    
    {

        //shift time
        $user_id = Auth::user()->profile_id;
        
        $profile_shift = DB::table('profile')
                     ->select('shift')
                     ->where('employee_id', $user_id )
                     ->get();
        //return $profile_shift;
        $shift = Shift::find( $profile_shift[0]->shift );


        $to = Carbon::createFromFormat('H:s:i', $shift->start );
        $from = Carbon::createFromFormat('H:s:i', $shift->end);
        $working_hours_in_day = $to->diffInHours($from);
        
        $officein_time = DB::table('office')
                     ->select('in')
                     ->where('employee_id', $user_id )
                     ->orderBy('in','desc')
                     ->limit(1)
                     ->get();
//dd($officein_time);
        if (!empty($officein_time)) {
            $chk_time = $officein_time[0]->in;

            $date = new DateTime($chk_time);
            $date->modify("+".($working_hours_in_day * 2) ." hours");

            $working_time =$date->format("Y-m-d H:i:s");

            $intime = new DateTime();
            $intime = $intime->format('Y-m-d H:i:s');
            $buttonstatus ="";
            if ($working_time < $intime ) {
                $office = new Office;
                $in_ip= $request->ip();
                $office->employee_id = Auth::user()->profile_id;
                $office->in = $intime;
                $office->in_ip =  $in_ip;
                $office->out = null;
                //return $office;
                $office->save() ;

                $office_id = $office->id;
            }

        }else{
                $ctime = new DateTime();
                $ctime = $ctime->format('Y-m-d H:i:s');
                $office = new Office;
                $in_ip= $request->ip();
                $office->employee_id = Auth::user()->profile_id;
                $office->in = $ctime;
                $office->in_ip =  $in_ip;
                $office->out = null;
                //return $office;
                $office->save() ;
                
                $office_id = $office->id;
        
    	}
        return redirect()->route('office.in');
    
    }


    public function officeOut( Request $request, $id )
    {

        $user_id = Auth::user()->profile_id;
        
        $profile_shift = DB::table('profile')
                     ->select('shift')
                     ->where('employee_id', $user_id )
                     ->get();
        
        //return $profile_shift;
        $shift = Shift::find( $profile_shift[0]->shift );
        $to = Carbon::createFromFormat('H:s:i', $shift->start );
        $from = Carbon::createFromFormat('H:s:i', $shift->end);
        $working_hours_in_day = $to->diffInHours($from);
        
        $officein_time = DB::table('office')
                     ->where('employee_id', $user_id )
                     ->where('out', null )
                     ->orderBy('in','desc')
                     ->limit(1)
                     ->get();

        if (!empty($officein_time)) {
               
            $chk_time = $officein_time[0]->in;

            $date = new DateTime($chk_time);

            $date->modify("+".($working_hours_in_day * 2) ." hours");

            $working_time = $date->format("Y-m-d H:i:s");

            $intime = new DateTime();
            $intime = $intime->format('Y-m-d H:i:s');

            if ($working_time >= $intime ) {

                $in_id = DB::table('office')
                         ->select('id')
                         ->where('employee_id', $id )
                         ->orderBy('created_at','desc')
                         ->limit(1)
                         ->get();

                $office = Office::find( $in_id[0]->id );
                $outtime = new DateTime();
                $outtime = $outtime->format('Y-m-d H:i:s');

                $out_ip= $request->ip();

                $office->out = $outtime;
                $office->out_ip =  $out_ip;
                
                //return $office;
                $office->save() ;
            }
        }
    	return redirect()->route('office.in');
    }
}
