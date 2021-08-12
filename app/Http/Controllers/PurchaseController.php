<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Contact;

use App\Account;

use App\Product;

use App\Purchase;

use App\PurchaseItem;

use App\Vat;

use Session;

use Validator;

use DB;

use PDF;

class PurchaseController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }
	
    public function index()
	{
        //$purchases = Purchase::all();
		
        $purchases = DB::table('purchase')
            ->join('contacts', 'purchase.supplier_id', '=', 'contacts.id')
            //->join('orders', 'users.id', '=', 'orders.user_id')
            ->select('purchase.*', 'contacts.first_name','contacts.last_name')
            ->get();

        return view('bookeeping.purchases.index')->withPurchases($purchases);
	}

    public function create()
    {
    	$suppliers = Contact::where('type','supplier')->get();
        $inventories = Product::all();
        $vats = Vat::all();
        $accounts = Account::all();
         
         return view('bookeeping.purchases.create')->withSuppliers($suppliers)->withInventories($inventories)->withVats($vats)->withAccounts($accounts);
    }

    public function show($id)
    {
    	$output ="";
    	$product = Product::find($id);
    	
    	$output = "<td>
    	<input type='hidden' onclick='calculate_single_entry_sum($id);' onkeyup='calculate_single_entry_sum($id);' name='product_id[]' id='".$product->id."' value='".$product->id."'>"
    	.$product->product_code."</td><td>".$product->name."</td>
    	<td><input onclick='calculate_single_entry_sum($id);' onkeyup='calculate_single_entry_sum($id);' type='number' value='0' min='1'name='quantity[]' id='single_entry_quantity_$id'></td>
    	<td><input type='number' id='single_entry_price_$id' name='purchases_price[]' value='".$product->price."'></td><td id='single_entry_total_$id'></td>".
		"<td><button type='button' class='btn btn-danger btn-xs delete' onclick ='delete_user($(this))'>Remove</button></td>";
    	
        return $output;
         
        
    }

    public function grandTotal($sub_total, $vat_id, $discount)
    {
        $grand_total = 0;

        if($vat_id != 0) {
            $vat = Vat::find($vat_id);
            $vat_percentage = $vat->percentage;
            $grand_total = $sub_total + $sub_total * $vat_percentage / 100 - $discount;
        } else {
            $grand_total = $sub_total - $discount;
        }
        
        return $grand_total;
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'purchase_code'        => 'required',
            'quantity'    => 'required',
			'account_id'        => 'required',
            'supplier_id'    => 'required',
            
        ]);
        if ($validator->fails()) {
            return redirect('purchase/create')
                        ->withErrors($validator)
                        ->withInput();
        } else {
         
            $input = $request->all();
            
            $purchases = new Purchase;

            $purchases->purchase_code = $request->input('purchase_code');
            $purchases->due_date = str_replace("/","-",$request->input('due_date'));
            $purchases->amount = $request->input('amount');
            $purchases->discount = $request->input('discount');
            $purchases->vat_id = $request->input('vat_id');
            $purchases->account_id = $request->input('account_id');
            $purchases->supplier_id = $request->input('supplier_id');
            
            $purchases->save();
            
            //$result = array();

            for( $i=0; $i<count($input['product_id']);$i++ ){

                ///return $input['quantity'][$i];

                $purchases_item = new PurchaseItem;
                $purchases_item->purchase_id = $purchases->id;
                $purchases_item->quantity = $input['quantity'][$i];
                $purchases_item->product_id = $input['product_id'][$i];
                $purchases_item->purchase_price = $input['purchases_price'][$i];
                $purchases_item->timestamps = false;
                $purchases_item->save();
            }

            Session::flash('message', 'Successfully Added !');

            return redirect()->route('purchase.index');
       }


    }

    public function edit($id)
    {
        $suppliers = Contact::where('type','supplier')->get();
        $inventories = Product::all();
        $vats = Vat::all();
        $accounts = Account::all();

       
		$vat_chk = Purchase::find($id);
        //return $vat_chk;

        if ( empty($vat_chk->vat_id) ) {

             $invoice = DB::table('purchase')
            ->join('accounts', 'purchase.account_id', '=', 'accounts.id')
            ->join('contacts', 'purchase.supplier_id', '=', 'contacts.id')
            //->join('vat', 'purchase.vat_id', '=', 'vat.id')
            ->select('purchase.*', 'accounts.title','contacts.email','contacts.first_name','contacts.last_name','contacts.phone','contacts.address')
            ->where('purchase.id',$id)

            ->first();
            
        } else {

            $invoice = DB::table('purchase')
            ->join('accounts', 'purchase.account_id', '=', 'accounts.id')
            ->join('contacts', 'purchase.supplier_id', '=', 'contacts.id')
            ->join('vat', 'purchase.vat_id', '=', 'vat.id')
            ->select('purchase.*', 'accounts.title','contacts.email','contacts.first_name','contacts.last_name','contacts.phone','contacts.address','vat.percentage')
            ->where('purchase.id',$id)

            ->first();
        }

        //$purchaseitems = PurchaseItem::where('purchase_id',$id)->get();

        $purchaseitems = DB::table('purchase_item')
            ->join('products', 'purchase_item.product_id', '=', 'products.id')
            //->join('contacts', 'purchase.supplier_id', '=', 'contacts.id')
            //->select('purchase.*', 'accounts.title','contacts.email','contacts.phone','contacts.address')
            ->where('purchase_item.purchase_id',$id)
            
            ->get();
         
         return view('bookeeping.purchases.edit')->withSuppliers($suppliers)->withInventories($inventories)->withVats($vats)->withAccounts($accounts)->withPurchaseitems($purchaseitems)->withInvoice($invoice);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'purchase_code'        => 'required',
            'quantity'    => 'required',
			'supplier_id' => 'required',
            'account_id' => 'required',
			'due_date' => 'required',
            
        ]);
        if ($validator->fails()) {
            return redirect('purchase/create')
                        ->withErrors($validator)
                        ->withInput();
        } else {
            //return $request->all();
            $input = $request->all();
            
            $purchases = Purchase::find($id);

            //$purchases->purchase_code = $request->input('purchase_code');
            $purchases->due_date = str_replace("/","-",$request->input('due_date'));
            $purchases->amount = $request->input('amount');
            $purchases->discount = $request->input('discount');
            $purchases->vat_id = $request->input('vat_id');
            $purchases->account_id = $request->input('account_id');
            $purchases->supplier_id = $request->input('supplier_id');
            
            $purchases->save();
            
            //$result = array();

            

            for( $i=0; $i<count($input['product_id']);$i++ ){

                ///return $input['quantity'][$i];

                $purchase_check = PurchaseItem::where('purchase_id', '=', $id )
                                                ->where('product_id','=', $input['product_id'][$i] )
                                                ->exists();
                if ( $purchase_check ) {

                    $purchases_item = PurchaseItem::where('purchase_id', '=', $id )
                                                ->where('product_id','=', $input['product_id'][$i] )
                                                ->first();
                    //return $purchases_item;

                    $purchases_item->purchase_id = $purchases->id;
                    $purchases_item->quantity = $input['quantity'][$i];
                    //$purchases_item->product_id = $input['product_id'][$i];
                    $purchases_item->purchase_price = $input['purchases_price'][$i];
                    $purchases_item->timestamps = false;
                    $purchases_item->save();

                } else {

                    $purchases_item = new PurchaseItem;
                    $purchases_item->purchase_id = $id;
                    $purchases_item->quantity = $input['quantity'][$i];
                    $purchases_item->product_id = $input['product_id'][$i];
                    $purchases_item->purchase_price = $input['purchases_price'][$i];
                    $purchases_item->timestamps = false;
                    $purchases_item->save();
                }

                
            }

            Session::flash('message', 'Successfully Updated !');

            return redirect()->route('purchase.index');
       }
    }

    public function viewInvoice($id)
    {
        //return $id;
        //$invoice = Purchase::find($id);

        $vat_chk = Purchase::find($id);
        //return $vat_chk;

        if ( empty($vat_chk->vat_id) ) {

            $invoice = DB::table('purchase')
            ->join('accounts', 'purchase.account_id', '=', 'accounts.id')
            ->join('contacts', 'purchase.supplier_id', '=', 'contacts.id')
            ->select('purchase.*', 'accounts.title','contacts.email','contacts.phone','contacts.last_name','contacts.address','contacts.first_name')
            ->where('purchase.id',$id)

            ->first();
            
        } else {

            $invoice = DB::table('purchase')
            ->join('accounts', 'purchase.account_id', '=', 'accounts.id')
            ->join('contacts', 'purchase.supplier_id', '=', 'contacts.id')
            ->join('vat', 'purchase.vat_id', '=', 'vat.id')
            ->select('purchase.*', 'accounts.title','contacts.email','contacts.phone','contacts.last_name','contacts.address','contacts.first_name','vat.percentage')
            ->where('purchase.id',$id)
            ->first();
        }

        //$purchaseitems = PurchaseItem::where('purchase_id',$id)->get();

        $purchaseitems = DB::table('purchase_item')
            ->join('products', 'purchase_item.product_id', '=', 'products.id')
            //->join('contacts', 'purchase.supplier_id', '=', 'contacts.id')
            //->select('purchase.*', 'accounts.title','contacts.email','contacts.phone','contacts.address')
            ->where('purchase_item.purchase_id',$id)
            
            ->get();

        return view('bookeeping.purchases.view-invoice')->withInvoice($invoice)->withPurchaseitems($purchaseitems);

    }

    public function invoicePrint($id)
    {
        $vat_chk = Purchase::find($id);
        //return $vat_chk;

        if ( empty($vat_chk->vat_id) ) {

            $invoice = DB::table('purchase')
            ->join('accounts', 'purchase.account_id', '=', 'accounts.id')
            ->join('contacts', 'purchase.supplier_id', '=', 'contacts.id')
            ->select('purchase.*', 'accounts.title','contacts.email','contacts.phone','contacts.last_name','contacts.address','contacts.first_name')
            ->where('purchase.id',$id)

            ->first();
            
        } else {

            $invoice = DB::table('purchase')
            ->join('accounts', 'purchase.account_id', '=', 'accounts.id')
            ->join('contacts', 'purchase.supplier_id', '=', 'contacts.id')
            ->join('vat', 'purchase.vat_id', '=', 'vat.id')
            ->select('purchase.*', 'accounts.title','contacts.email','contacts.phone','contacts.last_name','contacts.address','contacts.first_name','vat.percentage')
            ->where('purchase.id',$id)
            ->first();
        }

        //$purchaseitems = PurchaseItem::where('purchase_id',$id)->get();

        $purchaseitems = DB::table('purchase_item')
            ->join('products', 'purchase_item.product_id', '=', 'products.id')
            //->join('contacts', 'purchase.supplier_id', '=', 'contacts.id')
            //->select('purchase.*', 'accounts.title','contacts.email','contacts.phone','contacts.address')
            ->where('purchase_item.purchase_id',$id)
            
            ->get();

        //return view('bookeeping.purchases.purchase-print')->withInvoice($invoice)->withPurchaseitems($purchaseitems);

        $pdf = PDF::loadView('bookeeping.purchases.purchase-print', compact('purchaseitems','invoice'))->setPaper('a4');

        return $pdf->stream();
    }

    public function destroy( $id )
    {
        $sale_item = PurchaseItem::where('purchase_id',$id)->delete();
        Purchase::find($id)->delete();
        
        return redirect()->back()->with('message','Delete Succesfully');

            
    }


}
