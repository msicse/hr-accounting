
@extends('layout.admin')
@section('title','Accounts | Manage Accounts')

@section('styles')
<style>
    .panel-heading {
    padding: 17px;
}
</style>


@endsection

@section('contentBody')
<h1 class="text-center">Accounting & Bookkeeping</h1>
<div class="card">
    <div class="card-header">
        <h3>Add New Purchase </h3>
    </div>
    <div class="card-body card-padding">
        <form action="">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Basic Information</h3>
                        </div>
                        <div class="panel-body table-responsive">
                            <table class="table">
                                <tr>
                                    <th>Purchase Code</th>
                                    <td><input type="text" class="form-control" name="product_code" readonly value="<?php echo substr(md5(rand(100000000, 200000000)), 0, 10); ?>" /></td>
                                </tr>
                                <tr>
                                    <th>Supplier</th>
                                    <td>
                                        <select name="" id="" class="form-control">
                                            <option value=""></option>
                                            @foreach($suppliers as $data)
                                                <option value="{{ $data->id }}">{{ $data->first_name  }} {{ $data->last_name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Due Date</th>
                                    <td>
                                        <div class="input-group form-group">
                                            <span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
                                                <div class="dtp-container">
                                                    <input type='text' class="form-control date-picker" placeholder="Click here..." id="date_of_birth" name="date_of_birth"  value="{{ Input::old('date_of_birth')  }}" />
                                                </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="panel panel-primary" data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title" >
                            <i class="entypo-plus-circled"></i>
                            Add Product/Service
                        </div>
                    </div>

                    <div class="panel-body">

                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="col-md-12 col-sm-12">
                                    <select onchange="return get_product_for_purchase(this.value)" class="form-control selectboxit" name="product_id" required>
                                        <optgroup label="Product">
                                        @foreach($inventories as $data)
                                            @if($data->type == 'product')
                                            <option data-id="{{$data->id}}" class="product" value="{{$data->id}}" onclick="addRow('dataTable')" >-{{ $data->name }}</option>
                                            @endif
                                        @endforeach
                                   </optgroup>
                                   <optgroup label="Services">
                                        @foreach($inventories as $data)
                                            @if($data->type == 'service')
                                            <option data-id="{{$data->id}}" value="{{$data->id}}" class="product" onclick="addRow('dataTable')" >-{{ $data->name }}</option>
                                            @endif
                                        @endforeach
                                  </optgroup>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-9">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Product Code</th>
                                            <th>Product Name</th>
                                            <th>quantity</th>
                                            <th>unit_price</th>
                                            <th>total</th>
                                            <th><i class="entypo-trash"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody id="purchase_entry_holder"></tbody>
                                </table>
                            </div>
                        </div>
                        
                    </div>
                </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection


@section('scripts')
<!-- <script src="{{ url('vendors/bootgrid/jquery.bootgrid.updated.min.js') }}"></script> -->
<script type="text/javascript">
   var total_number = 0;
    function get_product_for_purchase(product_id)
    {
        if(product_id != 0) {
            total_number++;

            $.ajax({
                var urlAdd = var url=location.origin+'/purchase/'+product_id+'/'+total_number;
                url: urlAdd,
                success: function(response)
                {
                    jQuery('#purchase_entry_holder').append(response);
                    calculate_sub_total_for_purchase();
                    
                    //INTIALIZE TOOLTIP FOR AJAX RESPONSE
                    $(".tooltip-primary").tooltip();
                }
            });
        }
    }

    function calculate_single_entry_sum(entry_number)
    {
        quantity            = $("#single_entry_quantity_"+entry_number).val();
        purchase_price      = $("#single_entry_purchase_price_"+entry_number).val();
        single_entry_total  = quantity * purchase_price;
        $("#single_entry_total_"+entry_number).html(single_entry_total);
        calculate_sub_total_for_purchase();

    }

    function delete_row(entry_number)
    {
        $("#entry_row_"+entry_number).remove();

        for (var i = entry_number ; i < total_number ; i++)
        {
            $("#serial_" + (i + 1)).attr("id" , "serial_" + i);
            $("#serial_" + (i)).html(i);

            $("#single_entry_quantity_" + (i + 1)).attr("id" , "single_entry_quantity_" + i);
            $("#single_entry_quantity_" + (i)).attr({onkeyup: "calculate_single_entry_sum(" + i + ")" , onclick: "calculate_single_entry_sum(" + i + ")"});

            $("#single_entry_purchase_price_" + (i + 1)).attr("id" , "single_entry_purchase_price_" + i);
            $("#single_entry_purchase_price_" + (i)).attr({onkeyup: "calculate_single_entry_sum(" + i + ")" , onclick: "calculate_single_entry_sum(" + i + ")"});

            $("#single_entry_total_" + (i + 1)).attr("id" , "single_entry_total_" + i);

            $("#delete_button_" + (i + 1)).attr("id" , "delete_button_" + i);
            $("#delete_button_" + (i)).attr("onclick" , "delete_row(" + i + ")");

            $("#entry_row_" + (i + 1)).attr("id" , "entry_row_" + i);
        }

        total_number--;
        calculate_sub_total_for_purchase();
    }

    function calculate_sub_total_for_purchase()
    {
        sub_total = 0;
        for (var i = 1 ; i <= total_number ; i++)
        {
            sub_total += Number( $("#single_entry_total_"+ i).html() );
        }

        document.getElementById('sub_total').value = sub_total;
        
        calculate_grand_total();
    }
    
    function calculate_grand_total()
    {
        var sub_total   = document.getElementById('sub_total').value;
        var vat_id      = document.getElementById('vat').value;
        var discount    = document.getElementById('discount').value;
        
        $.ajax({
            url: ,//'<?php echo base_url(); ?>index.php/inventory/get_grand_total_for_purchase/' + sub_total + '/' + vat_id + '/' + discount,
            success: function(response)
            {
                document.getElementById('grand_total').value = response;
            }
        });
    }
         
</script>
@endsection