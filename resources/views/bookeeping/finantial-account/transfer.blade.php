@extends('layout.admin')
@section('title','Accounts | Manage Transfer')

@section('styles')
<style>
    .panel-heading {
    padding: 17px;
}
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
<h1 class="text-center">Accounting & Bookkeeping</h1>
<div class="card">
    <div class="card-header">
        <h3>Manage Account Transfer</h3>
    </div>
    <div class="row">
        <div class="col-md-2 col-md-offset-10">
            <a href=" {{route('transfer.create')}} " class="btn btn-primary  p-10">Add Transfer</a>
        </div>
    </div>

    <table id="example" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>#</th>
                <th data-column-id="id" data-type="numeric">From</th>
                <th data-column-id="name">To</th>
                <th data-column-id="category">Amount</th>
                <th data-column-id="category">Date</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 0; ?>
            @foreach($transfer as $product)
            <?php $i++ ; ?>
            <tr>
                <td>{{ $i }}</td>
                <td>{{ $product->f_title }}</td>
                <td>{{ $product->t_title }}</td>
                <td>{{ $product->amount }}</td>
                <td>{{ $product->date }}</td>
                
                <td>
                    <a type="button" data-toggle="modal" data-edit-product-id="{{ $product->id }}" data-target="#productEdit" class="btn btn-icon command-edit waves-effect waves-circle edit_product">
                        <span class="zmdi zmdi-edit"></span>
                    </a>
                    <a class="btn btn-icon command-edit waves-effect waves-circle text-danger  delete_product"  data-toggle="modal" data-target="#productDelete" data-product-id="{{ $product->id }}">
                        <span class="zmdi zmdi-delete"></span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Add Product -->

<div class="modal fade" id="productAdd" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="POST" action="{{ route('transfer.store') }}" class="remove-margin-p" >
                {{ csrf_field() }}
                <div class="modal-header">
                    <h3 class="modal-title">Accounting & Bookkeeping </h3>
                </div>
                <div class="modal-body">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3>Add Account Transfer</h3>
                        </div>
                        <div class="panel-body">

                            <div class="form-group">
                                <div class="fg-line">
                                    <div class="select">
                                        <h4>From</h4>
                                        <select required name="from" id="" class="form-control">
                                            <option value=""></option>
                                            @foreach($accounts as $data)
                                                <option value="{{ $data->id }}">{{ $data->title  }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                 @if ($errors->has('from'))
                                        <p class="text-right text-danger">{{$errors->first('from')}}</p>
                                    @endif
                            </div>
                            <div class="form-group">
                                <div class="fg-line">
                                    <div class="select">
                                        <h4>To</h4>
                                        <select required name="to" id="" class="form-control">
                                            <option value=""></option>
                                            @foreach($accounts as $data)
                                                <option value="{{ $data->id }}">{{ $data->title  }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                     @if ($errors->has('to'))
                                        <p class="text-right text-danger">{{$errors->first('to')}}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="price">Amount</label>
                                    <input type="number" class="form-control input-sm" id="price" name="amount" placeholder="amount" value="" />
                                </div>
                                    @if ($errors->has('amount'))
                                        <p class="text-right text-danger">{{$errors->first('amount')}}</p>
                                    @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Product -->
<div class="modal fade" id="productEdit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="POST" action="" class="remove-margin-p edit_product_form" >
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    
                <div class="modal-header">
                    <h3 class="modal-title">Accounting & Bookkeeping </h3>
                </div>
                <div class="modal-body">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3>Edit Account Transfer</h3>
                        </div>
                        <div class="panel-body">

                        <div class="form-group ">
                                <div class="fg-line">
                                    <label for="date">Date</label>
                                    <input type="date" class="form-control input-sm" id="edit-date" name="date" placeholder="date" value="" />
                                </div>
                                    @if ($errors->has('date'))
                                        <p class="text-right text-danger">{{$errors->first('date')}}</p>
                                    @endif
                            </div>

                        
                        <div class="form-group">
                                <div class="fg-line">
                                    <div class="select">
                                        <h4>From</h4>
                                        <select required name="from" id="edit-from" class="form-control">
                                            <option value=""></option>
                                            @foreach($accounts as $data)
                                                <option value="{{ $data->id }}">{{ $data->title  }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                 @if ($errors->has('from'))
                                        <p class="text-right text-danger">{{$errors->first('from')}}</p>
                                    @endif
                            </div>
                            <div class="form-group">
                                <div class="fg-line">
                                    <div class="select">
                                        <h4>To</h4>
                                        <select required name="to" id="edit-to" class="form-control">
                                            <option value=""></option>
                                            @foreach($accounts as $data)
                                                <option value="{{ $data->id }}">{{ $data->title  }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                     @if ($errors->has('to'))
                                        <p class="text-right text-danger">{{$errors->first('to')}}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="price">Amount</label>
                                    <input type="number" class="form-control input-sm" id="edit-amount" name="amount" placeholder="amount" value="" />
                                </div>
                                    @if ($errors->has('amount'))
                                        <p class="text-right text-danger">{{$errors->first('amount')}}</p>
                                    @endif
                            </div>
                            

                            

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"> Update changes</button>
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Delete product -->

<div class="modal fade" id="productDelete" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" class="delete_product_form" method="post">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="modal-header">
                    <h3 class="modal-title">Are you sure to delete this information ? </h3>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Delete</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel </button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection


@section('scripts')
<script src="{{ url('vendors/bootgrid/jquery.bootgrid.updated.min.js') }}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/r/bs-3.3.5/jqc-1.11.3,dt-1.10.8/datatables.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
               
                $( ".edit_product" ).click(function() {

                    var account_id = $(this).data('edit-product-id');

                    var update_url = location.origin+'/account-transfer/'+account_id;

                    var url=location.origin+'/account-transfer/'+account_id+'/edit';

                    $('.edit_product_form').attr('action',update_url);
                            
                        $.get(url,function(data){

                            $('#edit-amount').val(data['amount']);
                            $('#edit-date').val(data['date']);

                           var value = data['ac_from'];
                           var valueT = data['ac_to'];

                            $( "#edit-from > option" ).each(function() {
                                if( parseInt($(this).val()) === parseInt(value) )
                                    {
                                      $(this).attr('selected', true);
                                    }
                            });

                            $( "#edit-to > option" ).each(function() {
                                if( parseInt($(this).val()) === parseInt(valueT) )
                                    {
                                      $(this).attr('selected', true);
                                    }
                            });

                            
                        });
                            
                });


                $( ".delete_product" ).click(function() {

                    var account_id=$(this).data('product-id');
                    var url=location.origin+'/account-transfer/'+account_id;
                    $('.delete_product_form').attr('action',url);

                });

                $('#example').DataTable();                        
            });


   $('#example')
    .removeClass( 'display' )
    .addClass('table table-striped table-bordered');
        </script>
@endsection