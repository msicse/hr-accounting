@extends('layout.admin')

@section('title','Admin | Designation')
@section('contentBody')
	<div class="card">
        <div class="card-header">
            <h2>Designation </h2><button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal">Add Designation</button>
        </div>
		<div class="card-body table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Designation Name</th>
                        <th>Designation Name Short </th>
                        <th>Status</th>
                        <th>Action</th>
                        
                    </tr>
                </thead>
                <tbody>
                <?php $i =0 ?>
                @foreach( $designation_list as $data )
                    <?php $i++ ?>
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $data->designation_name }}</td>
                        <td>{{ $data->designation_short_name }}</td>
                        <td>
                            @if( $data->designation_status == 1 )
                                Active
                            @else
                                Deactive
                            @endif
                        </td>
                        <td> 
                            <button data-toggle="modal" data-target="#editDesignation" data-id="{{ $data->id }}" type="button" class="btn btn-primary edit"><i class="fa fa-pencil custom-font" aria-hidden="true"></i></button>
                            
                            <a href="{{ url('designaion',$data->id) }}" data-method="delete" 
                            data-token="{{ csrf_token() }}" data-confirm="Are you sure?" class="btn btn-danger"><i class="fa fa-trash-o  custom-font" aria-hidden="true"></i></a>
                            
                        </td> 
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    
    
    <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
             <form role="form" method="post" action="{{ action("DesignationController@store") }}" class="remove-margin-p">
                
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modal Header</h4>
          </div>
          <div class="modal-body">
             {{ csrf_field() }}
                    <div class="form-group ">
                        <div class="fg-line">
                            <label for="designation_name">Designation Name</label>
                            <input type="text" class="form-control input-sm" id="designation_name"
                                                   name="designation_name" >
                        </div>
                        @if ($errors->has('designation_name'))
                            <p class="text-right text-danger">{{$errors->first('designation_name')}}</p>
                        @endif
                    </div>
                    <div class="form-group ">
                        <div class="fg-line">
                        <label for="designation_short_name">Designation Short Name</label>
    
                        <input type="text" class="form-control input-sm" id="designation_short_name"
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
                                <select class="form-control" name="designation_status">
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
<div id="editDesignation" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
             <form role="form" method="post" action="" class="remove-margin-p edit-category-form">
                
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

    <script type="text/javascript">
        $( ".edit" ).click(function( event ) {
            
            var id = $(this).data('id');
            //alert(id);
            var update_url = location.origin + "/designaion/" + id;
            var url = location.origin + '/designaion/' + id + '/edit';
            $('.edit-category-form').attr('action', update_url);
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