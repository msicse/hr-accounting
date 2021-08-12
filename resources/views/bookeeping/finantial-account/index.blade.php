@extends('layout.admin')
@section('title','Accounts | Manage Accounts')

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
                            <h3>Manage Accounts </h3>
                        </div>
                        

                        <table id="example" class="display" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th data-column-id="id" data-type="numeric">#</th>
                                <th data-column-id="title">Account Title</th>
                                <th data-column-id="account-number" >Account Number</th>
                                <th data-column-id="balance" >Starting Balance</th>
                                <th data-column-id="current-balance" >Current Balance</th>
                                <th data-column-id="type" >Account Type</th>
                                <th data-column-id="commands" data-formatter="commands" data-sortable="false">Options
                                </th>
                            </tr>
                            </thead>
                                  {!! $output !!}       
                            <tbody>
                            </tbody>
                        </table>
                    </div>




<!-- Modal Edit Account -->
                            <div class="modal fade" id="accountEdit" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form role="form" method="POST" action="" class="remove-margin-p edit_account_form" enctype="multipart/form-data" >
                                        <div class="modal-header">
                                            <h3 class="modal-title">Accounting & Bookkeeping </h3>
                                        </div>
                                        <div class="modal-body">
                                            <div class="panel panel-primary">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title">Edit Account</h3>
                                                </div>
                                                <div class="panel-body">
                                                    <input type="hidden" name="_method" value="PUT">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    
                                                        {{ csrf_field() }}
                                                            
                                                            <div class="form-group">
                                                                <div class="fg-line">
                                                                    <div class="select">
                                                                        <h4>Account Type</h4>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group ">
                                                                <div class="fg-line">
                                                                    <label for="title">Account Title</label>
                                                                    <input type="text" class="form-control input-sm" id="edit-title" name="title" placeholder="Account Title" value="" />
                                                                </div>
                                                                @if ($errors->has('title'))
                                                                    <p class="text-right text-danger">{{$errors->first('title')}}</p>
                                                                @endif
                                                            </div>

                                                            <div class="form-group ">
                                                                <div class="fg-line">
                                                                    <label for="account_number">Account Number</label>
                                                                    <input type="text" class="form-control input-sm" id="edit_account_number" name="account_number" placeholder="Account Number" value="{{ Input::old('account_number')  }}" />
                                                                </div>
                                                                @if ($errors->has('account_number'))
                                                                    <p class="text-right text-danger">{{$errors->first('account_number')}}</p>
                                                                @endif
                                                            </div>

                                                            <div class="form-group ">
                                                                <div class="fg-line">
                                                                    <label for="balance">Starting Balance</label>
                                                                    <input type="number" class="form-control input-sm" id="edit_balance" name="balance" placeholder="Starting Balance" value="{{ Input::old('balance')  }}" />
                                                                </div>
                                                                @if ($errors->has('balance'))
                                                                    <p class="text-right text-danger">{{$errors->first('balance')}}</p>
                                                                @endif
                                                            </div>

                                                        



                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                            <button type="button" class="btn btn-link" data-dismiss="modal">Close
                                            </button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
<!-- Modal Delete Account -->
                            <div class="modal fade" id="accountDelete" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <form action="" class="delete_account_form" method="post">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="modal-header">
                                            <h3 class="modal-title">Are you sure to delete this information ? </h3>
                                        </div>
                                        <div class="modal-body">
                                            
                                        </div>
                                        <div class="modal-footer">
                                        
                                            
                                        
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel
                                            </button>
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

                // //Selection
                // $("#data-table-selection").bootgrid({
                //     css: {
                //         icon: 'zmdi icon',
                //         iconColumns: 'zmdi-view-module',
                //         iconDown: 'zmdi-sort-amount-desc',
                //         iconRefresh: 'zmdi-refresh',
                //         iconUp: 'zmdi-sort-amount-asc'
                //     },
                //     selection: true,
                //     multiSelect: true,
                //     rowSelect: true,
                //     keepSelection: true
                // });

                //Command Buttons
                // $("#data-table-command").bootgrid({
                //     css: {
                //         icon: 'zmdi icon',
                //         iconColumns: 'zmdi-view-module',
                //         iconDown: 'zmdi-sort-amount-desc',
                //         iconRefresh: 'zmdi-refresh',
                //         iconUp: 'zmdi-sort-amount-asc'
                //     },
                //     // formatters: {
                //     //     "commands": function(column, row) {
                //     //         return "<button type=\"button\" class=\"btn btn-icon command-edit waves-effect waves-circle\" data-row-id=\"" + row.id + "\"><span class=\"zmdi zmdi-edit\"></span></button> " +
                //     //                 "<button type=\"button\" class=\"btn btn-icon command-delete waves-effect waves-circle\" data-row-id=\"" + row.id + "\"><span class=\"zmdi zmdi-delete\"></span></button>";
                //     //     }
                //     // }
                // });
                        

                        $( ".delete_account" ).click(function() {
                            var account_id=$(this).data('account-id');
                            var url=location.origin+'/accounts/'+account_id;
                            $('.delete_account_form').attr('action',url);
                        });

                        $( ".edit_account" ).click(function() {

                            var account_id=$(this).data('edit-account-id');

                            var update_url=location.origin+'/accounts/'+account_id;

                            var url=location.origin+'/accounts/'+account_id+'/edit';

                            $('.edit_account_form').attr('action',update_url);
                            
                            $.get(url,function(data){
                              $('#edit-title').val(data['title']);
                              $('#edit_account_number').val(data['account_number']);
                              $('#edit_balance').val(data['balance']);
                            });
                            
                        });

                $('#example').DataTable();                        
            });


   $('#example')
    .removeClass( 'display' )
    .addClass('table table-striped table-bordered');
</script>

@endsection