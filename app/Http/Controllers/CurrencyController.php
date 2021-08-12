<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Currency;
use Session;
use Validator;

class CurrencyController extends Controller
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
        $currencys = Currency::all();
         
         return view('bookeeping.settings.currency')->withCurrencys($currencys);
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
            'name'=> 'required',
            'symbol'=> 'required',
            'code'=> 'required',
            ]);
        
        if ($validator->fails()) {
            return redirect('currency')
                        ->withErrors($validator)
                        ->withInput();
        } else {
            
            $vat = new Currency ;
            $vat->currency_name = $request->input('name');
            $vat->currency_code = $request->input('code');
            $vat->currency_symbol = $request->input('symbol');
            $vat->timestamps = false;
            $vat->save();
            

            Session::flash('message', 'Successfully Added !');

            return redirect()->route('currency.index');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit_category = Currency::find($id);
        return $edit_category;
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
        $vat = Currency::find($id);
        $validator = Validator::make($request->all(), [ 
            'name'=> 'required',
            'symbol'=> 'required',
            'code'=> 'required'
            ]);
        
        if ($validator->fails()) {
            return redirect('categories')
                        ->withErrors($validator)
                        ->withInput();
        } else {
            
            
            $vat->currency_name = $request->input('name');
            $vat->currency_code = $request->input('code');
            $vat->currency_symbol = $request->input('symbol');
            $vat->timestamps = false;
            $vat->save();
            

            Session::flash('message', 'Successfully Updated');

            return redirect()->route('currency.index');
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
        $designation = Currency::find($id);
        $designation->delete();
        return redirect()->back()->with('message','Delete Succesfully');
    }
}
