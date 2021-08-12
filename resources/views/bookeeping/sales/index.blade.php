
@extends('layout.admin')
@section('title','Sales | Manage Sales')

@section('styles')
<style>
    .panel-heading {
    padding: 17px;
}
<style>
    .input-sm{
        width: 320px !important;
        float:right !important;
    }
    #example_filter{
        padding-left: 100px;
        padding-right: 20px;
    }
</style>
</style>


@endsection

@section('contentBody')
<div class="card">
    <div class="card-header">
        <h2>Manage Sales </h2>
    </div>
     <table id="example" class="display" cellspacing="0" width="100%">
     <thead>
        <tr>

            <th>Sale Code</th>
            <th>Customer</th>
            <th>Creation Date</th>
            <th>Amount</th>
            <th>Options</th>
        </tr>
     </thead>
     <tbody>
        @foreach($purchases as $user)
        <tr>
            <td>{{ $user->sale_code }}</td>
            <td>{{ $user->first_name }}</td>
            <td>{{ $user->due_date }}</td>
            <td>{{ $user->amount }}</td>
            <td>
                <a href="{{ route('sales.invoice',[$user->id] ) }}"><i class="fa fa-eye  custom-font" aria-hidden="true"></i></a>
                <a href="{{ route('sale.edit',[$user->id]) }}"><i class="fa fa-pencil custom-font" aria-hidden="true"></i></a>
                
                <a href="{{ route('sales.destroy',[$user->id]) }}" data-method="delete" 
                            data-token="{{ csrf_token() }}" data-confirm="Are you sure?"><i class="fa fa-trash-o text-danger custom-font" aria-hidden="true"></i></a>
            </td>
        </tr>
        @endforeach
        </tbody>
      
    </table>
    
</div>

@endsection


@section('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/r/bs-3.3.5/jqc-1.11.3,dt-1.10.8/datatables.min.js"></script>


<script type="text/javascript">


$(document).ready(function() {
    $('#example').DataTable();
} );

$('#example')
        .removeClass( 'display' )
        .addClass('table table-striped table-bordered');

</script>

@endsection