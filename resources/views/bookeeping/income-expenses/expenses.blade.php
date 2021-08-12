@extends('layout.admin')
@section('title','Accounts | Manage Expenses')

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
        <h3>Manage Expenses</h3>
    </div>
    <div class="row">
        <div class="col-md-2 col-md-offset-10">
            <a href=" {{ route('expenses.create') }} " class="btn btn-primary  p-10" >Add New Expens</a>
        </div>
    </div>

    <table id="example" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>#</th>
                <th data-column-id="id" data-type="numeric">Title</th>
                <th data-column-id="name">Description</th>
                <th data-column-id="category">Category</th>
                <th data-column-id="category">Amount</th>
                <th data-column-id="category">Acount</th>
                <th data-column-id="category">Date</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 0; ?>
            @foreach($incomes as $income)
            <?php $i++ ; ?>
            <tr>
                <td>{{ $i }}</td>
                <td>{{ $income->title }}</td>
                <td>{{ $income->description }}</td>
                <td>{{ $income->category_id }}</td>
                <td>{{ $income->amount }}</td>
                <td>{{ $income->account_id }}</td>
                <td>{{ $income->date  }}</td>
                <td>
                    <a type="button" data-toggle="modal" data-income-id="{{ $income->id }}" data-target="#productEdit" class="btn btn-icon command-edit waves-effect waves-circle edit_product">
                        <span class="zmdi zmdi-edit"></span>
                    </a>
                    <a class="btn btn-icon command-edit waves-effect waves-circle text-danger  delete_product"  data-toggle="modal" data-target="#productDelete" data-delete-income-id="{{ $income->id }}">
                        <span class="zmdi zmdi-delete"></span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
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
                            <h3>Edit Income</h3>
                        </div>
                        <div class="panel-body">

                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control input-sm" id="title" name="title" placeholder="title" value="" />
                                </div>
                                    @if ($errors->has('title'))
                                        <p class="text-right text-danger">{{$errors->first('title')}}</p>
                                    @endif
                            </div>
                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="title">Date</label>
                                    <input type="text" class="form-control input-sm" id="date" name="date" placeholder="date" value="" readonly />
                                </div>
                                    @if ($errors->has('title'))
                                        <p class="text-right text-danger">{{$errors->first('title')}}</p>
                                    @endif
                            </div>
                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" rows="5" placeholder="description......" name="description" id="description">{{ Input::old('description') }}</textarea>
                                </div>
                                @if ($errors->has('description'))
                                 <p class="text-right text-danger">{{$errors->first('description')}}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <div class="fg-line">
                                    <div class="select">
                                        <h4>Category</h4>
                                        <select class="form-control" id="category_id" name="income_category_id">
                                            <option></option>
                                            @foreach( $categories as $category )
                                            <option value="{{ $category->id }}" {{ Input::old('category_id') == $category->id ? 'selected' : '' }} > {{ $category->income_name }} </option>
                                            @endforeach
                                                     
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="amount">Amount</label>
                                    <input type="number" class="form-control input-sm" id="amount" name="amount" placeholder="amount" value="" />
                                </div>
                                    @if ($errors->has('amount'))
                                        <p class="text-right text-danger">{{$errors->first('amount')}}</p>
                                    @endif
                            </div>
                            <div class="form-group">
                                <div class="fg-line">
                                    <div class="select">
                                        <h4>Account</h4>
                                        <select class="form-control" id="account_id" name="account_id">
                                            <option></option>
                                            @foreach( $accounts as $category )
                                            <option value="{{ $category->id }}" {{ Input::old('account_id') == $category->id ? 'selected' : '' }} > {{ $category->title }} </option>
                                            @endforeach
                                                     
                                        </select>
                                    </div>
                                </div>
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
                   
                //Basic Example
                // $("#data-table-basic").bootgrid({
                //     css: {
                //         icon: 'zmdi icon',
                //         iconColumns: 'zmdi-view-module',
                //         iconDown: 'zmdi-sort-amount-desc',
                //         iconRefresh: 'zmdi-refresh',
                //         iconUp: 'zmdi-sort-amount-asc'
                //     },
                // });

                //Selection
                // $("#data-table-selection").bootgrid({
                //     css: {
                //         icon: 'zmdi icon',
                //         iconColumns: 'zmdi-view-module',
                //         //iconDown: 'zmdi-sort-amount-desc',
                //         //iconRefresh: 'zmdi-refresh',
                //        // iconUp: 'zmdi-sort-amount-asc'
                //     },
                //     selection: true,
                //     multiSelect: true,
                //     rowSelect: true,
                //     keepSelection: true
                // });

                // //Command Buttons
                // $("#data-table-command").bootgrid({
                //     // css: {
                //     //     icon: 'zmdi icon',
                //     //     iconColumns: 'zmdi-view-module',
                //     //     //iconDown: 'zmdi-sort-amount-desc',
                //     //     //iconRefresh: 'zmdi-refresh',
                //     //     //iconUp: 'zmdi-sort-amount-asc'
                //     // }
                //     // formatters: {
                //     //     "commands": function(column, row) {
                //     //         // return "<button type=\"button\" class=\"btn btn-icon command-edit waves-effect waves-circle\" data-row-id=\"" + row.id + "\"><span class=\"zmdi zmdi-edit\"></span></button> " +
                //     //         //         "<button type=\"button\" class=\"btn btn-icon command-delete waves-effect waves-circle\" data-row-id=\"" + row.id + "\"><span class=\"zmdi zmdi-delete\"></span></button>";
                //     //     }
                //     // }
                // });


                $( ".edit_product" ).click(function() {

                    var account_id=$(this).data('income-id');

                    var update_url=location.origin+'/expenses/'+account_id;

                    var url=location.origin+'/expenses/'+account_id+'/edit';

                    $('.edit_product_form').attr('action',update_url);
                            
                        $.get(url,function(data){
                            $('#title').val(data['title']);
                            $('#description').val(data['description']);
                            $('#amount').val(data['amount']);
                            $('#date').val(data['date']);
                            
                            
                            var value = data['income_category_id'];
                            var value1 = data['account_id'];
                            $( "#category_id > option" ).each(function() {
                                if( parseInt($(this).val()) === parseInt(value) )
                                    {
                                      $(this).attr('selected', true);
                                    }
                            });

                            $( "#account_id > option" ).each(function() {
                                if( parseInt($(this).val()) === parseInt(value1) )
                                    {
                                      $(this).attr('selected', true);
                                    }
                            });
                            
                        });
                            
                });

                $( ".delete_product" ).click(function() {

                    var account_id=$(this).data('delete-income-id');
                    var url=location.origin+'/expenses/'+account_id;
                    $('.delete_product_form').attr('action',url);

                });


                $('#example').DataTable();   
            });
        $('#example')
    .removeClass( 'display' )
    .addClass('table table-striped table-bordered');
        </script>
@endsection