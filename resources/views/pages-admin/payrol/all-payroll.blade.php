@extends('layout.admin')
@section('title','Admin | Payroll List')
@section('styles')

<style>
	.input-sm{
		width: 100% !important;
		float:right !important;
	}
	#example_filter{
		padding-left: 266px;
		padding-right: 20px;
	}
</style>


@endsection
@section('contentBody')

<div class="card">
    <div class="card-header">
	    <h2>Payroll List</h2>
    </div>
     <table id="example" class="display" cellspacing="0" width="100%">
     <thead>
		<tr>
	    	<th>Employee ID</th>
	    	<th>Month</th>
	    	<th>Year</th>
	    	<th>Payment</th>
	    	<th>Date</th>
	    	<th>Action</th>
	  	</tr>
	 </thead>
	 <tbody>
	  	@foreach($payrolls as $user)
	  	<tr>
	   		<td>{{ $user->employee_id }}</td>
	   		<td>
	   		@if( $user->month ==1 )
	                January
	            @elseif ( $user->month == 2 )
	                February
	            @elseif ( $user->month == 3 )
	                March
	            @elseif( $user->month == 4 )
	                April
	            @elseif ( $user->month == 5 )
	                May
	            @elseif ( $user->month == 6 )
	                Jun
	            @elseif( $user->month == 7 )
	                Julay
	            @elseif( $user->month == 8 )
	                 August
	            @elseif( $user->month == 9 )
	                September
	            @elseif( $user->month == 10 )
	                October
	            @elseif( $user->month == 11 )
	                                                
	                November
	            @else

	                 December

	            @endif

	   		</td>
	   		<td>{{ $user->year }}</td>
	   		<td>{{  $user->gross_salary}}</td>
	   		<td>{{ date('d-m-Y',strtotime($user->created_at))}}</td>
	   		<td>
	   			<a href="{{ route('payrol.single',[$user->id] ) }}"><i class="fa fa-eye  custom-font" aria-hidden="true"></i></a>
	   			<a href="{{ url('payrol-delete',$user->id) }}" data-method="delete" 
				 data-token="{{ csrf_token() }}" data-confirm="Are you sure?">
					<i class="fa fa-trash-o text-danger custom-font" aria-hidden="true"></i>
				</a>

	   		</td>
	  	</tr>
	  	@endforeach
	  	</tbody>
	  
	</table>
	
</div>

@endsection


@section('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/r/bs-3.3.5/jqc-1.11.3,dt-1.10.8/datatables.min.js"></script>


<script type="text/javascript">

$(document).ready(function() {
    $('#example').DataTable();
} );

$('#example')
		.removeClass( 'display' )
		.addClass('table table-striped table-bordered');

</script>

@endsection