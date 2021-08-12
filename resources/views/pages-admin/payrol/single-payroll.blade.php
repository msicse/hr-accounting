@extends('layout.admin')
@section('title','Admin | PayrollView')
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
	    <h2>Payroll For {{ $payment->first_name }} {{ $payment->middle_name }} {{ $payment->last_name }} </h2>
    </div>
    <div class="card-body">
   
		<table class="table table-striped">
			  				
			<tr>
			  	<th> Employee Id: </th>
			  	<td> {{ $payment->employee_id }}</td>
			</tr>
			<tr>
			  	<th> Employee Name: </th>
			  	<td> {{ $payment->first_name }}</td>
			</tr>
			<tr>
			  	<th> Month & Year:</th>
			<td> 
			  	@if( $payment->month ==1 )
	                January
	            @elseif ( $payment->month == 2 )
	                February
	            @elseif ( $payment->month == 3 )
	                March
	            @elseif( $payment->month == 4 )
	                April
	            @elseif ( $payment->month == 5 )
	                May
	            @elseif ( $payment->month == 6 )
	                Jun
	            @elseif( $payment->month == 7 )
	                Julay
	            @elseif( $payment->month == 8 )
	                 August
	            @elseif( $payment->month == 9 )
	                September
	            @elseif( $payment->month == 10 )
	                October
	            @elseif( $payment->month == 11 )
	                                                
	                November
	            @else

	                 December

	            @endif

			  	, {{ $payment->year }}</td>
			  					</tr>
			  				</table>

	<table class="table table-bordered">
                      <thead>
                          <tr>
                              <th>Particulars</th>
                              <th class="text-right">Amount Tk.</th>
                              <th>Deductions</th>
                              <th class="text-right">Amount Tk.</th>
                          </tr>
                      </thead>
                      <tbody>
						<tr>
							<td>Basic Salary</td>
							<td class='text-right'>{{ $salary = $payment->basic_salary }}</td>
							<td>Advance</td>
							<td class='text-right'>{{ $payment->advance }}</td>
						</tr>
						<tr>
							<td>House Rent</td>
							<td class='text-right'>
								{{ $house = (60/100)*$payment->basic_salary }}
							</td>
							<th>Salary Deductions</th>
							<td class='text-right'>{{ $payment->deduction }}</td>
						</tr>
						<tr>
							<td>Convene Allowance</td>
							<td class='text-right'>

								{{ $convence = (20/100)*$payment->basic_salary }}
							</td>
							<td>Others</td>
							<td class='text-right'>{{ $payment->others }}</td>
						</tr>
						<tr>
							<td>Medical Allowance</td>
							<td class='text-right'>
								{{ $medical = (10/100)*$payment->basic_salary }}
							</td>
							<td></td>
							<td ></td>
						</tr>
						<tr>
							<td>Mobile Allowance</td>
							<td class='text-right'>
								{{ $mobile = (10/100)*$payment->basic_salary }}
							</td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>Overtime</td>
							<td class='text-right'>{{ $payment->overtime }}</td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>Bonus</td>
							<td class='text-right'>{{ $payment->bonus }}</td>
							<td></td>
							<td></td>
						</tr>

                      </tbody>
                      <tfoot>
                          <tr>
                              <th>Total Payable</th>
                              <td class="text-right">
                              <?php  
                              	$total = $salary + $medical + $mobile + $house + $convence + $payment->overtime + $payment->bonus;

                               ?>
                               {{ $total }}
                              </td>
                              <th>Total Deductions</th>
                              <td class="text-right" id="total-dedution">
                              	<?php  $deduction = $payment->deduction + $payment->advance + $payment->others ?>
                              	{{ $deduction }}
                              </td>
                          </tr>
                          <tr>
                              <th>Net Salary</th>
                              <td class="text-right" id="net-total">
                              	{{$payment->net_salary}}
                              </td>
                          </tr>
                          <tr>
                              <th>In words</th>
                              <td>  {{$payment->words}} </td>
                          </tr>
                          <tr>
                              <th>By Cash / Cheque</th>
                              <td> {{$payment->by}}</td>
                          </tr>
                          <tr>
                          	<td colspan="4" class="text-center">
                          		<a class="btn btn-primary" href="{{ route('print',[$payment->id]) }}">Print</a>
                          	</td>
                          </tr>
                      </tfoot>

                  </table>
</div>	
</div>


@endsection


@section('scripts')


@endsection