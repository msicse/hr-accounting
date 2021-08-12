@extends('layout.admin')
@section('title','Admin | List Of Attendance')
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
            <h2>All List Of Attendance </h2>
        </div>
	    <div class="">
	        <table id="example" class="display" cellspacing="0" width="100%">
			    <thead>
			      <tr>

	
				        <th>S.L</th>
				        <th>Employee ID</th>
				        <th>In Date</th>
				        <th>IN Time</th>
				        <th>Out Date</th>
				        <th>OUT Time</th>
				        <th>Notes</th>
			      </tr>
			    </thead>
			    <tbody>	
				     		<?php $i=0; ?>
			     	@foreach( $employees as $office )
				     		<?php $i++ ?>
					<tr>
						<td>{{ $i }}</td>
						<td>{{ $office->employee_id }}</td>
						<td>{{ date('M j ,Y',strtotime($office->in)) }}</td>
						<td>{{ date('h:i A', strtotime($office->in)) }}</td>
						<td>{{ empty($office->out) ? '' : date('M j ,Y', strtotime($office->out)) }}</td>
						<td>{{ empty($office->out) ? '' : date('h:i A', strtotime($office->out)) }}</td>
						<td>{{ $office->notes }}</td>
					</tr>
					   

				     @endforeach
			    </tbody>

			 </table>
		</div>

    </div>
@endsection

@section('scripts')
	<script type="text/javascript" src="https://cdn.datatables.net/r/bs-3.3.5/jqc-1.11.3,dt-1.10.8/datatables.min.js"></script>

	<script>
		$(document).ready(function() {
		    $('#example').DataTable();
		} );

		$('#example')
		.removeClass( 'display' )
		.addClass('table table-striped table-bordered');
	</script>
@endsection