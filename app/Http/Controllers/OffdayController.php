<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Offday;

use Input;

use Validator;

use DB;

use Session;

class OffdayController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
    	
    	

    	return view('pages-admin.off-day.view');

	}

    public function create(){
    	return view('pages-admin.off-day.create');
    }

    public function store( Request $request ){

    $rules = array(
        'month'             => 'required|integer|max:12',                       
        'year'              => 'required|',
        'off_days'          => 'required',          
    );
    $validator = Validator::make(Input::all(), $rules);
	$year = Input::get('year');
	$month = Input::get('month');
	
			$offdays = Input::get('off_days');
			$off_day  = explode(",", $offdays );
					foreach ( $off_day as $day) {
					   $off_day = new Offday;
						$off_day->year =  Input::get('year');
						$off_day->month = Input::get('month');
						$off_day->off_days = $day;
						$off_day->save();
					}

		  // return Input::get('off_days');
		   return Input::get('off_days') . " Successfully Added as Off Day";
	}

    public function getViewoffday(){
    	
    	$offdays = Offday::distinct()->get(['year']);
    	$offmonts = Offday::distinct()->get(['month']);
    	return view('pages-admin.off-day.index')->withOffdays( $offdays )->withOffmonts($offmonts);

	}

    public function viewoffday( Request $request )
    {
    	$year = $request->input('year');
    	$month = $request->input('month');

    	$offdays = DB::table('off_day')->where('month',$month)
    								->where('year',$year)
    								->get();

    	return view('pages-admin.off-day.view')->with(compact('offdays','year','month'));


    }

    public function getMonth( )
    {
    	
		return view('pages-admin.off-day.month');
    }

    public function postMonth( Request $request )
    {
    	$year = $request->input('year');
    	$month = $request->input('month');
		
		$result = Offday::where('year', '=',$year)->where('month', '=',$month) ->exists();
	
		if ( $result ) {
			Session::flash('error-message', 'Allredy Added Offday You Can only Edit or Delete !!!');
			 return redirect()->back();
		} else {
			return view('pages-admin.off-day.create')->with(compact('year','month'));
		}
    }
    
    public function getEditoffday( $id )
    {
    	$offday = Offday::find($id);
    	//return $offday->year;

    	// DB::table('users')->select('name', 'email as user_email')->get();
    	// $offdays = DB::table('off_day')->
    	// 							->where('year',$offday->year)
    	// 							->get();

    	return view('pages-admin.off-day.edit')->withOffday($offday);
    }
    
    public function update( Request $request )
    {
    	$year = $request->input('year');
    	$month = $request->input('month');

    	$offdays = DB::table('off_day')->where('month',$month)
    								->where('year',$year)
    								->select('off_days')
    								->get();

    	$chk_offday = array( );

    	foreach ($offdays as $offday) {
    		$chk_offday[] = $offday->off_days;
    	}

    	$offdays = Input::get('off_days');

        $off_day  = explode(",", $offdays );
		        
		        foreach ( $off_day as $day) {
				    if (!in_array($day, $chk_offday)) {
				    	$off_day = new Offday;
				            $off_day->year =  Input::get('year');
				            $off_day->month = Input::get('month');
				            $off_day->off_days = $day;
				            $off_day->save();
				            $chk_offday[] =$day;
				            return 'Successfully Updated';
				    }
		           
		        }

    }


public function destroy( $id )
{	
	Offday::find($id)->delete();
	Session::flash('message', 'Successfully Deleted Offday!!!');
	 return redirect()->back();
}






}
