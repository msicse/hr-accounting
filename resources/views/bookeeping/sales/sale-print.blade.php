
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title> Purchases Invoice</title>
	<style>
		.con{ margin: 0 auto; padding-right: 20px ;}
        .code { float:right;  text-align: right;  padding-right: 20px; width: 450px; display: block; }
		.code1 { float:left; overflow: hidden;  padding-right: 20px; width: 450px;display: block; }
		.product-info { height: 200px; }
		.send-area { height: 200px; }
		.from {float: left; overflow: hidden; width: 450px; display: block;}
		.to { float:right; text-align: right; width: 450px; display: block; }
        .border { border-bottom: 2px #eee solid; }
        .table { width: 100%; }
        .purchase-item { overflow: hidden; padding-bottom: 20px;display: block;  }
        .sub-total-cal { height: 100px; }
        .code2 { text-align: left; width: 70%; float: left;}
        .code3 { text-align: right; width: 30%; float: right; }
        .code4 { text-align: left; width: 60%; float: left;}
        .code5 { text-align: right; width: 40%; float: right; }
        .text-right { text-align: right; }
	</style>
</head>
<body>
	<div class="con">
		<div class="product-info border">
			<div class="code1"></div>
            <div class="code">
				 <h4> Sale Code : {{ $invoice->sale_code }} </h4> 
	                <p> Creation Date : {{ $invoice->due_date }}</p>
	                <p>Account : {{ $invoice->title }} </p>
			</div>
		</div>
		<div class="send-area border">
			<div class="from">
				<h4 >Form</h4>
                <h2>Accounting & Bookkeeping</h2>
			</div>
			<div class="to">
				<h4> To </h4>

                <h2>{{ $invoice->first_name }} {{ $invoice->last_name }}</h2> 
                <address>
                    {{ $invoice->address }} <br>
                    {{ $invoice->phone }} <br>
                    {{ $invoice->email }}
                </address>
			</div>
		</div>
        <div class="purchase-item border">
               <h4>Sale Items</h4>
                
                <table class="table table-bordered" border="1" cellpadding="5">
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
        <div class="sub-total-cal border">
            <div class="code2"></div>
            <div class="code3" >
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
        <div class="grand-total-area ">
            <div class="code4"></div>
            <div class="code5 ">
                <table class="table">
                    <tr class="custom-font-me">
                        <td class="text-right"> <b> Grand Total : </b>  </td>
                        <td class="text-right">  <b>{{ $invoice->amount }}</b> </td>
                    </tr>
                    
                </table>
            </div>
        </div>
    </div>
</body>
</html>
