@extends('layout.admin')
@section('title','Admin | Payroll Create')
@section('styles')
    <style>
        .form-control{
            font-size: 20px;

        }
        .m-t-40 {
            margin-top: 30px;
        }
        * {
          .border-radius(0) !important;
        }

        #field {
            margin-bottom:20px;
        }
    </style>
@stop
@section('contentBody')
    <div class="card">
        <div class="card-header">
            <h2>Payrol <a href="{{ url('off-day/month') }}"> <span class="pull-right btn btn-primary custom-btn"><i class="fa fa-arrow-left" aria-hidden="true"></i> back </span></a></h2>
        </div>
        <div class="card-body table-responsive">
        <form action="{{ route('payrol.confirm') }}" id="" method="post">
        <input type="hidden" name="year" value="{{ $year }}">
        <input type="hidden" name="month" value="{{ $month }}">
        <input type="hidden" name="id" value="{{ $id }}">
        
        {{ csrf_field() }}
            <table class="table">
                <thead>
                    <tr>
                        <th>Days</th>
                        <th>In Time</th>
                        <th>Out Time</th>
                        <th>Working Hours</th>
                        <th>Let Time </th>
                        <th>Minute / Hour Rate</th>
                        <th>Taka</th>
                    </tr>
                </thead>
                <tbody>
                    {!! $row !!}       
                </tbody>
            </table>
            <br> <br>
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
                          {!! $rowcal !!}
                      </tbody>
                      <tfoot>
                          <tr>
                              <th>Total Payable</th>
                              <td class="text-right" id="total-payable" ></td>
                              <th>Total Deductions</th>
                              <td class="text-right" id="total-dedution"></td>
                          </tr>
                          <tr>
                              <th>Net Salary</th>
                              <td class="text-right" id="net-total"></td>
                          </tr>
                          <tr>
                              <th>In words</th>
                              <td> <input type="text" id="words" class="form-control" name="words"> </td>
                          </tr>
                          <tr>
                              <th>By Cash / Cheque</th>
                              <td>
                                <select name="" onchange="" id="by" class="form-control">
                                  <option value="" selected>Select</option>
                                  <option value="Cash">Cash</option>
                                  <option value="Cheque">Cheque</option>
                                </select>
                              </td>
                          </tr>
                      </tfoot>
                  </table>  
        <div class="col-md-4 col-md-offset-4">
            <input type="button" value="Calculate" onclick="result();" class="btn-info btn-block btn-lg" >
        </div>
        <br> <br>
        <br> <br>
    
        

        <input type="button" id="" class="btn-primary btn-lg btn-block" onclick="confirm();" value="Confirm Payment" >

        </div>
        
    </form>
    </div> <!-- end-card -->

    

@endsection

@section('scripts')
    <script type="text/javascript" > 



    var by = "";


    $('#by').on('change', function() {
              by = this.value  ;
      });


        function result(){

            var totalTaka = 0 ;
            var totalDeduction = 0;

            var basicSalary = ($('#basic-salary').html());
            var houseRent = ($('#house-rent').html());
            var convance = ($('#convance').html());
            var medical = ($('#medical-allow').html());
            var mobile = ($('#mobile-allow').html());

            var overtime = $('#overtime').val();
            var bonus = $('#bonus').val();
            var advance = $('#advance').val();
            var salleryDeduction = $('#salary-deduction').val();
            var others = $('#others').val();

            

            //console.log(words);

            totalTaka = parseFloat(basicSalary) + parseFloat(houseRent) + parseFloat(convance) + parseFloat(medical) + parseFloat(mobile);
            if( overtime > 0 ) {
              totalTaka = parseFloat(overtime) + parseFloat(totalTaka);
            }

            if( bonus > 0 ) {
              totalTaka = parseFloat(bonus) + parseFloat(totalTaka);
            }

            if( advance > 0 ) {
              totalDeduction = parseFloat(totalDeduction) + parseFloat(advance) ;
            }

            if( salleryDeduction > 0 ) {
              totalDeduction = parseFloat(totalDeduction) + parseFloat(salleryDeduction) ;
            }

            if( others > 0 ) {
              totalDeduction = parseFloat(totalDeduction) + parseFloat(others) ;
            }
           
           document.getElementById("total-payable").innerHTML= totalTaka;

            var netTotal = parseFloat(totalTaka) - parseFloat(totalDeduction) ;

           document.getElementById("total-dedution").innerHTML= totalDeduction;

           //var inTextt = toWords(netTotal);
           document.getElementById("net-total").innerHTML= netTotal;
        }

        function confirm() {

            var csfr = $('[name="_token"]').val();
            var year = $('[name="year"]').val();
            var month =$('[name="month"]').val();
            var red_print =$('[name="red_print"]').val();
            var basicSalary = ($('#basic-salary').html());
            var id =$('[name="id"]').val();
            var netSalary = ($('#net-total').html());
            var overtime = $('#overtime').val();
            var bonus = $('#bonus').val();
            var advance = $('#advance').val();
            var salleryDeduction = $('#salary-deduction').val();
            var others = $('#others').val();
            var words = $('#words').val();
            var ajUrl = location.origin+'/confirm';
            $.ajax({
                url: ajUrl,
                type: 'POST',
                data: {_token: csfr,month: month,year: year,id: id, basic_salary: basicSalary, net_salary:netSalary,over_time: overtime, bonus_taka: bonus, advance_tk: advance,deductions: salleryDeduction, others_tk:others,by : by,words: words },
                //dataType: 'JSON',
                
                    
                success: function (data) {

                  var urlPrint = location.origin+'/payrol-list/'+data;
                 window.location.href = urlPrint;

                }

            });

        }


    $( document ).ready(function() {
       result(); 
    });


  </script>
@endsection