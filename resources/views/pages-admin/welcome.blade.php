@extends('layout.admin')
@section('contentBody')
	<div class="card">
        <div class="card-header">
            <h2>Welcome To Admin Panel</h2>
             {{ Auth::user()->name }}
		    @if( Auth::user()->role == 'admin' )
		    	<p>This is admin</p>
		    @endif

		    @if( Auth::user()->role == 'employee' )
		    <p>This is Employee</p>
		    @endif
        </div>
	
    </div>
   
@endsection