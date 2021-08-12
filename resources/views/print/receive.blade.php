<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Receive Print</title>
    <style type="text/css">

	body { font-family : sans-serif; }
    	.bordr thead,.bordr tbody,.bordr tr, .bordr th,.bordr td { border: 1px solid #f00 !important;  }
    	/*.margin-top-20 { margin-top: 35px;  }*/
    	header,section { display: block; }
    	address { margin-bottom: 5px; }
    	hr { margin: 30px 0px 0px 0px }
    	p { border-bottom: 1px solid #eee; color: #000; font-size: 18px; }
    	.bordr-top { border-top: 1px solid #000; width: 50%; }
    	.remove-padding { padding: 0; }
    	.margin-top-20 { margin-top: 20px;  }
    	h4 { font-size: 20px; font-weight: bold; }
    	h5 { font-size: 18px; font-weight: bold; }
    	.space { height: 1px;background: #eee; display: block;}
    	
    	.container {
		    height: 842px;
        	width: 595px;
		    margin: 0 auto;
		}
		.print-content-area { width: 100%; }
		.text-center { text-align: center; }
		.text-right { text-align: right; }
		.col-md-6{
			display: block;
			float: left;
			width: 100%;
			margin-right: 10px;
			margin-left: 10px;
		}
		.clear { clear: both; }
		.deduction{ width: 50%; float: left; display: block; }
		.ernings{ width: 50%; float: left;  display: block;}
		.table {
		  width: 100%;
		  max-width: 100%;
		  margin-bottom: 20px;
		}
		.row {
  margin-right: -15px;
  margin-left: -15px;
}
		.table > thead > tr > th,
		.table > tbody > tr > th,
		.table > tfoot > tr > th,
		.table > thead > tr > td,
		.table > tbody > tr > td,
		.table > tfoot > tr > td {
		  padding: 8px;
		  line-height: 1.42857143;
		  vertical-align: top;
		  border-top: 1px solid #ddd;
		}
		.table > thead > tr > th {
		  vertical-align: bottom;
		  border-bottom: 2px solid #ddd;
		}
		.table > caption + thead > tr:first-child > th,
		.table > colgroup + thead > tr:first-child > th,
		.table > thead:first-child > tr:first-child > th,
		.table > caption + thead > tr:first-child > td,
		.table > colgroup + thead > tr:first-child > td,
		.table > thead:first-child > tr:first-child > td {
		  border-top: 0;
		}
		.table > tbody + tbody {
		  border-top: 2px solid #ddd;
		}
		.table-striped > tbody > tr:nth-of-type(odd) {
		  background-color: #f9f9f9;
		}
		table {
		  background-color: transparent;
		}
		caption {
		  padding-top: 8px;
		  padding-bottom: 8px;
		  color: #777;
		  text-align: left;
		}
		th {
		  text-align: left;
		}
		.total-salary { width: 50%;margin-left: 50%;}
		.salary{ display: block; }
		hr { width: 65%; }
		.margin-taka { margin-left: 50px; }
		.cheque, .bank { 
			float: left;
			width: 49%;
			padding: .5%
		 }
		 .margin-top-40 { margin-top: 40px; }
    </style>
  </head>
  <body>
  	<div class="container">
		  	
			<header class="text-center">
			  	<h1>Company Name</h1>
			  	<address>Address: </address>
			  	<p>Salary Slip</p>
			</header>
			<div class="row">
			
			  	<section class="print-content-area">
			  			<article>
			  				<table class="table table-striped">
			  				
			  					<tr>
			  						<th> Employee Id: </th>
			  						<td> {{ $payment->employee_id }}</td>
			  					</tr>
			  					<tr>
			  						<th> Employee Name: </th>
			  						<td> {{ $payment->first_name }} {{ $payment->middle_name }} {{ $payment->last_name }}</td>
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

			  			</article>

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
							<td>Salary Deductions</td>
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
                              <td> {{$payment->words}} </td>
                          </tr>
                          <tr>
                              <th>By Cash / Cheque</th>
                              <td> {{$payment->by}} </td>
                          </tr>
                      </tfoot>
                  </table>
                  </section>
                 <div class="row margin-top-20 margin-top-40 clear">
				  			<div class="cheque">
				  				<p class="bordr-top">Receiver </p>
				  			</div>
				  			<div class="bank">
				  				<p class="bordr-top">Accounts </p>
				  			</div>
				  	</div>
	</div>
</div>

</body>
</html>