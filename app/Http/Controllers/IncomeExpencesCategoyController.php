<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\IncomeExpenseCategory as Category;
use App\Income;
use App\Expens;
use Session;
use Validator;

class IncomeExpencesCategoyController extends Controller
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
         $categories = Category::all();
         
         return view('bookeeping.income-expenses.categories')->withCategories($categories);
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
        
        $validator = Validator::make($request->all(), [ 'name'=> 'required']);
        
        if ($validator->fails()) {
            return redirect('categories')
                        ->withErrors($validator)
                        ->withInput();
        } else {
            
            $category = new Category ;
            $category->income_name = $request->input('name');
            $category->timestamps = false;
            $category->save();
            

            Session::flash('message', 'Successfully Added Category!');

            return redirect()->route('in-ex-categories.index');
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
        $edit_category = Category::find($id);
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
        
        $category = Category::find($id);
        $validator = Validator::make($request->all(), [ 'name'=> 'required']);
        
        if ($validator->fails()) {
            return redirect('in-ex-categories')
                        ->withErrors($validator)
                        ->withInput();
        } else {
            
          
            $category->income_name = $request->input('name');
            $category->timestamps = false;
            $category->save();
            

            Session::flash('message', 'Successfully Updated Category!');

            return redirect()->route('in-ex-categories.index');
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
        $designation = Category::find($id);

        $result = Income::where('income_category_id', '=', $designation->id )
                            ->exists();

        $result1 = Expens::where('income_category_id', '=', $designation->id )
                            ->exists();

        if ( $result1 ) {
            
            Session::flash('error-message', 'Please Expens  History  Delete first !');    
            return redirect('incomes');
        }

        if ( $result ) {
            
            Session::flash('error-message', 'Please Incomes  History  Delete first !');    
            return redirect('incomes');
        } else {

            $designation->delete();
            return redirect()->back()->with('message','Delete Succesfully');
        }
    }
}
