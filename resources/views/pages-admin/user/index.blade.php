@extends('layout.admin')
@section('title','Admin | Profile Create')
@section('styles')

<style>
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

<div class="card">
    <div class="card-header">
	    <h2>User List</h2>
    </div>
     <table id="example" class="display" cellspacing="0" width="100%">
     <thead>
		<tr>
	    	<th>Name</th>
	    	<th>Email</th>
	    	<th>Employee ID</th>
	    	<th>Role</th>
	    	<th>Action</th>
	  	</tr>
	 </thead>
	 <tbody>
	  	@foreach($users as $user)
	  	<tr>
	   		<td>{{ $user->name }}</td>
	   		<td>{{ $user->email }}</td>
	   		<td>{{ $user->profile_id }}</td>
	   		<td>{{ $user->role }}</td>
	   		<td>
	   			
	   			<a href="{{ route('user.edit',[$user->id]) }}"><i class="fa fa-pencil custom-font" aria-hidden="true"></i></a>
                <a href="{{ route('user.destroy',[$user->id]) }}" data-method="delete" 
                            data-token="{{ csrf_token() }}" data-confirm="Are you sure?"><i class="fa fa-trash-o text-danger custom-font" aria-hidden="true"></i></a>
	   		</td>
	  	</tr>
	  	@endforeach
	  	</tbody>
	  
	</table>
	
</div>


<div id="editDesignation" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<form role="form" method="post" action="" class="remove-margin-p edit-user-form">

				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Modal Header</h4>
				</div>
				<div class="modal-body">
					<input type="hidden" name="_method" value="PUT">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="form-group ">
						<div class="fg-line">
							<label for="designation_name">Designation Name</label>
							<input type="text" class="form-control input-sm" id="edit_des_name"
								   name="designation_name" >
						</div>
						@if ($errors->has('designation_name'))
							<p class="text-right text-danger">{{$errors->first('designation_name')}}</p>
						@endif
					</div>
					<div class="form-group ">
						<div class="fg-line">
							<label for="designation_short_name">Designation Short Name</label>

							<input type="text" class="form-control input-sm" id="edit_des_short_name"
								   name="designation_short_name" >
						</div>
						@if ($errors->has('designation_short_name'))
							<p class="text-right text-danger">{{$errors->first('designation_short_name')}}</p>
						@endif
					</div>
					<div class="form-group">
						<div class="fg-line">
							<div class="select">
								<h4>Designation Status</h4>
								<select class="form-control" name="designation_status" id="edit_status">
									<option></option>
									<option value="1">Active</option>
									<option value="2">Deactive</option>
								</select>

							</div>
						</div>
						@if ($errors->has('designation_status'))
							<p class="text-right text-danger">{{$errors->first('designation_status')}}</p>
						@endif
					</div>


				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success btn-sm m-t-10">Submit</button>
					<button type="button" class="btn btn-primary btn-sm m-t-10" data-dismiss="modal">Close</button>

				</div>
			</form>
		</div>
	</div>
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

$( ".edit" ).click(function( event ) {

    var id = $(this).data('id');
    //alert(id);
    var update_url = location.origin + "/user/" + id;
    var url = location.origin + '/user/' + id + '/edit';
    $('.edit-user-form').attr('action', update_url);
    $.get(url, function (data) {
        $('#edit_des_name').val(data['designation_name']);
        $('#edit_des_short_name').val(data['designation_short_name']);
        //$('#edit_image').attr('src',location.origin + '/storage/category/' + data['image']);

        $('select#edit_status option').each(function () {
            if ($(this).val() == data['designation_status']) {
                this.selected = true;
                return;
            } });
    });
});

</script>

@endsection