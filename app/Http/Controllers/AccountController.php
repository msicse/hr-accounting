<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Account;
use App\Income;
use App\Expens;
use App\Purchase;
use App\Sale;

use App\AccountTransfer;

use Session;

use Validator;

use DB;

class AccountController extends Controller
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
        $accounts = Account::all();
        $output = "";

        $i = 0;

        foreach ($accounts as $account) {
            $i++;
            $income = 0;
            $expens = 0;
            $purchase = 0;
            $sale = 0;
            $transfer = 0;
            $incomes = Income::where('account_id','=',$account->id)->get();
            $expenses = Expens::where('account_id','=',$account->id)->get();

            $purchases = Purchase::where('account_id','=',$account->id)->get();
            $sales = Sale::where('account_id','=',$account->id)->get();
            
            foreach ($incomes as $value) {
                $income += $value->amount;
            }

            foreach ($expenses as $value) {
                $expens += $value->amount;
            }

            foreach ($purchases as $value) {
                $purchase += $value->amount;
            }

            foreach ($sales as $value) {
                $sale += $value->amount;
            }


            $total_income = $income+$sale;

            $total_expens = $expens+$purchase;

            $profit = $total_income - $total_expens;

            //$total = $account->balance + $total_income;

            //$total = $account->balance - $total_expens;

            //$ac_id = $account->id;
            
            $current = $account->balance + $profit;

            $ac_from = AccountTransfer::where('ac_from', '=', $account->id )
                            ->exists();
            $ac_to = AccountTransfer::where('ac_to', '=', $account->id )
                            ->exists();
             //dd ($ac_from);
            $from_amount = 0;
            $to_amount = 0;

            if ($ac_from) {

                $transfer_from = AccountTransfer::where('ac_from', '=', $account->id )->get();
                foreach ($transfer_from as $value) {
                    $from_amount += $value->amount;
                }
            }

            if ($ac_to) {

                $transfer_to = AccountTransfer::where('ac_to', '=', $account->id )->get();

                foreach ($transfer_to as $value) {
                    $to_amount += $value->amount;
                }
            }

            //return $from_amount . "/". $to_amount;
            $current = $current - $from_amount;

            $current = $current + $to_amount;



            


            $output .="<tr>";
            $output .="<td>$i</td>";
            $output .="<td>$account->title </td>";
            $output .="<td>$account->account_number</td>";
            $output .="<td> $account->balance </td>";
            $output .="<td>$current</td>";
            $output .="<td>";
                if( $account->type  == 1 ){
                    $output .="Bank";
                }elseif( $account->type == 2 ){
                     $output .="Cash";
                 }else{
                    $output .="Others";
                 }
                

            $output .="</td>";
                                
            $output .="<td>";
            $output .="<a class='btn btn-icon command-edit waves-effect waves-circle   delete_account' href='accounts/".$account->id."'><span class='zmdi zmdi-eye'></span>
                                  </a>";
            $output .="<a type='button' data-toggle='modal' data-edit-account-id='".$account->id."' data-target='#accountEdit' class='btn btn-icon command-edit waves-effect waves-circle edit_account'>
                                        <span class='zmdi zmdi-edit'></span>
                                    </a>";
            $output .="<a class='btn btn-icon command-edit waves-effect waves-circle text-danger  delete_account'  data-toggle='modal' data-target='#accountDelete' data-account-id='".$account->id."'>
                                    <span class='zmdi zmdi-delete'></span>
                                  </a>";

                                    
            $output .="</td></tr>";
            

        }

        return view('bookeeping.finantial-account.index')->withOutput($output);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bookeeping.finantial-account.create');
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
        //return $request->all();
        $validator = Validator::make($request->all(), [
            'type'        => 'required|numeric',
            'title'        => 'required',
            'account_number'    => 'required',
            'balance' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect('accounts\create')
                        ->withErrors($validator)
                        ->withInput();
        } else {
            
            $account = new Account;
            $account->type              = $request->input('type');
            $account->title             = $request->input('title');
            $account->account_number    = $request->input('account_number');
            $account->balance           = $request->input('balance');
           
            $account->save();

            Session::flash('message', 'Successfully Added Account!');

            return redirect('accounts');
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
        $accounts = Account::find($id);





        $credits = DB::table('incomes')
                ->join('accounts', 'incomes.account_id', '=', 'accounts.id')
                ->select('incomes.*', 'accounts.title as ac_title')
                ->where('incomes.account_id',$id)
                ->get();

        $sales = DB::table('sale')
                ->join('accounts', 'sale.account_id', '=', 'accounts.id')
                ->select('sale.*', 'accounts.title as ac_title')
                ->where('sale.account_id',$id)
                ->get();

        $debits = DB::table('expenses')
                ->join('accounts', 'expenses.account_id', '=', 'accounts.id')
                ->select('expenses.*','accounts.title as ac_title')
                ->where('expenses.account_id',$id)
                ->get();

        $purchase = DB::table('purchase')
                ->join('accounts', 'purchase.account_id', '=', 'accounts.id')
                ->select('purchase.*', 'accounts.title as ac_title')
                ->where('purchase.account_id',$id)
                ->get();

            
            $famount = 0;
            $tamount = 0;

            $ac_from = AccountTransfer::where('ac_from', '=', $id )
                            ->exists();
            $ac_to = AccountTransfer::where('ac_to', '=', $id )
                            ->exists();


            // if ($ac_from) {

            //     $transferfrom = AccountTransfer::where('ac_from', '=', $id )->get();
            //     // foreach ($transfer_from as $value) {
            //     //     $famount += $value->amount;
            //     // }
            // }

            // if ($ac_to) {

            //     $transferto = AccountTransfer::where('ac_to', '=', $id )->get();

            //     // foreach ($transfer_to as $value) {
            //     //     $tamount += $value->amount;
            //     // }
            // }

            $transferto = DB::table('account_transfer')
            ->join('accounts as f', 'account_transfer.ac_from', '=', 'f.id')
            ->join('accounts as t', 'account_transfer.ac_to', '=', 't.id')
            //->join('orders', 'users.id', '=', 'orders.user_id')
            ->where('ac_to','=', $id )
            ->select('account_transfer.*', 'f.title as f_title','t.title as t_title')
            ->get();

            $transferfrom = DB::table('account_transfer')
            ->join('accounts as f', 'account_transfer.ac_from', '=', 'f.id')
            ->join('accounts as t', 'account_transfer.ac_to', '=', 't.id')
            //->join('orders', 'users.id', '=', 'orders.user_id')
            ->where('ac_from','=', $id )
            ->select('account_transfer.*', 'f.title as f_title','t.title as t_title')
            ->get();



        return view('bookeeping.finantial-account.ledger')->withCredits($credits)->withSales($sales)->withDebits($debits)->withPurchase($purchase)->withAccounts($accounts)->withTransferto($transferto)->withTransferfrom($transferfrom);
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit_account = Account::find($id);
        return $edit_account;
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
            
            $account = Account::find($id);

            $validator = Validator::make($request->all(), [
           
            'title'        => 'required',
            'account_number'    => 'required',
            'balance' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('accounts')
                        ->withErrors($validator)
                        ->withInput();
        } else {

            
            $account->title             = $request->input('title');
            $account->account_number    = $request->input('account_number');
            $account->balance           = $request->input('balance');
           
            $account->save();

            Session::flash('message', 'Successfully Updated Account!');

            return redirect('accounts');
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
        $designation = Account::find($id);

        $income = Income::where('account_id', '=', $designation->id )
                            ->exists();
        $expens = Expens::where('account_id', '=', $designation->id )
                            ->exists();
        $purchase = Purchase::where('account_id', '=', $designation->id )
                            ->exists();
        $sale = Sale::where('account_id', '=', $designation->id )
                            ->exists();

        if ( $income ) {
            
            Session::flash('error-message', 'Please Incomes History  Delete first !');    
            return redirect('incomes');
        }

        if ( $expens ) {
            
            Session::flash('error-message', 'Please Expenses History Delete first !');    
            return redirect('expenses');
        }

        if ( $purchase ) {
            
            Session::flash('error-message', 'Please Purchase History  Delete first !');    
            return redirect('purchase');
        }

        if ( $sale ) {
            
            Session::flash('error-message', 'Please Sale History  Delete first !');    
            return redirect('sales');
        } else {

            $designation->delete();
            return redirect()->back()->with('message','Delete Succesfully');
        }
    }
}
