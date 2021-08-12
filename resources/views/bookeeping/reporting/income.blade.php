
@extends('layout.admin')
@section('title','Accounts | Manage Accounts')

@section('styles')
<style>
    .panel-heading {
    padding: 17px;
}
.border-all { border:1px solid #2196F3; margin-bottom: 50px; }

</style>
<!-- <link href="{{ url("vendors/bootgrid/jquery.bootgrid.min.css")}}" rel="stylesheet"> -->






@endsection

@section('contentBody')
<h1 class="text-center">Accounting & Bookkeeping</h1>
<div class="card">
    <div class="card-header">
        <h3>Income Report </h3>
    </div>
    <div class="card-body card-padding">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('report.incomes') }}" method="post" class="border-all">
                    {{csrf_field()}}
                    <table class="table table-bordered">
                        <tr>
                            <th>Account</th>
                            <td>
                                <select name="account_id" id="" class="form-control">
                                    <option value="all" selected> All Accounts </option>
                                    @foreach($accounts as $data)
                                    <option value=" {{ $data->id }}"> {{ $data->title }} </option>
                                    @endforeach
                                    </select>
                                </td>
                        </tr>
                        <tr>
                            <th>From Date</th>
                            <td>
                                <div class="input-group form-group">
                                    <span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
                                    <div class="dtp-container">
                                        <input type='text' name="from" class="form-control date-picker" placeholder="Click here...">
                                    </div>
                                </div>                   
                            </td>
                        </tr>
                        <tr>
                            <th>To Date</th>
                            <td>
                                <div class="input-group form-group">
                                    <span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
                                    <div class="dtp-container">
                                        <input type='text' name="to" class="form-control date-picker" placeholder="Click here...">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-center">  <button class="btn btn-primary" type="submit">Filter</button> </td>
                        </tr>
                    </table>   
                </form>
            </div>
        </div> 
            
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                <tr>
                                            
                                    <th data-column-id="id" >#</th>
                                    <th data-column-id="date">Date</th>
                                    <th data-column-id="title">Title</th>
                                    <th data-column-id="account">Account</th>
                                    <th data-column-id="credit">Credit</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 0;  $total_credit = 0; ?>
                                @if(Session::has('credits') and Session::has('sales'))
                                    @foreach(Session::get('credits') as $data)
                                    <?php $i++; ?>
                                        <tr>
                                            <td>{{ $i}}</td>
                                            <td>{{ date('d-m-Y', strtotime($data->created_at)) }}</td>
                                            <td>{{ $data->title }}</td>
                                            <td>{{ $data->ac_title }}</td>
                                            <td>{{ $data->amount }}</td>
                                            <?php $total_credit += $data->amount ;?>
                                            <td></td>
                                        </tr>
                                    @endforeach

                                    @foreach(Session::get('sales') as $data)
                                    <?php $i++; ?>
                                        <tr>
                                            <td>{{ $i}}</td>
                                            <td>{{ date('d-m-Y', strtotime($data->created_at)) }}</td>
                                            <td>{{ $data->sale_code }}</td>
                                            <td>{{ $data->ac_title }}</td>
                                            <td>{{ $data->amount }}</td>
                                             <?php $total_credit += $data->amount ;?>
                                        </tr>
                                    @endforeach

                                @endif

                                </tbody>
                            </table>
                        </div>

            </div>
            <div class="col-md-6 col-md-offset-3">
                <h1>Total Income : {{   $total_credit }}</h1>

            </div>
        </div>
    </div>
</div>

@endsection


@section('scripts')

<!-- <script type="text/javascript" src="https://cdn.datatables.net/r/bs-3.3.5/jqc-1.11.3,dt-1.10.8/datatables.min.js"></script>

 -->
 <script src="{{ url("vendors/bootgrid/jquery.bootgrid.updated.min.js") }}" ></script>
<script type="text/javascript">
     // $('#datepicker').datepicker({
     //            multidate: true,
     //       });
$(document).ready(function() {

    $("#data-table-basic").bootgrid({
        css: {
                icon: 'zmdi icon',
                iconColumns: 'zmdi-view-module',
                iconDown: '',
                iconRefresh: 'zmdi-refresh',
                iconUp: ''
            },
    });
});

// $('#example').removeClass( 'display' ).addClass('table table-striped table-bordered');

</script>
@endsection