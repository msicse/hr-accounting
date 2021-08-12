<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PageController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	return view('pages-admin.office-attendence.index');
    }
   
}
