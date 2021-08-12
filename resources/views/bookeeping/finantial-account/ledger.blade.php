
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
        <h3> </h3>
    </div>
    <div class="card-body card-padding">

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table id="data-table-basic" class="table table-striped">
                        <thead>
                            <tr>
                                            
                                <th data-column-id="id" data-type="numeric">#</th>
                                <th data-column-id="date">Date</th>
                                <th data-column-id="title">Title</th>
                                <th data-column-id="account">Account</th>
                                <th data-column-id="credit">Credit</th>
                                <th data-column-id="debit" data-order="desc">Debit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0;  $total_credit = 0; $total_debits = 0; ?>
                            @foreach($credits as $data )
                            <?php $i++; ?>
                            <tr>
                                <td>{{ $i}}</td>
                                <td>{{ $data->date }}</td>
                                <td>{{ $data->title }}</td>
                                <td>{{ $data->ac_title }}</td>
                                <td>{{ $data->amount }}</td>

                                <?php $total_credit += $data->amount ;?>
                                <td></td>
                            </tr>
                            @endforeach

                            @foreach($sales as $data)
                            <?php $i++; ?>
                                <tr>
                                    <td>{{ $i}}</td>
                                    <td>{{ $data->due_date }}</td>
                                    <td>{{ $data->sale_code }}</td>
                                    <td>{{ $data->ac_title }}</td>
                                    <td>{{ $data->amount }}</td>
                                     <?php $total_credit += $data->amount ;?>
                                    <td></td>
                                </tr>
                            @endforeach
                            @foreach($debits as $data)
                            <?php $i++; ?>
                                <tr>
                                    <td>{{ $i}}</td>
                                    <td>{{ date('d-m-Y', strtotime($data->created_at)) }}</td>
                                    <td>{{ $data->title }}</td>
                                    <td>{{ $data->ac_title }}</td>
                                    <td></td>
                                    <td>{{ $data->amount }}</td>
                                    <?php $total_debits += $data->amount ;?>
                                </tr>
                            @endforeach

                            @foreach($purchase as $data)
                            <?php $i++; ?>
                                <tr>
                                    <td>{{ $i}}</td>
                                    <td>{{ date('d-m-Y', strtotime($data->created_at)) }}</td>
                                    <td>{{ $data->purchase_code }}</td>
                                    <td>{{ $data->ac_title }}</td>
                                    <td></td>
                                    <td>{{ $data->amount }}</td>
                                     <?php $total_debits += $data->amount ;?>
                                </tr>

                            @endforeach


                        </tbody>
                    </table>
                    <h2> Balance Transfer Histry </h2>
                    <?php $famount = 0; $tamount = 0;?>
                    <table class="table">
                        <tr>
                            <th>S.L</th>
                            <th>From </th>
                            <th>To</th>
                            <th> Amount </th>
                            <th>Date</th>
                        </tr>
                        @foreach( $transferfrom as $data )
                        <?php $i++;?>
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{ $data-> f_title }}</td>
                            <td>{{ $data-> t_title}}</td>
                            <td>{{ $data-> amount}}</td>
                            <?php $famount += $data->amount;?>
                            <td>{{ $data-> date}}</td>
                            
                        </tr>
                        @endforeach

                        @foreach( $transferto as $data )
                        <?php $i++;?>
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{ $data-> f_title }}</td>
                            <td>{{ $data-> t_title}}</td>
                            <td>{{ $data-> amount}}</td>
                            <?php $tamount += $data->amount;?>
                            <td>{{ $data-> date}}</td>
                            
                        </tr>

                        @endforeach

                    </table>


                </div>

            </div>

            <div class="col-md-6 col-md-offset-3">
                <h1>Starting Balance : {{   $accounts->balance }}</h1>
                <h1>Total Credits : {{   $total_credit }}</h1>
                <h1>Total Debits : {{   $total_debits }}</h1>
                <?php 

                    $profit = $total_credit - $total_debits;

                    $balance = $accounts->balance + $profit;

                    $balance = $balance - $famount;

                   $balance = $balance + $tamount;

                ?>
                
                <hr>
                <h1>Total Balance : {{   $balance }}</h1>
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