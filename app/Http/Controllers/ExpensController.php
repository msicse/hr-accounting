<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Expens as Income;
use Session;
use Validator;
use App\IncomeExpenseCategory as Category;
use App\Account;
use DB;

class ExpensController extends Controller
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
        //$incomes = Income::all();
        //$products = Product::with('likes');
        $incomes = DB::table('expenses')
            ->join('income_expense_category', 'expenses.income_category_id', '=', 'income_expense_category.id')
            ->join('accounts', 'expenses.account_id', '=', 'accounts.id')
            ->select('expenses.*', 'income_expense_category.income_name as category_id ', 'accounts.title as account_id')
            ->get();

        $categories = Category::all();
        $accounts = Account::all();
        return view('bookeeping.income-expenses.expenses')->withIncomes($incomes)->withCategories($categories)->withAccounts($accounts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $accounts = Account::all();
        return view('bookeeping.income-expenses.income.create-ex')->withCategories($categories)->withAccounts($accounts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [ 'title'=> 'required','date'=> 'required']);
        
        if ($validator->fails()) {
            return redirect('expenses')
                        ->withErrors($validator)
                        ->withInput();
        } else {
            
            $income = new Income ;
            $income->title = $request->input('title');
            $income->description = $request->input('description');
            $income->income_category_id = $request->input('income_category_id');
            $income->amount = $request->input('amount');
            $income->account_id = $request->input('account_id');
            $income->date = str_replace("/", "-", $request->input('date'));
            
            $income->save();
            

            Session::flash('message', 'Successfully Added!');

            return redirect()->route('expenses.index');
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
        $edit_category = Income::find($id);
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
        $income = Income::find($id);
        
        $validator = Validator::make($request->all(), [ 'title'=> 'required','date'=>'required']);
        
        if ($validator->fails()) {
            return redirect('expenses')
                        ->withErrors($validator)
                        ->withInput();
        } else {
            
            
            $income->title = $request->input('title');
            $income->description = $request->input('description');
            $income->income_category_id = $request->input('income_category_id');
            $income->amount = $request->input('amount');
            $income->account_id = $request->input('account_id');
            $income->date = $request->input('date');
            
            $income->save();
            

            Session::flash('message', 'Successfully Updated!');

            return redirect()->route('expenses.index');
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
        $designation = Income::find($id);
        $designation->delete();
        return redirect()->back()->with('message','Delete Succesfully');
    }
}
