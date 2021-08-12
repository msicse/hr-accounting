@extends('layout.admin')
@section('title','Accounts | Manage Services')

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
        <h3>Manage Services</h3>
    </div>
    <div class="row">
        <div class="col-md-2 col-md-offset-10">
            <button class="btn btn-primary  p-10" data-toggle="modal" data-target="#productAdd">Add Service</button>
        </div>
    </div>

    <table id="example" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>#</th>
                <th data-column-id="id" data-type="numeric">Code</th>
                <th data-column-id="name">Name</th>
                <th data-column-id="category">Category</th>
                <th data-column-id="category">Price</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 0; ?>
            @foreach($products as $product)
            <?php $i++ ; ?>
            <tr>
                <td>{{ $i }}</td>
                <td>{{ $product->product_code }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->cat_name }}</td>
                <td>{{ $product->price }}</td>
                
                <td>
                    <a type="button" data-toggle="modal" data-edit-service-id="{{ $product->id }}" data-target="#productEdit" class="btn btn-icon command-edit waves-effect waves-circle edit_product">
                        <span class="zmdi zmdi-edit"></span>
                    </a>
                    <a class="btn btn-icon command-edit waves-effect waves-circle text-danger  delete_product"  data-toggle="modal" data-target="#productDelete" data-product-id="{{ $product->id }}">
                        <span class="zmdi zmdi-delete"></span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Add Product -->

<div class="modal fade" id="productAdd" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="POST" action="{{ route('services.store') }}" class="remove-margin-p" >
                {{ csrf_field() }}
                <div class="modal-header">
                    <h3 class="modal-title">Accounting & Bookkeeping </h3>
                </div>
                <div class="modal-body">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3>Add Product</h3>
                        </div>
                        <div class="panel-body">

                            

                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="title">Code</label>
                                    <input type="text" class="form-control" name="product_code" readonly value="<?php echo substr(md5(rand(100000000, 200000000)), 0, 10); ?>" />
                                </div> 
                            </div>
                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="title">Product Name</label>
                                    <input type="text" class="form-control input-sm" id="name" name="name" placeholder="name" value="" />
                                </div>
                                    @if ($errors->has('name'))
                                        <p class="text-right text-danger">{{$errors->first('name')}}</p>
                                    @endif
                            </div>
                            <div class="form-group">
                                <div class="fg-line">
                                    <div class="select">
                                        <h4>Product Category</h4>
                                        <select class="form-control" name="category_id">
                                            <option></option>
                                            @foreach( $categories as $category )
                                            <option value="{{ $category->id }}" {{ Input::old('category_id') == $category->id ? 'selected' : '' }} > {{ $category->cat_name }} </option>
                                            @endforeach
                                                     
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="price">Unit Price</label>
                                    <input type="number" class="form-control input-sm" id="price" name="price" placeholder="price" value="" />
                                </div>
                                    @if ($errors->has('price'))
                                        <p class="text-right text-danger">{{$errors->first('price')}}</p>
                                    @endif
                            </div>
                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="notes">Notes</label>
                                    <textarea class="form-control" rows="5" placeholder="notes......" name="notes" id="notes">{{ Input::old('notes') }}</textarea>
                                </div>
                                @if ($errors->has('notes'))
                                 <p class="text-right text-danger">{{$errors->first('notes')}}</p>
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
<div class="modal fade" id="productEdit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="POST" action="" class="remove-margin-p edit_product_form" >
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    
                <div class="modal-header">
                    <h3 class="modal-title">Accounting & Bookkeeping </h3>
                </div>
                <div class="modal-body">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3>Edit Product</h3>
                        </div>
                        <div class="panel-body">

                            

                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="title">Code</label>
                                    <input type="text" class="form-control" name="product_code" id="product-code" readonly value="" />
                                </div> 
                            </div>
                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="title">Product Name</label>
                                    <input type="text" class="form-control input-sm" id="edit-name" name="name" placeholder="name" value="" />
                                </div>
                                    @if ($errors->has('name'))
                                        <p class="text-right text-danger">{{$errors->first('name')}}</p>
                                    @endif
                            </div>
                            <div class="form-group">
                                <div class="fg-line">
                                    <div class="select">
                                        <h4>Product Category</h4>
                                        <select class="form-control" name="category_id" id="edit_category_list">
                                            <option></option>
                                            @foreach( $categories as $category )
                                            <option value="{{ $category->id }}"> {{ $category->cat_name }} </option>
                                            @endforeach
                                                     
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="price">Unit Price</label>
                                    <input type="number" class="form-control input-sm" id="edit-price" name="price" placeholder="price" value="" />
                                </div>
                                    @if ($errors->has('price'))
                                        <p class="text-right text-danger">{{$errors->first('price')}}</p>
                                    @endif
                            </div>
                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="notes">Notes</label>
                                    <textarea class="form-control" rows="5" placeholder="notes......" name="enotes" id="edit-notes">{{ Input::old('notes') }}</textarea>
                                </div>
                                @if ($errors->has('notes'))
                                 <p class="text-right text-danger">{{$errors->first('notes')}}</p>
                                @endif
                            </div>


                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"> Update changes</button>
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Delete product -->

<div class="modal fade" id="productDelete" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" class="delete_product_form" method="post">
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


                $( ".edit_product" ).click(function() {

                    var account_id=$(this).data('edit-service-id');

                    var update_url=location.origin+'/services/'+account_id;

                    var url=location.origin+'/services/'+account_id+'/edit';
					//alert(url);

                    $('.edit_product_form').attr('action',update_url);
                            
                        $.get(url,function(data){
                            $('#edit-name').val(data['name']);
                            $('#edit-price').val(data['price']);
                            $('#edit-notes').val(data['notes']);
                            $('#product-code').val(data['product_code']);
                            
                            var value = data['category_id'];
                            $( "#edit_category_list > option" ).each(function() {
                                if( parseInt($(this).val()) === parseInt(value) )
                                    {
                                      $(this).attr('selected', true);
                                    }
                            });
                            
                        });
                            
                });

                $( ".delete_product" ).click(function() {

                    var account_id=$(this).data('product-id');
                    var url=location.origin+'/services/'+account_id;
                    $('.delete_product_form').attr('action',url);

                });



                            $('#example').DataTable();                        
            });


   $('#example')
    .removeClass( 'display' )
    .addClass('table table-striped table-bordered');
        </script>
@endsection