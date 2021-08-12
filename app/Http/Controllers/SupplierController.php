<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Contact;

use App\Purchase;
use Session;
use Validator;
use DB;

class SupplierController extends Controller
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
        $contacts = Contact::where('type','supplier')->get();
        return view('bookeeping.contact.suppliers')->withContacts($contacts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            // 'name'=> 'required',
            // 'price'=> 'required',
        ]);
        
        if ($validator->fails()) {
            return redirect('suppliers')
                        ->withErrors($validator)
                        ->withInput();
        } else {
            
            $customer = new Contact ;
            $customer->type = 'supplier';
            $customer->first_name = $request->input('first_name');
            $customer->last_name = $request->input('last_name');
            $customer->phone = $request->input('phone');
            $customer->mobile = $request->input('mobile');
            $customer->email = $request->input('email');
            $customer->skype_id = $request->input('skype_id');
            $customer->company_name = $request->input('company_name');
            $customer->website = $request->input('website');
            $customer->address = $request->input('address');
            $customer->city = $request->input('city');
            $customer->country = $request->input('country');
            $customer->state = $request->input('state');
            $customer->zip_code = $request->input('zip_code');
            $customer->bank_account = $request->input('bank_account');
            
            $customer->timestamps = false;
            $customer->save();
            

            Session::flash('message', 'Successfully Added Supplier!');

            return redirect()->route('suppliers.index');
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
        $contact = Contact::find($id);

        $purchases = DB::table('purchase')
            ->join('contacts', 'purchase.supplier_id', '=', 'contacts.id')
            //->join('orders', 'users.id', '=', 'orders.user_id')
            ->select('purchase.*', 'contacts.first_name','contacts.last_name')
            ->where('purchase.supplier_id',$id)
            ->get();

            return view('bookeeping.contact.view')->withContact($contact)->withPurchases($purchases);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contact = Contact::find($id);
        return $contact;
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
        $customer = Contact::find($id);
        $validator = Validator::make($request->all(), [ 
            // 'name'=> 'required',
            // 'price'=> 'required',
        ]);
        
        if ($validator->fails()) {
            return redirect('suppliers')
                        ->withErrors($validator)
                        ->withInput();
        } else {
            
            
            $customer->type = 'supplier';
            $customer->first_name = $request->input('first_name');
            $customer->last_name = $request->input('last_name');
            $customer->phone = $request->input('phone');
            $customer->mobile = $request->input('mobile');
            $customer->email = $request->input('email');
            $customer->skype_id = $request->input('skype_id');
            $customer->company_name = $request->input('company_name');
            $customer->website = $request->input('website');
            $customer->address = $request->input('address');
            $customer->city = $request->input('city');
            $customer->country = $request->input('country');
            $customer->state = $request->input('state');
            $customer->zip_code = $request->input('zip_code');
            $customer->bank_account = $request->input('bank_account');
            
            $customer->timestamps = false;
            $customer->save();
            

            Session::flash('message', 'Successfully Updated !');

            return redirect()->route('suppliers.index');
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
        $designation = Contact::find($id);
        
        $result = Purchase::where('supplier_id', '=', $designation->id )
                            ->exists();

        if ( $result ) {
            
            Session::flash('error-message', 'Please Purchase  History  Delete first !');    
            return redirect('purchases');
        } else {

            $designation->delete();
            return redirect()->back()->with('message','Delete Succesfully');
        }
    }
}
