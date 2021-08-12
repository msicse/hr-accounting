<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Housekeeping;
use Session;
use Validator;;

class HouseKeepingController extends Controller
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
        $stationareies = Housekeeping::paginate(10);
        return view('pages-admin.housekeeping.index')->withStationareies($stationareies);
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
            'name'        => 'required|max:100|regex:/^[(a-zA-Z\s)]+$/u',
            'quantity'    => 'required|integer',
            'description' => 'required|max:300'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        } else {
            $asset = new Housekeeping;
            $asset->name         = $request->input('name');
           
            $asset->quantity     = $request->input('quantity');
            $asset->description  = $request->input('description');
            $asset->save();
            Session::flash('message', 'Successfully Added Housekeeping!');
            return redirect('housekeeping');
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
         $fixedasset = Housekeeping::find($id);
        return view('pages-admin.housekeeping.edit')->withFixedasset($fixedasset);
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
            $asset = Housekeeping::find($id);
            $asset->name         = $request->input('name');
            $asset->quantity     = $request->input('quantity');
            $asset->description  = $request->input('description');
            $asset->save();
            Session::flash('message', 'Successfully Updated Housekeeping!');
            return redirect('housekeeping');
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
        Housekeeping::find($id)->delete();
        return redirect()->back()->with('message','Delete Succesfully');
    }
}
