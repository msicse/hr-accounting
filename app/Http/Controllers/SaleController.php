<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Contact;

use App\Account;

use App\Product;

use App\Sale;

use App\SaleItem;

use App\Vat;

use Session;

use Validator;

use DB;

use PDF;


class SaleController extends Controller
{
    
    function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
	{
        //$purchases = Purchase::all();
		
        $purchases = DB::table('sale')
            ->join('contacts', 'sale.customer_id', '=', 'contacts.id')
            //->join('orders', 'users.id', '=', 'orders.user_id')
            ->select('sale.*', 'contacts.first_name','contacts.last_name')
            ->get();

        return view('bookeeping.sales.index')->withPurchases($purchases);
	}

    public function create()
    {
    	$suppliers = Contact::where('type','customer')->get();
        $inventories = Product::all();
        $vats = Vat::all();
        $accounts = Account::all();
         
         return view('bookeeping.sales.create')->withSuppliers($suppliers)->withInventories($inventories)->withVats($vats)->withAccounts($accounts);
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
       // return $request->all();
        $validator = Validator::make($request->all(), [
             'account_id'        => 'required',
             'supplier_id'    => 'required',
             'quantity' => 'required',
             'due_date' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect('sales/create')
                        ->withErrors($validator)
                        ->withInput();
        } else {
         
            $input = $request->all();

            $purchases = new Sale;

            $purchases->sale_code = $request->input('purchase_code');
            $purchases->due_date = str_replace("/", "-", $request->input('due_date'));
            $purchases->amount = $request->input('amount');
            $purchases->discount = $request->input('discount');
            $purchases->vat_id = $request->input('vat_id');
            $purchases->account_id = $request->input('account_id');
            $purchases->customer_id = $request->input('supplier_id');
            
            $purchases->save();
            
            //return $purchases->id;
            //$result = array();

            for( $i=0; $i<count($input['product_id']);$i++ ){

                ///return $input['quantity'][$i];

                $purchases_item = new SaleItem;
                $purchases_item->sale_id = $purchases->id;
                $purchases_item->quantity = $input['quantity'][$i];
                $purchases_item->product_id = $input['product_id'][$i];
                $purchases_item->purchase_price = $input['purchases_price'][$i];
                $purchases_item->timestamps = false;
                $purchases_item->save();
            }

            Session::flash('message', 'Successfully Added !');

            return redirect()->route('sales.index');
       }


    }

    public function edit($id)
    {
        $suppliers = Contact::where('type','customer')->get();
        $inventories = Product::all();
        $vats = Vat::all();
        $accounts = Account::all();

        
			
			$vat_chk = Sale::find($id);

			if ( empty($vat_chk->vat_id) ) {
				$invoice = DB::table('sale')
				->join('accounts', 'sale.account_id', '=', 'accounts.id')
				->join('contacts', 'sale.customer_id', '=', 'contacts.id')
				//->join('vat', 'sale.vat_id', '=', 'vat.id')
				->select('sale.*', 'accounts.title','contacts.email','contacts.first_name','contacts.phone','contacts.address')
				->where('sale.id',$id)

				->first();
					
				} else {

					$invoice = DB::table('sale')
					->join('accounts', 'sale.account_id', '=', 'accounts.id')
					->join('contacts', 'sale.customer_id', '=', 'contacts.id')
					->join('vat', 'sale.vat_id', '=', 'vat.id')
					->select('sale.*', 'accounts.title','contacts.email','contacts.first_name','contacts.phone','contacts.address','vat.percentage')
					->where('sale.id',$id)

					->first();
				}

        //$purchaseitems = PurchaseItem::where('purchase_id',$id)->get();

        $purchaseitems = DB::table('sale_item')
            ->join('products', 'sale_item.product_id', '=', 'products.id')
            //->join('contacts', 'purchase.supplier_id', '=', 'contacts.id')
            //->select('purchase.*', 'accounts.title','contacts.email','contacts.phone','contacts.address')
            ->where('sale_item.sale_id',$id)
            
            ->get();
         
         return view('bookeeping.sales.edit')->withSuppliers($suppliers)->withInventories($inventories)->withVats($vats)->withAccounts($accounts)->withPurchaseitems($purchaseitems)->withInvoice($invoice);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'account_id'        => 'required',
             'supplier_id'    => 'required',
             'quantity' => 'required',
             'due_date' => 'required',
            
        ]);
        if ($validator->fails()) {
            return redirect('sales/'.$id.'/edit')
                        ->withErrors($validator)
                        ->withInput();
        } else {
            //return $request->all();
            $input = $request->all();
            
            $purchases = Sale::find($id);

            //$purchases->purchase_code = $request->input('purchase_code');
            $purchases->due_date = str_replace("/","-",$request->input('due_date'));
            $purchases->amount = $request->input('amount');
            $purchases->discount = $request->input('discount');
            $purchases->vat_id = $request->input('vat_id');
            $purchases->account_id = $request->input('account_id');
            $purchases->customer_id = $request->input('supplier_id');
            
            $purchases->save();
            
            //$result = array();

            

            for( $i=0; $i<count($input['product_id']);$i++ ){

                ///return $input['quantity'][$i];

                $purchase_check = SaleItem::where('sale_id', '=', $id )
                                                ->where('product_id','=', $input['product_id'][$i] )
                                                ->exists();
                if ( $purchase_check ) {

                    $purchases_item = SaleItem::where('sale_id', '=', $id )
                                                ->where('product_id','=', $input['product_id'][$i] )
                                                ->first();
                    //return $purchases_item;

                    $purchases_item->sale_id = $purchases->id;
                    $purchases_item->quantity = $input['quantity'][$i];
                    //$purchases_item->product_id = $input['product_id'][$i];
                    $purchases_item->purchase_price = $input['purchases_price'][$i];
                    $purchases_item->timestamps = false;
                    $purchases_item->save();

                } else {

                    $purchases_item = new SaleItem;
                    $purchases_item->sale_id = $id;
                    $purchases_item->quantity = $input['quantity'][$i];
                    $purchases_item->product_id = $input['product_id'][$i];
                    $purchases_item->purchase_price = $input['purchases_price'][$i];
                    $purchases_item->timestamps = false;
                    $purchases_item->save();
                }

                
            }

            Session::flash('message', 'Successfully Updated !');

            return redirect()->route('sales.index');
       }
    }

    public function viewInvoice($id)
    {
        //return $id;
        //$invoice = Purchase::find($id);

        $vat_chk = Sale::find($id);

        if ( empty($vat_chk->vat_id) ) {
            $invoice = DB::table('sale')
                ->join('accounts', 'sale.account_id', '=', 'accounts.id')
                ->join('contacts', 'sale.customer_id', '=', 'contacts.id')
                ->select('sale.*', 'accounts.title','contacts.*')
                ->where('sale.id',$id)

                ->first();
                
            } else {

                $invoice = DB::table('sale')
                ->join('accounts', 'sale.account_id', '=', 'accounts.id')
                ->join('contacts', 'sale.customer_id', '=', 'contacts.id')
                ->join('vat', 'sale.vat_id', '=', 'vat.id')
                ->select('sale.*', 'accounts.title','contacts.*','vat.percentage')
                ->where('sale.id',$id)

                ->first();
            }


        //$purchaseitems = PurchaseItem::where('purchase_id',$id)->get();

        $purchaseitems = DB::table('sale_item')
            ->join('products', 'sale_item.product_id', '=', 'products.id')
            //->join('contacts', 'purchase.supplier_id', '=', 'contacts.id')
            //->select('purchase.*', 'accounts.title','contacts.email','contacts.phone','contacts.address')
            ->where('sale_item.sale_id',$id)
            
            ->get();

        return view('bookeeping.sales.view-invoice')->withInvoice($invoice)->withPurchaseitems($purchaseitems)->withId($id);

    }

    public function invoicePrint($id)
    {
        $vat_chk = Sale::find($id);

        if ( empty($vat_chk->vat_id) ) {
            $invoice = DB::table('sale')
                ->join('accounts', 'sale.account_id', '=', 'accounts.id')
                ->join('contacts', 'sale.customer_id', '=', 'contacts.id')
                ->select('sale.*', 'accounts.title','contacts.*')
                ->where('sale.id',$id)

                ->first();
                
            } else {

                $invoice = DB::table('sale')
                ->join('accounts', 'sale.account_id', '=', 'accounts.id')
                ->join('contacts', 'sale.customer_id', '=', 'contacts.id')
                ->join('vat', 'sale.vat_id', '=', 'vat.id')
                ->select('sale.*', 'accounts.title','contacts.*','vat.percentage')
                ->where('sale.id',$id)

                ->first();
            }

        //$purchaseitems = PurchaseItem::where('purchase_id',$id)->get();

        $purchaseitems = DB::table('sale_item')
            ->join('products', 'sale_item.product_id', '=', 'products.id')
            //->join('contacts', 'purchase.supplier_id', '=', 'contacts.id')
            //->select('purchase.*', 'accounts.title','contacts.email','contacts.phone','contacts.address')
            ->where('sale_item.sale_id',$id)
            
            ->get();

        //return view('bookeeping.purchases.purchase-print')->withInvoice($invoice)->withPurchaseitems($purchaseitems);

        $pdf = PDF::loadView('bookeeping.sales.sale-print', compact('purchaseitems','invoice'))->setPaper('a4');

        return $pdf->stream();
    }

    public function destroy( $id )
    {
    	$sale_item = SaleItem::where('sale_id',$id)->delete();

    	Sale::find($id)->delete();
    	
    	return redirect()->back()->with('message','Delete Succesfully');

    		
    }

}
