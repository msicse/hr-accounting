<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//login Routes

// Route::get('auth/login', ['as' => 'auth.login','uses' => 'Auth\Authcontroller@getLogin']);
// Route::post('auth/login', ['as' => 'auth.login','uses' => 'Auth\Authcontroller@postLogin']);
// Route::get('auth/logout', ['as' => 'auth.logout','uses' => 'Auth\Authcontroller@getlogout']);
//registration Routes
// Route::get('auth/register', ['as' => 'auth.register','uses' => 'Auth\Authcontroller@getRegister']);
// Route::post('auth/register', ['as' => 'auth.register','uses' => 'Auth\Authcontroller@postRegister']);



//Route::get('/','PageController@index');

//User Registration  and Login Routes
Route::resource('user', 'EmployeeController');

Route::get('user-profile/{id}', ['as' => 'user.profile','uses' => 'ProfileviewController@profileView']);

//login
Route::get('login', ['as' => 'user.login','uses' => 'LoginController@getLogin']);
Route::post('login', ['as' => 'user.login','uses' => 'LoginController@postLogin']);
Route::get('logout', ['as' => 'user.logout','uses' => 'LoginController@getLogout']);

//All Admin Controllers Routes
Route::resource('ip', 'IpController');
Route::resource('designaion', 'DesignationController');
Route::resource('profile', 'ProfileController');
Route::resource('shift', 'ShiftController');
Route::resource('leave', 'LeaveController');
Route::resource('fixed-assets', 'FixedAssetController');
Route::resource('stationaery', 'StationaeryController');
Route::resource('housekeeping', 'HousekeepingController');
Route::resource('performance', 'PerformanceController');
//Route::resource('off-day', 'OffdayController');
Route::get('employee-show/{id}','HomeController@employeeShow');
Route::get('offday/month', ['as' => 'offday.month','uses' => 'OffdayController@getMonth']);
Route::post('offday/update', ['as' => 'offday.update','uses' => 'OffdayController@update']);
Route::post('offday/month', ['as' => 'offday.postmonth','uses' => 'OffdayController@postMonth']);
Route::get('offday', ['as' => 'off-day.index','uses' => 'OffdayController@index']);
Route::post('offday', ['as' => 'off-day.store','uses' => 'OffdayController@store']);


Route::get('offdayview', ['as' => 'viewoffday','uses' => 'OffdayController@getViewoffday']);
Route::post('offdayview', ['as' => 'viewoffday','uses' => 'OffdayController@viewoffday']);
Route::get('offday/create', ['as' => 'off-day.create','uses' => 'OffdayController@create']);
Route::get('offdayview/{id}/edit', ['as' => 'viewoffday.edit','uses' => 'OffdayController@getEditoffday']);
Route::delete('offdayview/{id}', ['as' => 'viewoffday.delete','uses' => 'OffdayController@destroy']);

//Attendence Routs

Route::get('/', ['as' => 'office.in','uses' => 'OfficeController@getOfficein']);
Route::post('office', ['as' => 'office.store','uses' => 'OfficeController@postOfficeIn']);
Route::post('office-out/{id}', ['as' => 'office.out','uses' => 'OfficeController@officeOut']);
Route::get('all-attendance', ['as' => 'employee.all','uses' => 'AttendanceController@index']);
Route::get('employee-attendance', ['as' => 'employee.single','uses' => 'AttendanceController@employee']);



// Payroll Routs

//Route::get('payrol', ['as' => 'payrol.test','uses' => 'PayrolController@view_test']);
//getAllpayroll

Route::get('payrol-list', ['as' => 'payrol.all','uses' => 'PayrolController@getAllpayroll']);

Route::get('payrol-list/{id}', ['as' => 'payrol.single','uses' => 'PayrolController@getSinglepayroll']);
Route::delete('payrol-delete/{id}', ['as' => 'payrol.delete','uses' => 'PayrolController@getDeletepayroll']);

Route::get('payrol', ['as' => 'payrol.view','uses' => 'PayrolController@getPayrol']);
Route::post('payrol', ['as' => 'payrol.index','uses' => 'PayrolController@postPayrol']);

Route::post('confirm', ['as' => 'payrol.confirm','uses' => 'PayrolController@postConfirm']);
// Route::get('receive', function(){
// 	return view('print.receive');
// })->name('print');

Route::get('receive/{id}', ['as' => 'print','uses' => 'PaymentController@getPrint']);



//Bookeeping & Accounts Routs

Route::resource('accounts', 'AccountController');

Route::get('account-transfer', ['as' => 'transfer.index','uses' => 'AccountTransferController@index']);
Route::get('account-transfer/create', ['as' => 'transfer.create','uses' => 'AccountTransferController@create']);

Route::post('account-transfer', ['as' => 'transfer.store','uses' => 'AccountTransferController@store']);

