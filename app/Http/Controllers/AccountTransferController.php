<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Account;
use App\AccountTransfer;
use Validator;
use Session;
use DB;
class AccountTransferController extends Controller
{
    
	function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

    	
    	$accounts = Account::all();

    	$transfer = DB::table('account_transfer')
            ->join('accounts as f', 'account_transfer.ac_from', '=', 'f.id')
            ->join('accounts as t', 'account_transfer.ac_to', '=', 't.id')
            //->join('orders', 'users.id', '=', 'orders.user_id')
            ->select('account_transfer.*', 'f.title as f_title','t.title as t_title')
            ->get();

    	//$transfer = AccountTransfer::all();

    	return view("bookeeping.finantial-account.transfer")->withTransfer($transfer)->withAccounts($accounts);


    }

    public function create()
    {
        $accounts = Account::all();
        return view("bookeeping.finantial-account.transfer-create")->withAccounts($accounts);
    }

    public function store( Request $request )
    {
    	$validator = Validator::make($request->all(), [
            'from'        => 'required|numeric',
            'to'        => 'required|numeric',
            'amount'    => 'required|numeric',
            //'balance' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('account-transfer')
                        ->withErrors($validator)
                        ->withInput();
        } else {

           

        	$transfer = new AccountTransfer;

        	$transfer->ac_from = $request->input("from");
        	$transfer->ac_to = $request->input("to");
        	$transfer->amount = $request->input("amount");
            $transfer->date = str_replace("/", "-", $request->input('date'));
        	$transfer->save();

        	Session::flash('message', 'Successfully Added !');

            return redirect('account-transfer');
        }
    }
    public function edit($id)
    {
    	$data = AccountTransfer::find($id);

    	return $data;
    }
    public function update( Request $request,$id )
    {
    	$transfer = AccountTransfer::find($id);

    	$validator = Validator::make($request->all(), [
            'from'        => 'required|numeric',
            'to'        => 'required|numeric',
            'amount'    => 'required|numeric',
            //'balance' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect('account-transfer')
                        ->withErrors($validator)
                        ->withInput();
        } else {

        	
        	$transfer->ac_from = $request->input("from");
        	$transfer->ac_to = $request->input("to");
            $transfer->amount = $request->input("amount");
        	$transfer->date = $request->input("date");
        	$transfer->save();

        	Session::flash('message', 'Successfully Updated !');

            return redirect('account-transfer');
        }
    }

    public function delete($id)
    {
    	
    	AccountTransfer::find($id)->delete();
        
    	Session::flash('message', 'Successfully Deleted !');

        return redirect('account-transfer');
    }


}
