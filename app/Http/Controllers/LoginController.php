<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests;
use App\Employees;
use Input;
use Auth;
use Session;
use App\Ip;
class LoginController extends Controller
{
    public function getLogin()
    {
    	return View('auth.login');
    }
    
    public function postLogin(Request $request)
    {		
			$ip = $request->ip();
			
	//return $ip;
    		$result = Ip::where('ip', '=', $ip )->exists();

			
				
			
			
		    	$rules = array(
				    'email'    => 'required|email', // make sure the email is an actual email
				    'password' => 'required|alphaNum|min:6' // password can only be alphanumeric and has to be greater than 6 characters
				);
				$validator = Validator::make(Input::all(), $rules);

				if ($validator->fails()) {
				    return redirect('login')
				        ->withErrors($validator) // send back all errors to the login form
				        ->withInput(Input::except('password'));
				} else {

				    // create our user data for the authentication
				    $userdata = array(
				        'email'     => Input::get('email'),
				        'password'  => Input::get('password')

				    );

				    if (Auth::attempt($userdata)) {
						
						if( Auth::user()->role == 'admin')
						{
							Session::flash('message', 'Welcome To Your To CompanyName');

							return redirect('/');
						} else 
						{
							if ($result) {
								Session::flash('message', 'Welcome To Your To CompanyName');

								return redirect('/');
							} else{ 
								Auth::logout();
								Session::flash('error', "Your IP address is not Valid To Login !!!");
								return redirect()->route('user.login');
							}
						
						}
				    	
				        
				        


				    } else {        

				        // validation not successful, send back to form 
				        Session::flash('error', "E-mail or Password Don't mass");
				        return redirect()->route('user.login');
				    }
			}

    }

    public function getLogout()
    {
    	Auth::logout(); 
    	return redirect()->route('user.login'); 
    }

}
