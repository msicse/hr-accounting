<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Vat;
use Session;
use Validator;

class VatController extends Controller
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
        $vats = Vat::all();
         
         return view('bookeeping.settings.vats')->withVats($vats);
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
        $validator = Validator::make($request->all(), [ 'name'=> 'required']);
        
        if ($validator->fails()) {
            return redirect('categories')
                        ->withErrors($validator)
                        ->withInput();
        } else {
            
            $vat = new Vat ;
            $vat->name = $request->input('name');
            $vat->percentage = $request->input('percentage');
            $vat->timestamps = false;
            $vat->save();
            

            Session::flash('message', 'Successfully Added Category!');

            return redirect()->route('vats.index');
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
        $edit_category = Vat::find($id);
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
        $vat = Vat::find($id);
        $validator = Validator::make($request->all(), [ 'name'=> 'required']);
        
        if ($validator->fails()) {
            return redirect('categories')
                        ->withErrors($validator)
                        ->withInput();
        } else {
            
            
            $vat->name = $request->input('name');
            $vat->percentage = $request->input('percentage');
            $vat->timestamps = false;
            $vat->save();
            

            Session::flash('message', 'Successfully Updated');

            return redirect()->route('vats.index');
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
        $designation = Vat::find($id);
        $designation->delete();
        return redirect()->back()->with('message','Delete Succesfully');
    }
}
