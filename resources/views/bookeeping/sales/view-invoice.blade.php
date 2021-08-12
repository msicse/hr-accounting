
@extends('layout.admin')
@section('title','Sales | Invoice ')

@section('styles')
<style>
    .panel-heading {
    padding: 17px;
}
.border-bottom { border-bottom: 1px solid #eee; }
.menue-inline { padding: 10px 15px; background: #eee; font-size: 18px;}
.custom-font-me { font-size : 18px; }
</style>


@endsection

@section('contentBody')
<h1 class="text-center">Accounting & Bookkeeping</h1>
<div class="card">
    <div class="card-header border-bottom" >
        <h3>Purchase Invoice Details </h3>
    </div>
    
    <div class="card-body card-padding">
    <div class="row">
        <div class="col-md-6  menue-inline">
             <a href="#">Home</a>  / <a href="#">Sale History</a> / <a href="#">Sale Invoice </a>
        </div>
    </div>

        <div class="row border-bottom">
            <div class="col-md-6 ">
                
            </div>
            <div class="col-md-6 text-right">
                <h4> Sale Code : {{ $invoice->sale_code }} </h4> 
                <p>Creation Date : {{ $invoice->due_date }}</p>
               
                <p>Account : {{ $invoice->title }} </p>
            </div>
        </div>

        <div class="row border-bottom">
            <div class="col-md-6 ">
                <h4>Form</h4>
                <h2>Accounting & Bookkeeping</h2>
            </div>
            <div class="col-md-6 text-right">

                <h4> To </h4>

                <h2>{{ $invoice->first_name }} {{ $invoice->last_name }}</h2> 
                <address>
                    {{ $invoice->address }} <br>
                    {{ $invoice->phone }} <br>
                    {{ $invoice->email }}
                </address>
            </div>
        </div>

        <div class="row border-bottom">
            <div class="col-md-12">
               <h4>Purchase Items</h4>
                
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Product Code</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th class="text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  $i=0;$subTotal=0;?>
                        @foreach( $purchaseitems as $data )
                        <?php  $i++; ?>
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $data->product_code }}</td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->quantity }}</td>
                            <td>{{ $data->price }}</td>
                            <?php $total = $data->price * $data->quantity ; $subTotal +=$total ; ?> 
                            <td class="text-right">{{ $total }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        </div>
        <div class="row border-bottom">
            <div class="col-md-5 col-md-offset-7 ">
                <table class="table">
                    <tr>
                        <td> Sub Total : </td>
                        <td class="text-right">{{ $subTotal }}</td>
                    </tr>
                    <tr>
                        <td> Vat : </td>
                        <td class="text-right">{{ empty($invoice->percentage) ? '' : $invoice->percentage }} (%) </td>
                    </tr>
                    <tr>
                        <td> Discount : </td>
                        <td class="text-right">{{ $invoice->discount }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="row ">
            <div class="col-md-5 col-md-offset-7 ">
                <table class="table">
                    <tr class="custom-font-me">
                        <td> <b> Grand Total : </b>  </td>
                        <td class="text-right">  <b>{{ $invoice->amount }}</b> </td>
                    </tr>
                    
                </table>
            </div>
        </div>

        {{--<a href="{{ route('sale.print',[$id]) }}" class="btn btn-primary">Print</a>--}}

    </div>
</div>

@endsection


@section('scripts')

<script type="text/javascript">
</script>

@endsection