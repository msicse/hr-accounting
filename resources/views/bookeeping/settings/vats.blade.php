
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
        <h3>Manage Vat</h3>
    </div>
    <div class="row">
        <div class="col-md-2 col-md-offset-10">
            <button class="btn btn-primary  p-10" data-toggle="modal" data-target="#categoryAdd">Add Vat</button>
        </div>
    </div>

    <table id="data-table-command" class="table table-striped table-vmiddle">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Percentage</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 0; ?>
            @foreach( $vats as $category )
            <?php $i ++; ?>
            <tr>
                <td>{{ $i }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->percentage }}</td>
                <td>
                    <a type="button" data-toggle="modal" data-edit-category-id="{{ $category->id }}" data-target="#categoryEdit" class="btn btn-icon command-edit waves-effect waves-circle edit_category">
                        <span class="zmdi zmdi-edit"></span>
                    </a>
                    <a class="btn btn-icon command-edit waves-effect waves-circle text-danger  delete_category"  data-toggle="modal" data-target="#categoryDelete" data-category-id="{{ $category->id }}">
                        <span class="zmdi zmdi-delete"></span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Add Category -->

<div class="modal fade" id="categoryAdd" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="POST" action="{{ route('vats.store') }}" class="remove-margin-p">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h3 class="modal-title">Accounting & Bookkeeping </h3>
                </div>
                <div class="modal-body">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3>Add Vat</h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="title">Vat Name</label>
                                    <input type="text" class="form-control input-sm" name="name" placeholder="name" value="" />
                                </div>
                                    @if ($errors->has('name'))
                                        <p class="text-right text-danger">{{$errors->first('name')}}</p>
                                    @endif
                            </div>
                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="percentage">Percentage</label>
                                    <input type="text" class="form-control input-sm" name="percentage" placeholder="percentage" value="" />
                                </div>
                                    @if ($errors->has('percentage'))
                                        <p class="text-right text-danger">{{$errors->first('percentage')}}</p>
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

<!-- Modal Edit Category -->

<div class="modal fade" id="categoryEdit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="POST" action="" class="remove-margin-p edit_category_form" >
                <div class="modal-header">
                    <h3 class="modal-title">Accounting & Bookkeeping </h3>
                </div>
                <div class="modal-body">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Edit Vat</h3>
                        </div>
                        <div class="panel-body">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="title"> Name</label>
                                    <input type="text" class="form-control input-sm" id="name" name="name" placeholder="name" value="" />
                                </div>
                                    @if ($errors->has('title'))
                                        <p class="text-right text-danger">{{$errors->first('title')}}</p>
                                    @endif
                            </div>

                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="percentage"> Percentage</label>
                                    <input type="text" class="form-control input-sm" id="percentage" name="percentage" placeholder="percentage" value="" />
                                </div>
                                    @if ($errors->has('percentage'))
                                        <p class="text-right text-danger">{{$errors->first('percentage')}}</p>
                                    @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update changes</button>
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Delete Category -->

<div class="modal fade" id="categoryDelete" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" class="delete_category_form" method="post">
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

                $( ".delete_category" ).click(function() {
                    var account_id=$(this).data('category-id');
                    var url=location.origin+'/vats/'+account_id;
                    $('.delete_category_form').attr('action',url);
                });

                $( ".edit_category" ).click(function() {

                    var account_id=$(this).data('edit-category-id');

                    var update_url=location.origin+'/vats/'+account_id;

                    var url=location.origin+'/vats/'+account_id+'/edit';

                    $('.edit_category_form').attr('action',update_url);
                            
                        $.get(url,function(data){
                            $('#name').val(data['name']);
                            $('#percentage').val(data['percentage']);
                            
                        });
                            
                });


            });


        </script>
@endsection