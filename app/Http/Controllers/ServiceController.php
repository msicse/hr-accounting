<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Product;
use App\Category;
use App\SaleItem;
use App\PurchaseItem;
use Session;
use Validator;
use DB;

class ServiceController extends Controller
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
        $products = DB::table('products')
            ->join('product_category', 'products.category_id', '=', 'product_category.id')
            ->select('products.*','product_category.cat_name')
			->where('products.type','service')
            ->get();

        $categories = Category::all();
        return view('bookeeping.inventory.service')->withProducts($products)->withCategories($categories);
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
            'price'=> 'required',
        ]);
        
        if ($validator->fails()) {
            return redirect('services')
                        ->withErrors($validator)
                        ->withInput();
        } else {
            
            $product = new Product ;
            $product->product_code = $request->input('product_code');
            $product->name = $request->input('name');
            $product->category_id = $request->input('category_id');
            $product->price = $request->input('price');
            $product->notes = $request->input('notes');
            $product->type = 'service';
            $product->timestamps = false;
            $product->save();
            

            Session::flash('message', 'Successfully Added Service!');

            return redirect()->route('services.index');
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
        $edit_product = Product::find($id);
        return $edit_product;
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
        $product = Product::find($id);

        $validator = Validator::make($request->all(), [ 
            'name'=> 'required',
            'price'=> 'required',
        ]);
        
        if ($validator->fails()) {
            return redirect('categories')
                        ->withErrors($validator)
                        ->withInput();
        } else {
            
            
            //$product->product_code = $request->input('product_code');
            $product->name = $request->input('name');
            $product->category_id = $request->input('category_id');
            $product->price = $request->input('price');
            $product->notes = $request->input('notes');
            //$product->type = 'product';
            $product->timestamps = false;
            $product->save();
            

            Session::flash('message', 'Successfully Updated Product!');

         }   return redirect()->route('services.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $purchase = PurchaseItem::where('product_id', '=', $id )
                            ->exists();

        $result = SaleItem::where('product_id', '=', $id )
                            ->exists();
        if ( $purchase ) {
            
            Session::flash('error-message', 'Please Purchase  Delete first !');    
            return redirect('purchase');
        
        }

        if ( $result ) {
            
            Session::flash('error-message', 'Please Sales  Delete first !');    
            return redirect('purchase');
        
        } else {

            $designation = Product::find($id);
            $designation->delete();
            return redirect()->back()->with('message','Delete Succesfully');
        }
    }
}
