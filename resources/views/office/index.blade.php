@extends('layout.admin')
@section('title','Admin | Office')
@section('contentBody')
	<div class="card">
        <div class="card-header">
            <h2>Office </h2>
        </div>
        		<?php 
					$date = new DateTime();
					$dateF=$date->format('d-m-Y');
					//echo $dateF;
					$i=0;
				?>
		
        <div class="card-body card-padding">
        	<div class="row">
        		<div class="col-md-6">
        			<form action="{{ route('office.store') }}" method="post">
        			{{ csrf_field() }}

        				<button type="submit" class="btn btn-primary btn-block {{ $buttonstatus !='office_in' ? "disabled" :"" }}" >Office In</button>
        			</form>
        		</div>

        		<div class="col-md-6">

        			<form action="{{ route('office.out',['id' => Auth::user()->profile_id ]) }}" method="post">
        			{{ csrf_field() }}
        				
						
        					<button type="submit" class="btn btn-primary btn-block 
							@if( $disable_out_button =='out')
								disabled
							@endif
        					{{ $buttonstatus =='office_in' ? "disabled" :"" }}

        					">Office Out</button>
        				 <div class="form-group">
							  <label for="notes"><h3>Why You Out Form Office:</h3></label>
							  <textarea class="form-control" name="notes" rows="5" id="notes"></textarea>
						 </div>

        			</form>
        		</div>
        	</div>
        </div>
    </div>
    <div class="card">
	    <div class="table-responsive">
	        <table class="table table-bordered">
			    <thead>
			      <tr>
			        <th>Date</th>
			        <th colspan="2"> {{ $dateF }} </th>
			        
			      </tr>
			    </thead>
			    <tbody>
			      <tr>
			        <th>S.L</th>
			        <th>IN </th>
			        <th>OUT </th>
			        <th>Notes</th>
			      </tr>
			     	@foreach( $offices as $office )

				     	@if( $dateF ==  date('d-m-Y', strtotime( $office->in )) )
							<?php $i++ ; ?>
						     <tr>
								<td>{{ $i }}</td>
								<td>{{ $office->in->format('h:ia') }}</td>
								<td>{{ empty( $office->out ) ? "" : $office->out->format('h:ia') }}</td>
								<td>{{ $office->notes }}</td>
						      </tr>
					    @endif

				    @endforeach
			    </tbody>
			 </table>
		</div>
    </div>

@endsection