<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;
use App\Product;
use Session;
use Validator;

class CategoryController extends Controller
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
         
         return view('bookeeping.inventory.categories')->withCategories($categories);
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
            $category->cat_name = $request->input('name');
            $category->timestamps = false;
            $category->save();
            

            Session::flash('message', 'Successfully Added Category!');

            return redirect()->route('categories.index');
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
            return redirect('categories')
                        ->withErrors($validator)
                        ->withInput();
        } else {
            
          
            $category->cat_name = $request->input('name');
            $category->timestamps = false;
            $category->save();
            

            Session::flash('message', 'Successfully Updated Category!');

            return redirect()->route('categories.index');
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
        
		
		$product = Product::where('category_id', '=', $id )
                            ->exists();
        
		
		if ( $product ) {
            
            Session::flash('error-message', 'Please Service Or Product  Delete first !');    
            return redirect()->back();
        
        } else {
			$designation = Category::find($id);
            $designation->delete();
			return redirect()->back()->with('message','Delete Succesfully');
        }
    }
}
