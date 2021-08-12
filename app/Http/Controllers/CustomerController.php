<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Contact;
use App\Sale;
use Session;
use Validator;
use DB;

class CustomerController extends Controller
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
        $contacts = Contact::where('type','customer')->get();
        return view('bookeeping.contact.customers')->withContacts($contacts);
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
            return redirect('categories')
                        ->withErrors($validator)
                        ->withInput();
        } else {
            
            $customer = new Contact ;
            $customer->type = 'customer';
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
            

            Session::flash('message', 'Successfully Added Customer!');

            return redirect()->route('customers.index');
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
        
      $purchases = DB::table('sale')
            ->join('contacts', 'sale.customer_id', '=', 'contacts.id')
            //->join('orders', 'users.id', '=', 'orders.user_id')
            ->select('sale.*', 'contacts.first_name','contacts.last_name')
            ->where('sale.customer_id',$id)
            ->get();

        //return view('bookeeping.sales.index')->;

        return view('bookeeping.contact.customer-view')->withContact($contact)->withPurchases($purchases);
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
            return redirect('categories')
                        ->withErrors($validator)
                        ->withInput();
        } else {
            
            
            $customer->type = 'customer';
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
            

            Session::flash('message', 'Successfully Updated Customer!');

            return redirect()->route('customers.index');
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

        $result = Sale::where('customer_id', '=', $designation->id )
                            ->exists();

        if ( $result ) {
            
            Session::flash('error-message', 'Please Sale History  Delete first !');    
            return redirect('sales');
        } else {

            $designation->delete();
            return redirect()->back()->with('message','Delete Succesfully');
        }
    }
}
