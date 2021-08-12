<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\FixedAssets;
use Session;
use Validator;

class FixedAssetController extends Controller
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
        $fixedassets = FixedAssets::paginate(10);
        return view('pages-admin.fixed-assets.index')->withFixedassets($fixedassets);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
       //return $request;
        $validator = Validator::make($request->all(), [
            'name'        => 'required|max:100|regex:/^[(a-zA-Z\s)]+$/u',
            'quantity'    => 'required|integer',
            'description' => 'required|max:300'
        ]);
        if ($validator->fails()) {
            return redirect('fixed-assets')
                        ->withErrors($validator)
                        ->withInput();
        } else {
            $fiexed_asset = new FixedAssets;
            $fiexed_asset->name         = $request->input('name');
           
            $fiexed_asset->quantity     = $request->input('quantity');
            $fiexed_asset->description  = $request->input('description');
            $fiexed_asset->save();
            Session::flash('message', 'Successfully Added Asset!');
            return redirect('fixed-assets');
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
        $fixedasset = FixedAssets::find($id);
        return view('pages-admin.fixed-assets.edit')->withFixedasset($fixedasset);
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
         $validator = Validator::make($request->all(), [
            'name'        => 'required|max:100|regex:/^[(a-zA-Z\s)]+$/u',
            'quantity'    => 'required|integer',
            'description' => 'required|max:300'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        } else {
            $fiexed_asset = FixedAssets::find($id);
            $fiexed_asset->name         = $request->input('name');
           
            $fiexed_asset->quantity     = $request->input('quantity');
            $fiexed_asset->description  = $request->input('description');
            $fiexed_asset->save();
            Session::flash('message', 'Successfully Updated Asset!');
            return redirect('fixed-assets');
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
        FixedAssets::find($id)->delete();
        //$designation->delete();
        return redirect()->back()->with('message','Delete Succesfully');
    }
}
