<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Account;
use App\Income;
use App\Expens;
use DB;

class ReportingController extends Controller
{
    
	function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
    	$accounts = Account::all();
    	return view('bookeeping.reporting.account-statement')->withAccounts($accounts);
    }

    public function postAccount( Request $request )
    {
    	//return $request->all();

    	// $daterange = date('y-m-d',;



    	$to = '';
    	$from = '';
    	if(!empty($request->input('to'))){
    		$to = str_replace('/', '-', $request->input('to'));
    		$to = date('d-m-Y', strtotime($to));
    	}

    	if(!empty($request->input('from'))){
    		 $from = str_replace('/', '-', $request->input('from'));
    		 
    	 	$from = date('d-m-Y', strtotime($from));
    	}

    	if ($request->input('account_id') == 'all') {
		
		

    		if ($request->input('transaction') == 'debit') {

    			$debits = DB::table('expenses')
			            ->join('accounts', 'expenses.account_id', '=', 'accounts.id')
			            ->select('expenses.*', 'accounts.title as ac_title')
			            ->whereBetween('expenses.date', array($from,$to))
			            ->get();

			    $purchase = DB::table('purchase')
			            ->join('accounts', 'purchase.account_id', '=', 'accounts.id')
			            ->select('purchase.*', 'accounts.title as ac_title')
			            ->whereBetween('purchase.due_date', array($from,$to))
			            ->get();

    			//$debits = Expens::whereBetween('created_at', array($from,$to))->get();

    			return redirect()->route('account-statement.index')->withDebits($debits)->withPurchase($purchase);

    			//Expens::whereBetween('created_at', array($from,$to))->get();

    		} elseif ( $request->input('transaction') == 'credit' ) {
    			
    			$credits = DB::table('incomes')
			            ->join('accounts', 'incomes.account_id', '=', 'accounts.id')
			            ->select('incomes.*', 'accounts.title as ac_title')
			            ->whereBetween('incomes.date', array($from,$to))
			            ->get();

			    $sales = DB::table('sale')
			            ->join('accounts', 'sale.account_id', '=', 'accounts.id')
			            ->select('sale.*', 'accounts.title as ac_title')
			            ->whereBetween('sale.due_date', array($from,$to))
			            ->get();

    			return redirect()->route('account-statement.index')->withCredits($credits)->withSales($sales);

    		} else {

    				//$debits = Expens::whereBetween('created_at', array($from,$to))->get();
    			$credits = DB::table('incomes')
			            ->join('accounts', 'incomes.account_id', '=', 'accounts.id')
			            ->select('incomes.*', 'accounts.title as ac_title')
			            ->whereBetween('incomes.date', array($from,$to))
			            ->get();

			    $sales = DB::table('sale')
			            ->join('accounts', 'sale.account_id', '=', 'accounts.id')
			            ->select('sale.*', 'accounts.title as ac_title')
			            ->whereBetween('sale.due_date', array($from,$to))
			            ->get();

			    $debits = DB::table('expenses')
			            ->join('accounts', 'expenses.account_id', '=', 'accounts.id')
			            ->select('expenses.*','accounts.title as ac_title')
			            ->whereBetween('expenses.date', array($from,$to))
			            ->get();

			    $purchase = DB::table('purchase')
			            ->join('accounts', 'purchase.account_id', '=', 'accounts.id')
			            ->select('purchase.*', 'accounts.title as ac_title')
			            ->whereBetween('purchase.due_date', array($from,$to))
			            ->get();

			    return redirect()->route('account-statement.index')->withCredits($credits)->withSales($sales)->withDebits($debits)->withPurchase($purchase);
    		}
    	} else {
    		
    		$account_id = $request->input('account_id');

    		if ($request->input('transaction') == 'debit') {

    			$debits = DB::table('expenses')
			            ->join('accounts', 'expenses.account_id', '=', 'accounts.id')
			            ->select('expenses.*','accounts.title as ac_title')
			            ->whereBetween('expenses.date', array($from,$to))
			            ->where('expenses.account_id',$account_id)
			            ->get();

			    $purchase = DB::table('purchase')
			            ->join('accounts', 'purchase.account_id', '=', 'accounts.id')
			            ->select('purchase.*', 'accounts.title as ac_title')
			            ->whereBetween('purchase.due_date', array($from,$to))
			            ->where('purchase.account_id',$account_id)
			            ->get();

    			//$debits = Expens::whereBetween('created_at', array($from,$to))->get();

    			return redirect()->route('account-statement.index')->withDebits($debits)->withPurchase($purchase);

    			//Expens::whereBetween('created_at', array($from,$to))->get();

    		}elseif ( $request->input('transaction') == 'credit' ) {
    			
    			$credits = DB::table('incomes')
			            ->join('accounts', 'incomes.account_id', '=', 'accounts.id')
			            ->select('incomes.*', 'accounts.title as ac_title')
			            ->whereBetween('incomes.date', array($from,$to))
			            ->where('incomes.account_id',$account_id)
			            ->get();

			    $sales = DB::table('sale')
			            ->join('accounts', 'sale.account_id', '=', 'accounts.id')
			            ->select('sale.*', 'accounts.title as ac_title')
			            ->whereBetween('sale.due_date', array($from,$to))
			            ->where('sale.account_id',$account_id)
			            ->get();

    			return redirect()->route('account-statement.index')->withCredits($credits)->withSales($sales);

    		} else {

    				//$debits = Expens::whereBetween('created_at', array($from,$to))->get();
    			$credits = DB::table('incomes')
			            ->join('accounts', 'incomes.account_id', '=', 'accounts.id')
			            ->select('incomes.*', 'accounts.title as ac_title')
			            ->whereBetween('incomes.date', array($from,$to))
			            ->where('incomes.account_id',$account_id)
			            ->get();

			    $sales = DB::table('sale')
			            ->join('accounts', 'sale.account_id', '=', 'accounts.id')
			            ->select('sale.*', 'accounts.title as ac_title')
			            ->whereBetween('sale.due_date', array($from,$to))
			            ->where('sale.account_id',$account_id)
			            ->get();

			    $debits = DB::table('expenses')
			            ->join('accounts', 'expenses.account_id', '=', 'accounts.id')
			            ->select('expenses.*','accounts.title as ac_title')
			            ->whereBetween('expenses.date', array($from,$to))
			            ->where('expenses.account_id',$account_id)
			            ->get();

			    $purchase = DB::table('purchase')
			            ->join('accounts', 'purchase.account_id', '=', 'accounts.id')
			            ->select('purchase.*', 'accounts.title as ac_title')
			            ->whereBetween('purchase.due_date', array($from,$to))
			            ->where('purchase.account_id',$account_id)
			            ->get();

			    return redirect()->route('account-statement.index')->withCredits($credits)->withSales($sales)->withDebits($debits)->withPurchase($purchase);


    		}
    	} 	
    }
    public function getIncome( )
    {
    	$accounts = Account::all();
    	return view('bookeeping.reporting.income')->withAccounts($accounts);
    }

    public function postIncome( Request $request )
    {
    	$to = '';
    	$from = '';
    	if(!empty($request->input('to'))){
    		$to = str_replace('/', '-', $request->input('to'));
    		$to = date('d-m-Y', strtotime($to));
    	}

    	if(!empty($request->input('from'))){
    		 $from = str_replace('/', '-', $request->input('from'));
    		 
    	 	$from = date('d-m-Y', strtotime($from));
    	}
		
    	if ($request->input('account_id') == 'all') {
    			
    			$credits = DB::table('incomes')
			            ->join('accounts', 'incomes.account_id', '=', 'accounts.id')
			            ->select('incomes.*', 'accounts.title as ac_title')
			            ->whereBetween('incomes.date', array($from,$to))
			            ->get();

			    $sales = DB::table('sale')
			            ->join('accounts', 'sale.account_id', '=', 'accounts.id')
			            ->select('sale.*', 'accounts.title as ac_title')
			            ->whereBetween('sale.due_date', array($from,$to))
			            ->get();

    			return redirect()->route('report.income')->withCredits($credits)->withSales($sales);

    	} else {
    		
    		$account_id = $request->input('account_id');
    			
    			$credits = DB::table('incomes')
			            ->join('accounts', 'incomes.account_id', '=', 'accounts.id')
			            ->select('incomes.*', 'accounts.title as ac_title')
			            ->whereBetween('incomes.date', array($from,$to))
			            ->where('incomes.account_id',$account_id)
			            ->get();

			    $sales = DB::table('sale')
			            ->join('accounts', 'sale.account_id', '=', 'accounts.id')
			            ->select('sale.*', 'accounts.title as ac_title')
			            ->whereBetween('sale.due_date', array($from,$to))
			            ->where('sale.account_id',$account_id)
			            ->get();
					//return $from .'/'.$to;
					//return $sales;
    			return redirect()->route('report.income')->withCredits($credits)->withSales($sales);

    		} 	
    }

    public function getExpens()
    {
    	$accounts = Account::all();
    	return view('bookeeping.reporting.expens')->withAccounts($accounts);
    }

    public function postExpens(Request $request)
    {
    	$to = '';
    	$from = '';
    	if(!empty($request->input('to'))){
    		$to = str_replace('/', '-', $request->input('to'));
    		$to = date('d-m-Y', strtotime($to));
    	}

    	if(!empty($request->input('from'))){
    		 $from = str_replace('/', '-', $request->input('from'));
    		 
    	 	$from = date('d-m-Y', strtotime($from));
    	}

    	if ($request->input('account_id') == 'all') {

    			$debits = DB::table('expenses')
			            ->join('accounts', 'expenses.account_id', '=', 'accounts.id')
			            ->select('expenses.*','accounts.title as ac_title')
			            ->whereBetween('expenses.date', array($from,$to))
			            ->get();
			     //return $debits;

			    $purchase = DB::table('purchase')
			            ->join('accounts', 'purchase.account_id', '=', 'accounts.id')
			            ->select('purchase.*', 'accounts.title as ac_title')
			            ->whereBetween('purchase.due_date', array($from,$to))
			            ->get();

    			//$debits = Expens::whereBetween('created_at', array($from,$to))->get();

    			return redirect()->route('report.expens')->withDebits($debits)->withPurchase($purchase);
    	} else {
    		
    		$account_id = $request->input('account_id');

    			$debits = DB::table('expenses')
			            ->join('accounts', 'expenses.account_id', '=', 'accounts.id')
			            ->select('expenses.*','accounts.title as ac_title')
			            ->whereBetween('expenses.date', array($from,$to))
			            ->where('expenses.account_id',$account_id)
			            ->get();

			    $purchase = DB::table('purchase')
			            ->join('accounts', 'purchase.account_id', '=', 'accounts.id')
			            ->select('purchase.*', 'accounts.title as ac_title')
			            ->whereBetween('purchase.due_date', array($from,$to))
			            ->where('purchase.account_id',$account_id)
			            ->get();

    			//$debits = Expens::whereBetween('created_at', array($from,$to))->get();

    			return redirect()->route('report.expens')->withDebits($debits)->withPurchase($purchase);
    	}
    }

}
