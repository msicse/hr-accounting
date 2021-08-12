@extends('layout.admin')
@section('title','Accounts | Manage Suppliers')

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
        <h3>Manage Suppliers</h3>
    </div>
    <div class="row">
        <div class="col-md-2 col-md-offset-10">
            <button class="btn btn-primary  p-10" data-toggle="modal" data-target="#customerAdd">Add Supplier</button>
        </div>
    </div>

    <!-- <table id="data-table-command" class="table table-striped table-vmiddle"> -->
    <table id="example" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>#</th>
                <th data-column-id="name">Name</th>
                <th data-column-id="category">Company Name</th>
                <th data-column-id="category">Email</th>
                <th data-column-id="category">Phone</th>
                <th data-column-id="category">Type</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 0; ?>
            @foreach($contacts as $contact)
            <?php $i++ ; ?>
            <tr>
                <td>{{ $i }}</td>
                <td>{{ $contact->first_name }} {{ $contact->last_name }}</td>
                <td>{{ $contact->company_name }}</td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->phone }}</td>
                <td>{{ $contact->type }}</td>
                
                <td>
                    <a href="{{ route('suppliers.show',['id' => $contact->id ]) }}" class="btn btn-icon command-edit waves-effect waves-circle">
                        <span class="zmdi zmdi-eye"></span>
                    </a>
                    <a type="button" data-toggle="modal" data-edit-customer-id="{{ $contact->id }}" data-target="#customerEdit" class="btn btn-icon command-edit waves-effect waves-circle edit_customer">
                        <span class="zmdi zmdi-edit"></span>
                    </a>
                    <a class="btn btn-icon command-edit waves-effect waves-circle text-danger  delete_customer"  data-toggle="modal" data-target="#customerDelete" data-customer-id="{{ $contact->id }}">
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
            <form role="form" method="POST" action="{{ route('suppliers.store') }}" class="remove-margin-p" >
                {{ csrf_field() }}
                <div class="modal-header">
                    <h3 class="modal-title">Accounting & Bookkeeping </h3>
                </div>
                <div class="modal-body">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3>Add Supplier</h3>
                        </div>
                        <div class="panel-body">

                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="first_name">First Name</label>
                                    <input type="text" class="form-control input-sm" name="first_name" placeholder="name" value="{{ Input::old('first_name')}}" />
                                </div>
                                    @if ($errors->has('first_name'))
                                        <p class="text-right text-danger">{{$errors->first('first_name')}}</p>
                                    @endif
                            </div>
                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" class="form-control input-sm"  name="last_name" placeholder="last_name" value="{{ Input::old('last_name')}}" />
                                </div>
                                    @if ($errors->has('last_name'))
                                        <p class="text-right text-danger">{{$errors->first('last_name')}}</p>
                                    @endif
                            </div>
                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="company_name">Company Name</label>
                                    <input type="text" class="form-control input-sm"  name="company_name" placeholder="company_name" value="{{ Input::old('company_name')}}" />
                                </div>
                                    @if ($errors->has('company_name'))
                                        <p class="text-right text-danger">{{$errors->first('company_name')}}</p>
                                    @endif
                            </div>
                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control input-sm" name="email" placeholder="email" value="{{ Input::old('email')}}" />
                                </div>
                                    @if ($errors->has('email'))
                                        <p class="text-right text-danger">{{$errors->first('email')}}</p>
                                    @endif
                            </div>
                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control input-sm" name="phone" placeholder="phone" value="{{ Input::old('phone')}}" />
                                </div>
                                    @if ($errors->has('phone'))
                                        <p class="text-right text-danger">{{$errors->first('phone')}}</p>
                                    @endif
                            </div>
                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="mobile">Mobile</label>
                                    <input type="text" class="form-control input-sm" name="mobile" placeholder="mobile" value="{{ Input::old('mobile')}}" />
                                </div>
                                    @if ($errors->has('mobile'))
                                        <p class="text-right text-danger">{{$errors->first('mobile')}}</p>
                                    @endif
                            </div>
                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="website">Website</label>
                                    <input type="text" class="form-control input-sm"  name="website" placeholder="website" value="{{ Input::old('website')}}" />
                                </div>
                                    @if ($errors->has('website'))
                                        <p class="text-right text-danger">{{$errors->first('website')}}</p>
                                    @endif
                            </div>
                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="skype_id">Skype Id</label>
                                    <input type="text" class="form-control input-sm" name="skype_id" placeholder="skype_id" value="{{ Input::old('skype_id')}}" />
                                </div>
                                    @if ($errors->has('skype_id'))
                                        <p class="text-right text-danger">{{$errors->first('skype_id')}}</p>
                                    @endif
                            </div>
                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="address">Address</label>
                                    <textarea class="form-control" rows="5" placeholder="notes......" name="address">{{ Input::old('address') }}</textarea>
                                </div>
                                @if ($errors->has('address'))
                                 <p class="text-right text-danger">{{$errors->first('address')}}</p>
                                @endif
                            </div>
                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="country">Country</label>
                                    <input type="text" class="form-control input-sm" name="country" placeholder="country" value="{{ Input::old('country')}}" />
                                </div>
                                    @if ($errors->has('country'))
                                        <p class="text-right text-danger">{{$errors->first('country')}}</p>
                                    @endif
                            </div>
                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="city">City</label>
                                    <input type="text" class="form-control input-sm" name="city" placeholder="city" value="{{ Input::old('city')}}" />
                                </div>
                                    @if ($errors->has('city'))
                                        <p class="text-right text-danger">{{$errors->first('city')}}</p>
                                    @endif
                            </div>
                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="state">State</label>
                                    <input type="text" class="form-control input-sm"  name="state" placeholder="state" value="{{ Input::old('state')}}" />
                                </div>
                                    @if ($errors->has('state'))
                                        <p class="text-right text-danger">{{$errors->first('state')}}</p>
                                    @endif
                            </div>
                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="zip_code">Zip Code</label>
                                    <input type="text" class="form-control input-sm"  name="zip_code" placeholder="zip_code" value="{{ Input::old('zip_code')}}" />
                                </div>
                                    @if ($errors->has('zip_code'))
                                        <p class="text-right text-danger">{{$errors->first('zip_code')}}</p>
                                    @endif
                            </div>
                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="bank_account">Bank Account</label>
                                    <input type="text" class="form-control input-sm"  name="bank_account" placeholder="bank_account" value="{{ Input::old('bank_account')}}" />
                                </div>
                                    @if ($errors->has('bank_account'))
                                        <p class="text-right text-danger">{{$errors->first('bank_account')}}</p>
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
                    <h3 class="modal-title">Accounting & Bookkeeping </h3>
                </div>
                <div class="modal-body">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3>Edit Supplier</h3>
                        </div>
                        <div class="panel-body">

                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="first_name">First Name</label>
                                    <input type="text" class="form-control input-sm" id="first_name" name="first_name" placeholder="name" value="{{ Input::old('first_name')}}" />
                                </div>
                                    @if ($errors->has('first_name'))
                                        <p class="text-right text-danger">{{$errors->first('first_name')}}</p>
                                    @endif
                            </div>
                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" class="form-control input-sm" id="last_name" name="last_name" placeholder="last_name" value="{{ Input::old('last_name')}}" />
                                </div>
                                    @if ($errors->has('last_name'))
                                        <p class="text-right text-danger">{{$errors->first('last_name')}}</p>
                                    @endif
                            </div>
                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="company_name">Company Name</label>
                                    <input type="text" class="form-control input-sm" id="company_name" name="company_name" placeholder="company_name" value="{{ Input::old('company_name')}}" />
                                </div>
                                    @if ($errors->has('company_name'))
                                        <p class="text-right text-danger">{{$errors->first('company_name')}}</p>
                                    @endif
                            </div>
                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control input-sm" id="email" name="email" placeholder="email" value="{{ Input::old('email')}}" />
                                </div>
                                    @if ($errors->has('email'))
                                        <p class="text-right text-danger">{{$errors->first('email')}}</p>
                                    @endif
                            </div>
                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control input-sm" id="phone" name="phone" placeholder="phone" value="{{ Input::old('phone')}}" />
                                </div>
                                    @if ($errors->has('phone'))
                                        <p class="text-right text-danger">{{$errors->first('phone')}}</p>
                                    @endif
                            </div>
                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="mobile">Mobile</label>
                                    <input type="text" class="form-control input-sm" id="mobile" name="mobile" placeholder="mobile" value="{{ Input::old('mobile')}}" />
                                </div>
                                    @if ($errors->has('mobile'))
                                        <p class="text-right text-danger">{{$errors->first('mobile')}}</p>
                                    @endif
                            </div>
                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="website">Website</label>
                                    <input type="text" class="form-control input-sm" id="website" name="website" placeholder="website" value="{{ Input::old('website')}}" />
                                </div>
                                    @if ($errors->has('website'))
                                        <p class="text-right text-danger">{{$errors->first('website')}}</p>
                                    @endif
                            </div>
                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="skype_id">Skype Id</label>
                                    <input type="text" class="form-control input-sm" id="skype_id" name="skype_id" placeholder="skype_id" value="{{ Input::old('skype_id')}}" />
                                </div>
                                    @if ($errors->has('skype_id'))
                                        <p class="text-right text-danger">{{$errors->first('skype_id')}}</p>
                                    @endif
                            </div>
                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="address">Address</label>
                                    <textarea class="form-control" rows="5" placeholder="notes......" name="address" id="address">{{ Input::old('address') }}</textarea>
                                </div>
                                @if ($errors->has('address'))
                                 <p class="text-right text-danger">{{$errors->first('address')}}</p>
                                @endif
                            </div>
                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="country">Country</label>
                                    <input type="text" class="form-control input-sm" id="country" name="country" placeholder="country" value="{{ Input::old('country')}}" />
                                </div>
                                    @if ($errors->has('country'))
                                        <p class="text-right text-danger">{{$errors->first('country')}}</p>
                                    @endif
                            </div>
                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="city">City</label>
                                    <input type="text" class="form-control input-sm" id="city" name="city" placeholder="city" value="{{ Input::old('city')}}" />
                                </div>
                                    @if ($errors->has('city'))
                                        <p class="text-right text-danger">{{$errors->first('city')}}</p>
                                    @endif
                            </div>
                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="state">State</label>
                                    <input type="text" class="form-control input-sm" id="state" name="state" placeholder="state" value="{{ Input::old('state')}}" />
                                </div>
                                    @if ($errors->has('state'))
                                        <p class="text-right text-danger">{{$errors->first('state')}}</p>
                                    @endif
                            </div>
                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="zip_code">Zip Code</label>
                                    <input type="text" class="form-control input-sm" id="zip_code" name="zip_code" placeholder="zip_code" value="{{ Input::old('zip_code')}}" />
                                </div>
                                    @if ($errors->has('zip_code'))
                                        <p class="text-right text-danger">{{$errors->first('zip_code')}}</p>
                                    @endif
                            </div>
                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="bank_account">Bank Account</label>
                                    <input type="text" class="form-control input-sm" id="bank_account" name="bank_account" placeholder="bank_account" value="{{ Input::old('bank_account')}}" />
                                </div>
                                    @if ($errors->has('bank_account'))
                                        <p class="text-right text-danger">{{$errors->first('bank_account')}}</p>
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


                $( ".edit_customer" ).click(function() {

                    var account_id=$(this).data('edit-customer-id');

                    var update_url=location.origin+'/suppliers/'+account_id;

                    var url=location.origin+'/suppliers/'+account_id+'/edit';

                    $('.edit_customer_form').attr('action',update_url);
                            
                        $.get(url,function(data){
                            $('#first_name').val(data['first_name']);
                            $('#last_name').val(data['last_name']);
                            $('#company_name').val(data['company_name']);
                            $('#email').val(data['email']);
                            $('#phone').val(data['phone']);
                            $('#mobile').val(data['mobile']);
                            $('#website').val(data['website']);
                            $('#skype_id').val(data['skype_id']);
                            $('#address').val(data['address']);
                            $('#country').val(data['country']);
                            $('#city').val(data['city']);
                            $('#zip_code').val(data['zip_code']);
                            $('#state').val(data['state']);
                            $('#bank_account').val(data['bank_account']);
                           
  
                        });
                            
                });

                $( ".delete_customer" ).click(function() {

                    var account_id=$(this).data('customer-id');
                    var url=location.origin+'/suppliers/'+account_id;
                    $('.delete_customer_form').attr('action',url);

                });

                $('#example').DataTable();

            });
            $('#example')
            .removeClass( 'display' )
            .addClass('table table-striped table-bordered');

        </script>
@endsection