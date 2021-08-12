<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use Carbon\Carbon;
use View;
use DateTime;
use App\Office;
use App\Shift;
use App\Payment;
use App\Profile;
use Session;

class PayrolController extends Controller
{
    
    function __construct()
    {
        $this->middleware('auth');
    }

    public function getAllpayroll()
    {
        $payrolls = Payment::all();
        return view('pages-admin.payrol.all-payroll')->withPayrolls($payrolls);
    }
    

    public function getSinglepayroll( $id )
    {
        //$payroll = Payment::find($id);


        // $payments = DB::table('payment')
        //     ->join('profile', 'payment.employee_id', '=', 'profile.employee_id')
        //     ->join('designation', 'profile.designation_id', '=', 'designation.id')
        //     //->select('payment.*', 'contacts.phone', 'orders.price')
        //     ->where('payment.employee_id', $payroll->employee_id)
        //     ->where('payment.year', $payroll->year)
        //     ->where('payment.month', $payroll->month)
        //     ->limit(1)
        //     ->get();

        $payment = DB::table('payment')
            ->join('profile', 'payment.employee_id', '=', 'profile.employee_id')
            ->select('payment.*', 'profile.first_name','profile.middle_name','profile.last_name')
            ->where('payment.id',$id)
            ->first();

        return view('pages-admin.payrol.single-payroll')->withPayment($payment);
    }

    public function getDeletepayroll( $id )
    {
        $designation = Payment::find($id);
        $designation->delete();
        //return redirect()->route('payrol.all');
        return redirect()->route('payrol.all')->with('message','Delete Succesfully');

       // return view('pages-admin.payrol.single-payroll')->withPayroll($payroll);
    }

    public function getPayrol()
    {
    	return view('pages-admin.payrol.view');
    }

    public function view_test()
    {
    	return view('pages-admin.payrol.index');
    }

