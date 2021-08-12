@extends('layout.admin')
@section('title','Accounts | Manage Suppliers')

@section('styles')
<style type="tex/css">
    .panel-heading {
    padding: 17px;
}
.dataTables_filter {
        padding-left: 100px !important;
        padding-right: 20px !important;
        display: block;
    }
.input-sm{
        width: 320px !important;
        float:right !important;
}
</style>


@endsection

@section('contentBody')
<h1 class="text-center">Accounting & Bookkeeping</h1>
<div class="card">
    <div class="card-header">
        <h3>{{ $contact->type == 'supplier' ? 'Supplier' : 'Customer' }} Details</h3>
        <div class="text-right">
            <a href="/" class="btn "> Home</a> / 
            <a href="/{{ $contact->type == 'supplier' ? 'suppliers' : 'customers' }}" class="btn ">{{ $contact->type == 'supplier' ? 'Supplier' : 'Customer' }}</a> / 
            <a href="{{ $contact->id }}" class="btn disabled">{{ $contact->type == 'supplier' ? 'Supplier' : 'Customer' }} Details</a>
        </div>
    </div>

    <div role="tabpanel">
        <ul class="tab-nav" role="tablist">
            <li class="active"><a href="#summary11" aria-controls="summary11" role="tab" data-toggle="tab">Summary</a></li>
            <li><a href="#purchase11" role="tab" data-toggle="tab">Purchase History</a></li>
            <li><a href="#email11" role="tab" data-toggle="tab">Email</a></li>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" aria-controls="summary11" id="summary11">
                <table id="data-table-command" class="table table-striped table-vmiddle">
                    <tbody>
                        <tr>
                            <th colspan="2"><h2>{{ $contact->first_name }} {{ $contact->last_name }}</h2></th>
                        </tr>
                        <tr>
                            <th>Company Name</th>
                            <td>{{ $contact->company_name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $contact->email }}</td>
                        </tr>
                        <tr>
                            <th>Skype</th>
                            <td>{{ $contact->skype_id }}</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>{{ $contact->phone }}</td>
                        </tr>
                        <tr>
                            <th>Mobile</th>
                            <td>{{ $contact->mobile }}</td>
                        </tr>
                        <tr>
                            <th>Website</th>
                            <td>{{ $contact->website }}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>{{ $contact->address }}</td>
                        </tr>
                        <tr>
                            <th>Country</th>
                            <td>{{ $contact->country }}</td>
                        </tr>
                        <tr>
                            <th>City</th>
                            <td>{{ $contact->City }}</td>
                        </tr>
                        <tr>
                            <th>Zip Code</th>
                            <td>{{ $contact->zip_code }}</td>
                        </tr>
                        <tr>
                            <th>Bank Account</th>
                            <td>{{ $contact->bank_account }}</td>
                        </tr>
                        
                        
                    </tbody>
                </table> 
            </div>
            <div role="tabpanel" class="tab-pane" aria-controls="purchase11" id="purchase11">
                    <table id="example" class="display" cellspacing="0" width="100%">
                         <thead>
                            <tr>

                                <th>Purchase Code</th>
                                <th>Supplier</th>
                                <th>Creation Date</th>
                                <th>Amount</th>
                                <th>Options</th>
                            </tr>
                         </thead>
                         <tbody>
                            @foreach($purchases as $user)
                            <tr>
                                <td>{{ $user->purchase_code }}</td>
                                <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                <td>{{ $user->due_date }}</td>
                                <td>{{ $user->amount }}</td>
                                <td>
                                    <a href="{{ route('purchase.invoice',[$user->id] ) }}"><i class="fa fa-eye  custom-font" aria-hidden="true"></i></a>
                                    
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                          
                        </table>
            </div>



            <div role="tabpanel" class="tab-pane"  aria-controls="email11" id="email11">
                <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <form action="">
                        <table id="data-table-command" class="table">
                            <tbody>
                                <tr>
                                    <th>To</th>
                                    <td>
                                        <div class="form-group ">
                                            <input type="text" class="form-control" value="{{ $contact->email }}" name="to" readonly value="{{ Input::old('to')}}" />
                                             @if ($errors->has('last_name'))
                                                <p class="text-right text-danger">{{$errors->first('to')}}</p>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Subject</th>
                                    <td>
                                        <div class="form-group ">
                                            <input type="text" class="form-control"  name="subject" placeholder="subject" value="{{ Input::old('subject')}}" />
                                            @if ($errors->has('subject'))
                                                <p class="text-right text-danger">{{$errors->first('subject')}}</p>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Message</th>
                                    <td>
                                        <div class="form-group ">
                                            <textarea class="form-control" rows="5" placeholder="message" name="message">{{ Input::old('message') }}</textarea>
                                            @if ($errors->has('message'))
                                             <p class="text-right text-danger">{{$errors->first('message')}}</p>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td> <button class="btn btn-primary">Send Mail</button> </td>
                                </tr>

                            </tbody>
                        </table>
                    </form>
                </div>  
                </div>  
            </div>
        </div>

    </div>

</div>


@endsection


@section('scripts')
    <script src="{{ url('vendors/bootstrap-wizard/jquery.bootstrap.wizard.min.js') }}"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/r/bs-3.3.5/jqc-1.11.3,dt-1.10.8/datatables.min.js"></script>

    <script type="text/javascript">


$(document).ready(function() {
    $('#example').DataTable();
} );

$('#example')
        .removeClass( 'display' )
        .addClass('table table-striped table-bordered');

</script>


@stop