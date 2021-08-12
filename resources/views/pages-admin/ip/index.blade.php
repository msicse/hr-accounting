@extends('layout.admin')
@section('title','Accounts | Manage IP')

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
<div class="card ">
    <div class="card-header">
        <h3>Manage IP</h3>
    </div>
    <div class="row">
        <div class="col-md-2 col-md-offset-10">
            <button class="btn btn-primary  p-10" data-toggle="modal" data-target="#customerAdd">Add Ip</button>
        </div>
    </div>

    <!-- <table id="data-table-command" class="table table-striped table-vmiddle"> -->
    <table id="example" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>#</th>
                <th data-column-id="ip">IP</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 0; ?>
            @foreach($ips as $ip)
            <?php $i++ ; ?>
            <tr>
                <td>{{ $i }}</td>
                <td>{{ $ip->ip }}</td>
                <td>
                    <a type="button" data-toggle="modal" data-edit-customer-id="{{ $ip->id }}" data-target="#customerEdit" class="btn btn-icon command-edit waves-effect waves-circle edit_customer">
                        <span class="zmdi zmdi-edit"></span>
                    </a>
                    <a class="btn btn-icon command-edit waves-effect waves-circle text-danger  delete_customer"  data-toggle="modal" data-target="#customerDelete" data-customer-id="{{ $ip->id }}">
                        <span class="zmdi zmdi-delete"></span>
                    
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Add Product -->

<div class="modal fade" id="customerAdd" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="POST" action="{{ route('ip.store') }}" class="remove-margin-p" >
                {{ csrf_field() }}
                <div class="modal-header">
                    <h3 class="modal-title">Admin Management</h3>
                </div>
                <div class="modal-body">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3>Add IP</h3>
                        </div>
                        <div class="panel-body">

                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="ip">IP</label>
                                    <input type="text" class="form-control input-sm" name="ip" placeholder="127.0.0.1" value="{{ Input::old('ip')}}" />
                                </div>
                                    @if ($errors->has('ip'))
                                        <p class="text-right text-danger">{{$errors->first('ip')}}</p>
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

<div class="modal fade" id="customerEdit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="POST" action="" class="remove-margin-p edit_customer_form" >
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="modal-header">
                    <h3 class="modal-title">Admin Management</h3>
                </div>
                <div class="modal-body">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3>Edit IP</h3>
                        </div>
                        <div class="panel-body">

                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="edit_ip">IP</label>
                                    <input type="text" class="form-control input-sm" id="ip" name="edit_ip" placeholder="127.0.0.1" value="{{ Input::old('edit_ip')}}" />
                                </div>
                                    @if ($errors->has('edit_ip'))
                                        <p class="text-right text-danger">{{$errors->first('edit_ip')}}</p>
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

<!-- Modal Delete customer -->

<div class="modal fade" id="customerDelete" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" class="delete_customer_form" method="post">
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


@if ($errors->has('ip'))
    <script>
        $("#customerAdd").modal("show");
    </script>
  @endif


@if ($errors->has('edit_ip'))
    <script>
        $("#customerEdit").modal("show");
    </script>
  @endif

        <script type="text/javascript">
            $(document).ready(function(){
                

                $( ".edit_customer" ).click(function() {

                    var account_id=$(this).data('edit-customer-id');

                    var update_url=location.origin+'/employee-server/public/ip/'+account_id;

                    var url=location.origin+'/employee-server/public/ip/'+account_id+'/edit';

                    $('.edit_customer_form').attr('action',update_url);
                            
                        $.get(url,function(data){
                            $('#ip').val(data['ip']);
                        });
                            
                });


                $( ".delete_customer" ).click(function() {

                    var account_id=$(this).data('customer-id');
                    var url=location.origin+'/employee-server/public/ip/'+account_id;
                    $('.delete_customer_form').attr('action',url);

                });

                $('#example').DataTable();

            });
            $('#example')
            .removeClass( 'display' )
            .addClass('table table-striped table-bordered table-responsive');

        </script>
@endsection