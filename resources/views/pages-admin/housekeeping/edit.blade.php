@extends('layout.admin')
@section('title','Admin | Housekeeping Edit')

@section('styles')
	<style type="text/css">
		* {
	  		.border-radius(0) !important;
		}

		#field {
		    margin-bottom:20px;
		}
	</style>
@endsection

@section('contentBody')
	<div class="card">
        <div class="card-header">
            <h2>HouseKeeping Edit</h2>
        </div>
        <div class="card-body card-padding">
			<form action="{{ url('housekeeping',$fixedasset->id) }}" method="post">
			<input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

				<table class="table table-bordered table-hover" id="tab_logic">
					<thead>
						<tr >
							<th class="text-center">
								Name
							</th>
							<th class="text-center">
								Quantity
							</th>
							<th class="text-center">
								Description
							</th>
						</tr>
					</thead>
					
					<tbody>
					
						<tr id='addr0'>
							<td>
							<input type="text" value="{{ is_null(Input::old('name')) ? $fixedasset->name : Input::old('name') }}" name='name'  placeholder='Name' class="form-control"/>
							@if ($errors->has('name'))
		                        <p class="text-right text-danger">{{$errors->first('name')}}</p>
		                    @endif
							</td>
							<td>
							<input type="text" name='quantity' value="{{ empty(Input::old('quantity')) ? $fixedasset->quantity : Input::old('quantity') }}" placeholder='Quantity' class="form-control"/>
							@if ($errors->has('quantity'))
		                        <p class="text-right text-danger">{{$errors->first('quantity')}}</p>
		                    @endif
							</td>
							<td>
		                            <textarea class="form-control" rows="2" placeholder="description......" name="description" id="description" >{{ empty(Input::old('description')) ? $fixedasset->description : Input::old('description') }}</textarea>
		                            @if ($errors->has('description'))
				                        <p class="text-right text-danger">{{$errors->first('description')}}</p>
				                    @endif
							</td>
						</tr>
	                    <tr id='addr1'></tr>
					</tbody>
					<tfoot>
						<tr >
							<td colspan="3" class="text-center">
								<button type="submit" class=" text-center btn btn-primary btn-sm center-block">Update Housekeeping</button>
							</td>
						</tr>
						
					</tfoot>
					<!-- <a id="add_row" class="btn btn-default pull-left">Add Row</a><a id='delete_row' class="pull-right btn btn-default">Delete Row</a> -->
				</table>
							
				</div>	
			</form>
		</div>
	</div>
	
</div>
</div>

@endsection

@section('scripts')
<script>
	// $(document).ready(function(){
 //    var next = 1;
 //    $(".add-more").click(function(e){
 //        e.preventDefault();
 //        var addto = "#field" + next;
 //        var addRemove = "#field" + (next);
 //        next = next + 1;
 //        var newIn = '<input autocomplete="off" class="input form-control" id="field' + next + '" name="field' + next + '" type="text">';
 //        var newInput = $(newIn);
 //        var removeBtn = '<button id="remove' + (next - 1) + '" class="btn btn-danger remove-me" >-</button></div><div id="field">';
 //        var removeButton = $(removeBtn);
 //        $(addto).after(newInput);
 //        $(addRemove).after(removeButton);
 //        $("#field" + next).attr('data-source',$(addto).attr('data-source'));
 //        $("#count").val(next);  
        
 //            $('.remove-me').click(function(e){
 //                e.preventDefault();
 //                var fieldNum = this.id.charAt(this.id.length-1);
 //                var fieldID = "#field" + fieldNum;
 //                $(this).remove();
 //                $(fieldID).remove();
 //            });
 //    });
    

    
	// });
// 	     $(document).ready(function(){
//       var i=1;
//      $("#add_row").click(function(){
//       $('#addr'+i).html("<td>"+ (i+1) +"</td><td><input name='name' type='text' placeholder='Name' class='form-control input-md'  /> </td><td><input  name='mail' type='text' placeholder='Mail'  class='form-control input-md'></td><td><input  name='mobile' type='text' placeholder='Mobile'  class='form-control input-md'></td>");

//       $('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
//       i++; 
//   });
//      $("#delete_row").click(function(){
//     	 if(i>1){
// 		 $("#addr"+(i-1)).html('');
// 		 i--;
// 		 }
// 	 });

// });
     $(document).ready(function(){
      var i=1;
     $("#add_row").click(function(){
      $('#addr'+i).html("<td>"+ (i+1) +"</td><td><input name='name' type='text' placeholder='Name' class='form-control input-md'  /> </td><td><input  name='quantity' type='text' placeholder='Mail'  class='form-control input-md'></td><td><input  name='description' type='text' placeholder='Mobile'  class='form-control input-md'></td>");

      $('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
      i++; 
  });
     $("#delete_row").click(function(){
    	 if(i>1){
		 $("#addr"+(i-1)).html('');
		 i--;
		 }
	 });

});

</script>
@endsection