Route::put('account-transfer/{id}', ['as' => 'transfer.update','uses' => 'AccountTransferController@update']);

Route::get('account-transfer/{id}/edit', ['as' => 'transfer.edit','uses' => 'AccountTransferController@edit']);

Route::delete('account-transfer/{id}', ['as' => 'transfer.delete','uses' => 'AccountTransferController@delete']);


//inventory
Route::resource('products', 'ProductController');
Route::resource('services', 'ServiceController');
Route::resource('categories', 'CategoryController');

//Contacts
Route::resource('customers', 'CustomerController');
Route::resource('suppliers', 'SupplierController');

//Settings
Route::resource('vats', 'VatController');
Route::resource('currency', 'CurrencyController');
//incomes-expenses 
Route::resource('incomes', 'IncomeController');
Route::resource('expenses', 'ExpensController');
Route::resource('in-ex-categories', 'IncomeExpencesCategoyController');

Route::resource('notes', 'NoteController');


//Purchase Route

Route::get('purchase', [ 'as' => 'purchase.index', 'uses' => 'PurchaseController@index']);

Route::get('purchase/create', ['as' => 'purchase.create', 'uses' => 'PurchaseController@create']);

Route::get('purchase/{id}', ['as' => 'purchase.show', 'uses' => 'PurchaseController@show']);

Route::get('purchase/{id}/edit', ['as' => 'purchase.edit', 'uses' => 'PurchaseController@edit']);

Route::get('purchase/{sub_total}/{vat_id}/{discount}', ['as' => 'purchase.grand', 'uses' => 'PurchaseController@grandTotal']);

Route::post('purchase/store', ['as' => 'purchase.store', 'uses' => 'PurchaseController@store']);

Route::put('purchase/update/{id}', ['as' => 'purchase.update', 'uses' => 'PurchaseController@update']);


Route::get('purchase/invoice/{id}', ['as' => 'purchase.invoice', 'uses' => 'PurchaseController@viewInvoice']);

Route::delete('purchase/{id}', ['as' => 'purchase.destroy', 'uses' => 'PurchaseController@destroy']);

Route::get('purchase/print/{id}', ['as' => 'purchase.print','uses' => 'PurchaseController@invoicePrint']);

//Sales

Route::get('sales', [ 'as' => 'sales.index', 'uses' => 'SaleController@index']);
Route::get('sales/create', ['as' => 'sales.create', 'uses' => 'SaleController@create']);
Route::get('sales/{id}', ['as' => 'sales.show', 'uses' => 'SaleController@show']);

Route::get('sales/{sub_total}/{vat_id}/{discount}', ['as' => 'sales.grand', 'uses' => 'SaleController@grandTotal']);

Route::post('sales/store', ['as' => 'sales.store', 'uses' => 'SaleController@store']);


Route::get('sales/invoice/{id}', ['as' => 'sales.invoice', 'uses' => 'SaleController@viewInvoice']);

Route::delete('sales/{id}', ['as' => 'sales.destroy', 'uses' => 'SaleController@destroy']);

Route::get('sales/print/{id}', ['as' => 'sale.print','uses' => 'SaleController@invoicePrint']);

Route::get('sales/{id}/edit', ['as' => 'sale.edit', 'uses' => 'SaleController@edit']);

Route::put('sales/update/{id}', ['as' => 'sales.update', 'uses' => 'SaleController@update']);


Route::get('single-leaves', ['as' => 'single-leaves.index', 'uses' => 'SingleLeaveController@index']);
Route::get('single-leaves/create', ['as' => 'single-leaves.create', 'uses' => 'SingleLeaveController@create']);
Route::post('single-leaves/store', ['as' => 'single-leaves.store', 'uses' => 'SingleLeaveController@store']);
Route::get('single-leaves/{id}', ['as' => 'single-leaves.show', 'uses' => 'SingleLeaveController@show']);

//reporting route


Route::get('account-statement', ['as' => 'account-statement.index', 'uses' => 'ReportingController@index']);

Route::post('account-statement', ['as' => 'account-statement.post', 'uses' => 'ReportingController@postAccount']);

Route::get('report/incomes', ['as' => 'report.income', 'uses' => 'ReportingController@getIncome']);

Route::post('report/incomes', ['as' => 'report.incomes', 'uses' => 'ReportingController@postIncome']);

Route::get('report/expenses', ['as' => 'report.expens', 'uses' => 'ReportingController@getExpens']);

Route::post('report/expenses', ['as' => 'report.expenses', 'uses' => 'ReportingController@postExpens']);


// Route::get('/404',function(){
// 	return view('errors.404');
// })->name('404');

// Route::get('report',function(){
// 	return view('bookeeping.reporting.account-statement');
// })->name('report');
