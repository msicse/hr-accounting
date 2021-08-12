<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Payment;
use DB;
use PDF;

class PaymentController extends Controller
{
    
    function __construct()
    {
        $this->middleware('auth');
    }
    
    public function getPrint($id)
    {

    	$payment = DB::table('payment')
            ->join('profile', 'payment.employee_id', '=', 'profile.employee_id')
            ->select('payment.*', 'profile.first_name','profile.middle_name','profile.last_name')
            ->where('payment.id',$id)
            ->first();

    	$pdf = PDF::loadView('print.receive', compact('payment'))->setPaper('a4');
		return $pdf->stream();
    }
}
