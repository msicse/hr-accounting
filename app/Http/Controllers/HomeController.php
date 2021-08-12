<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Profile;

class HomeController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function employeeShow($id){
        $data = Profile::where('employee_id',$id)->first();
        return $data;
    }
}
