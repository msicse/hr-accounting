@extends('layout.admin')
@section('title','Admin | Off Day')
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
        <input type="hidden" name="red_print" value="{{ route('print') }}">
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
        <div class="container">
            <div class="row">
               
                <!-- <div class="col-md-6 table-responsive">
                        <div class="col-md-12">
                            <h3>Add Ammount</h3>
                            <input type="button" value="Add Row" onclick="addRow('dataTable')" />
                            <input type="button" value="Delete Row" onclick="deleteRow('dataTable')" />
                        </div>


                        <div class="col-md-2"> </div>
                        <div class="col-md-6"><h4>Description</h4> </div>
                        <div class="col-md-2"> <h4>Taka</h4> </div>
                        <table id="dataTable" class="table">
                            <tr>
                                <td><input type="checkbox" name="chk[]"/></td>
                                <td><input type="text" class="add_for" size="30" name="add_des[]"/></td>
                                <td id="add_tk">
                                    <input type="text" size="10" name="add_taka[]"/>
                                </td>
                            </tr>
                        </table>
                    </div> -->


                <!-- <div class="col-md-6 table-responsive">

                        <div class="col-md-12">
                            <h3>Sub Ammount</h3>
                            <input type="button" value="Add Row" onclick="addRow('dataTable1')" />
                            <input type="button" value="Delete Row" onclick="deleteRow('dataTable1')" />
                        </div>


                        <div class="col-md-2"> </div>
                        <div class="col-md-6"><h4>Description</h4> </div>
                        <div class="col-md-2"> <h4>Taka</h4> </div>
                        <table id="dataTable1" class="table">
                            <tr>
                                <td><input type="checkbox" name="chk[]"/></td>
                                <td><input type="text" size="30"  name="sub_des[]"/></td>
                                <td>
                                    <input type="text" size="10"  name="sub_taka[]"/>
                                </td>
                            </tr>
                        </table>
                    </div> -->
            </div>
        </div>
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
       function addRow(tableID) {

            var table = document.getElementById(tableID);

            var rowCount = table.rows.length;
            var row = table.insertRow(rowCount);

            var colCount = table.rows[0].cells.length;

            for (var i = 0; i < colCount; i++) {

                var newcell = row.insertCell(i);

                newcell.innerHTML = table.rows[0].cells[i].innerHTML;
                //alert(newcell.childNodes);
                switch (newcell.childNodes[0].type) {
                    case "text":
                        newcell.childNodes[0].name = 'add_des[]';
                        break;
                    case "checkbox":
                        newcell.childNodes[0].checked = false;
                        break;
                    case "select-one":
                        newcell.childNodes[0].selectedIndex = 0;
                        break;
                }
            }
            //test();
        }

        function deleteRow(tableID) {
            try {
                var table = document.getElementById(tableID);
                var rowCount = table.rows.length;

                for (var i = 0; i < rowCount; i++) {
                    var row = table.rows[i];
                    var chkbox = row.cells[0].childNodes[0];
                    if (null != chkbox && true == chkbox.checked) {
                        if (rowCount <= 1) {
                            alert("Cannot delete all the rows.");
                            break;
                        }
                        table.deleteRow(i);
                        rowCount--;
                        i--;
                    }


                }
            } catch (e) {
                alert(e);
            }
        }

        var total = 0;
        var subTotal = 0;

       

        // $('#totalTaka').click( function(){
        //     totalTaka = ($('#totalTaka').html());
        // });

        function result(){
            $('#dataTable').find("[name='add_taka[]']").each(function () {
                 total += parseInt(this.value);
            });

            $('#dataTable1').find("[name='sub_taka[]']").each(function () {
                 subTotal += parseInt(this.value);
            });

            totalTaka = ($('#totalTaka').html());
            
            $("#result").append(total);
            $("#result").append(subTotal);
            $("#result").append(totalTaka);
           
           var finalTaka =0;

           if( total > 0){
                finalTaka = parseFloat(totalTaka) + parseFloat(total);
            }else{
                finalTaka = totalTaka;
            }

            if ( subTotal > 0 ) {
                finalTaka = parseFloat(finalTaka) - parseFloat(subTotal);
            }
           
           document.getElementById("contentTotal").innerHTML= finalTaka;
          
           //console.log(totalTaka);
          
        }

        function confirm() {

            var csfr = $('[name="_token"]').val();
            var year = $('[name="year"]').val();
            var month =$('[name="month"]').val();
            var red_print =$('[name="red_print"]').val();
            var totalTaka = ($('#totalTaka').html());
            var addDesc = [];
            var addTakaa = [];
            var subDesc = [];
            var subTakaa = [];
                var i=0;
            $('#dataTable').find("[name='add_des[]']").each(function () {
                 addDesc[i] = this.value;
                 i++;
            });

            i=0;

            $('#dataTable').find("[name='add_taka[]']").each(function () {
                 addTakaa[i]= parseInt(this.value);
                 i++;
            });

            i=0;

            $('#dataTable1').find("[name='sub_des[]']").each(function () {
                 subDesc[i] = this.value;
                 i++;
            });

            i=0;

            $('#dataTable1').find("[name='sub_taka[]']").each(function () {
                 subTakaa[i] = parseInt(this.value);
            });



            var id =$('[name="id"]').val();

            var grosSalary = ($('#contentTotal').html());

            if ( totalTaka == 0) {
                totalTaka = "Absent All days";
            }
            

            $.ajax({
                url: '/confirm',
                type: 'POST',
                data: {_token: csfr,month: month,year: year,id: id, total_taka: totalTaka, grosSalary:grosSalary,add_des: addDesc, add_taka: addTakaa, sub_des: subDesc,sub_taka: subTakaa  },
                //dataType: 'JSON',
                
                    
                success: function (data) {
                    //console.log(data);
                    // redirectTo(red_print);
                    
                    window.location.href = red_print +"?" + "year=" +  year + "&month="  + month + "&id=" + id ;
                                    }
            });

        }



    // addTotal = totalTaka + total;
    // console.log(addTotal);


    </script>
@endsection