    public function postPayrol( Request $request )
    {
    	
        //$exists = DB::table('payment')->where('year', 'Moderator')->select();

        $row ="";

    	$employee_id = $request->input('employee_id');
    	$year 		 = $request->input('year');
    	$month 		 = $request->input('month');

         $exists = DB::table('payment')->where('year', $year )->where('month', $month)->where('employee_id', $employee_id )->exists();
        
        if ( $exists ) {

            Session::flash('message', 'Paroll Allready Create. Please Delete First and Create Again !');
            return redirect()->route('payrol.all');
        }


    if (Profile::where('employee_id', '=', $employee_id )->exists()) {

        $profile = DB::table('profile')
    				->where('employee_id',$employee_id)
    				->first();
	//dd($profile);
    	$shift_id =$profile->shift;

    	$salary =$profile->salary;
    	
    	//return $salary;

    	$shift = Shift::where('id', $shift_id )
    				->first();
   
    //Calculate working_hours_in_day
    	
    	$to = Carbon::createFromFormat('H:s:i', $shift->start );
		$from = Carbon::createFromFormat('H:s:i', $shift->end);

		$working_hours_in_day = $to->diffInHours($from);

    
    //Total Days In a month Calculation	
    	
    	$days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    	
    	$total_days =array();


		for ($i=1; $i <= $days ; $i++) { 
		    			$total_days[] = $i ;
		    		}
    	
    //Total Offdays Calculation
    	$offdays = DB::table('off_day')
    			->select('off_days')
    			->where('year',$year)
    			->where('month',$month)
    			->get();
	
	$total_offdays =array();

    	foreach ($offdays as $day) {
    		$total_offdays[] = $day->off_days;
    	}

    $working_days =count( $total_days ) - count( $total_offdays );

    $full_working_hours = $working_days * $working_hours_in_day;


    $salary_in_hour = $salary / $full_working_hours; //in minite 
    
    $salary_in_minite = $salary / $full_working_hours /60; //in minite 

     $salary_in_minite = round( $salary_in_minite, 6);




    //return $full_working_hours;


    //Calculate Office time 

     //SELECT * FROM `office` WHERE MONTH(created_at)=11 AND YEAR(created_at) = 2016
    
    $office_time_all = Office::where('employee_id',$employee_id)
    				 ->whereMonth('in','=', $month )
    				 ->whereYear('in','=', $year )
    				 ->get();
    // dd($office_time_all);


   //dd ( $office_time_all[0]->id);//($office_time_all);
            
           $work_day =array();

           // foreach ($office_time_all as $value) {
           //    // $work_day[] = 
           //  dd($value);
           // }

            // $work_day = $office_time_all[0]->in;
            
            // $work_day = new DateTime( $work_day );

            $office_in_date = array();
            $office_out_date = array();
            
             foreach ( $office_time_all as  $office_time) 
             {
                $office_in_date[] =  date('Y-m-d',strtotime( $office_time->in ));
             }

             foreach ( $office_time_all as  $office_time) 
             {
                $office_out_date[] =  date('Y-m-d',strtotime( $office_time->out ));
             }

            //  $work_day =  $work_day->format("d");
    //Leave controle

        $leaves = DB::table('leave')
                ->select('days')
                ->where('year',$year)
                ->where('month',$month)
                ->where('employee_id',$employee_id )
                ->where('sanctioned',1 )
                ->get();

        
        $leave_days = array();

        foreach ($leaves as $leave) {

           if ( strpos( $leave->days,",")) {

                $leave_d = explode(",", $leave->days);

                foreach ($leave_d as $value) {
                    $leave_days[] = $value;
                }
            }else{
                
                $leave_days[] = $leave->days;
            }
        }
        



        $total_taka = 0;

	    foreach ( $total_days as $day) {
	    	
	    	if ( in_array( $day , $total_offdays )) {
	    		$row .= "<tr style='background:gray; color:#fff;' >";
                    $row .= "<td colspan='6'>$day</td>";
                    
		            $row .= "<td>Offday</td>";
		        $row .="</tr>";
	    	}else{
				


                if ( in_array( $day , $leave_days )) {

                    $row .= "<tr style='background:green; color:#fff;' >";
                    $row .= "<td>$day</td>";
                    $row .= "<td colspan='2'> Leave </td>"; 
                    $row .= "<td>$working_hours_in_day</td>";
                    $row .= "<td>NA</td>";
                    $row .= "<td> $salary_in_minite </td>";
                    $row .= "<td>". 60 * $salary_in_minite * $working_hours_in_day ."</td>";
                    $total_taka +=  60 * $salary_in_minite * $working_hours_in_day;
                    $row .="</tr>";

                }else{

                     $dt = date('Y-m-d',strtotime( $year .'-'.$month.'-'.$day )) ;
                    //print_r($office_in_date);
                     if (in_array( $dt, $office_in_date)) {
                        
                        if (in_array( $dt, $office_out_date)) {
                           $row .= "<tr>";
                        $row .= "<td>".$day."</td>";


                        foreach ( $office_time_all as  $office_time) {
                           
                           $work_day = $office_time->in;
            
                            $work_day = new DateTime( $work_day );
                            
                             $work_day =  $work_day->format("d");
                             if ($day == $work_day ) {





                                // $to= Carbon::createFromFormat('Y-m-d H:s:i', $office_time->in );
                                // $from = Carbon::createFromFormat('Y-m-d H:s:i', $office_time->out);

                                $to= new DateTime( $office_time->in );
                                $from= new DateTime($office_time->out );
                               
                               $to = strtotime($office_time->in);
                                $from = strtotime($office_time->out);

                                $working_minutes =  round(abs($to - $from) / 60,2);

                                 //echo $working_hours = $timeF->format('%H:%I:%S') ."<br>";

                                //$working_hours = $to->diffInMinutes($from);
                                //dd($working_hours);
                                //$working_hours = $working_hours / 60;

                                $row .="<td>".date('h:ia',strtotime($office_time->in))."</td>";
                                $row .="<td>". date('h:ia',strtotime($office_time->out))."</td>";
                                $row .="<td>". (int)($working_minutes / 60) . ":" .($working_minutes % 60). "</td>";

                                $row .="<td>". (($working_hours_in_day * 60) - $working_minutes) ."</td>";

                                $row .="<td>". $salary_in_minite. " / ". round($salary_in_hour,2)."</td>";
                                $row .="<td>".$salary_in_minite * $working_minutes ."</td>";
                                $total_taka += $salary_in_minite * $working_minutes;
                                //$total_taka = ($salary_in_minite * $working_hours);
                            }

                        }
                        $row .="</tr>";

                        }else{
                            $row .= "<tr style='background:#f94268; color:#fff;' >";
                            $row .= "<td>$day</td>";
                            $row .= "<td></td>";
                            $row .= "<td></td>";
                            $row .= "<td></td>";
                            $row .= "<td></td>";
                            $row .= "<td colspan='2'>Absent Due to Don't office out </td>";
                            $row .="</tr>";
                        }
                        
                     }else {
                        $row .= "<tr style='background:#880000; color:#fff;' >";
                        $row .= "<td>$day</td>";
                        $row .= "<td></td>";
                        $row .= "<td></td>";
                       
                        $row .= "<td></td>";
                        $row .= "<td>  </td>";
                        $row .= "<td>  </td>";
                        $row .= "<td colspan='2'>Absent</td>";
                        $row .="</tr>";
                     }


                    
		    }
        }
	    }
        $rowcal = "";

        $rowcal .= "<tr>";
            $rowcal .= "<th>Basic Salary</th>";
            $rowcal .= "<td id='basic-salary' class='text-right'>$salary</td>";
            $rowcal .= "<th>Advance</th>";
            $rowcal .= "<td  class='text-right'><input type='number' name='advance' id='advance' value='0' onclick='result();' onkeyup='result();'></td>";
        $rowcal .="</tr>";

        $rowcal .= "<tr>";
            $rowcal .= "<th>House Rent</th>";
            $rowcal .= "<td id='house-rent' class='text-right'>".(60/100)*$salary."</td>";
            $rowcal .= "<th>Salary Deductions</th>";
            $rowcal .= "<td class='text-right'><input type='number' name='salary_deduction' id='salary-deduction' onclick='result();' onkeyup='result();' value='0'></td>";
        $rowcal .="</tr>";

        $rowcal .= "<tr>";
            $rowcal .= "<th>Convene Allowance</th>";
            $rowcal .= "<td id='convance' class='text-right'>".(20/100)*$salary."</td>";
            $rowcal .= "<th>Others</th>";
            $rowcal .= "<td class='text-right'><input type='number' name='others' id='others' value='0' onclick='result();' onkeyup='result();' ></td>";
        $rowcal .="</tr>";

        $rowcal .= "<tr>";
            $rowcal .= "<th>Medical Allowance</th>";
            $rowcal .= "<td id='medical-allow' class='text-right'>".(10/100)*$salary."</td>";
            $rowcal .= "<td></td>";
            $rowcal .= "<td></td>";
        $rowcal .="</tr>";

        $rowcal .= "<tr>";
            $rowcal .= "<th>Mobile Allowance</th>";
            $rowcal .= "<td id='mobile-allow' class='text-right'>".(10/100)*$salary."</td>";
            $rowcal .= "<td></td>";
            $rowcal .= "<td></td>";
        $rowcal .="</tr>";

        $rowcal .= "<tr>";
            $rowcal .= "<th>Overtime</th>";
            $rowcal .= "<td class='text-right'><input id='overtime' type='number' name='overtime' onclick='result();' onkeyup='result();' /> </td>";//$full_working_hours
            $rowcal .= "<td></td>";
            $rowcal .= "<td></td>";
        $rowcal .="</tr>";

        $rowcal .= "<tr>";
            $rowcal .= "<th>Bonus</th>";
            $rowcal .= "<td  class='text-right'> <input type='number' name='bonus' id='bonus' onclick='result();' onkeyup='result();' /> </td>";
            $rowcal .= "<td></td>";
            $rowcal .= "<td></td>";
        $rowcal .="</tr>";

        



        $id = $employee_id ;


	    	return View::make('pages-admin.payrol.index')->withRow($row)->withId($id)->withYear($year)->withMonth($month)->withRowcal($rowcal);
    }else {
        
        Session::flash('error-message', 'Employee Id Not Found');
            
        return redirect()->back();
    }

    }


    public function postConfirm( Request $request )
    {
       //dd($request);
       
        $employee_id = $request->id;

        //$result = Payment::where('designation_id', '=', $designation->id )
                            //->exists();

        $payment = new Payment;

        $payment->employee_id = $employee_id;
        $payment->month = $request->month;
        $payment->year = $request->year;
        $payment->basic_salary = $request->basic_salary;
        $payment->net_salary = $request->net_salary;

        $payment->overtime = $request->over_time;
        $payment->bonus = $request->bonus_taka;
        $payment->advance = $request->advance_tk;
        $payment->deduction = $request->deductions;
        $payment->others = $request->others_tk;
        $payment->by = $request->by;
        $payment->words = $request->words;

        $payment->paid = 1;

        $payment->save();
        //dd($payment);

        //return redirect()->route('print');
        return $payment->id;
    }


}
