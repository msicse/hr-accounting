@extends('layout.admin')
@section('contentBody')
	<div class="card">
        <div class="card-header">
            <h2>Employee List</h2>
        </div>

        <div class="card-body card-padding">
            <form role="form" method="post" action="{{url('designaion',$designation_edit->id)}}" class="remove-margin-p">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group ">
                    <div class="fg-line">
                        <label for="designation_name">Designation Name</label>
                        <input type="text" class="form-control input-sm" id="designation_name"
                                               name="designation_name" placeholder="Enter designation_name" value="{{ $designation_edit->designation_name }}">
                    </div>
                    @if ($errors->has('designation_name'))
                        <p class="text-right text-danger">{{$errors->first('designation_name')}}</p>
                    @endif
                </div>
                <div class="form-group ">
                    <div class="fg-line">
                    <label for="designation_short_name">Designation Short Name</label>

                    <input type="text" class="form-control input-sm" id="designation_short_name"
                                           name="designation_short_name" placeholder="designation_short_name" value="{{$designation_edit->designation_short_name }}">
                    </div>
                    @if ($errors->has('designation_short_name'))
                     <p class="text-right text-danger">{{$errors->first('designation_short_name')}}</p>
                    @endif
                </div>
                <div class="form-group">
                    <div class="fg-line">
                        <div class="select">
                        Designation Status
                            <select class="form-control" name="designation_status">
                                <option value="1" 
                                    <?php if ($designation_edit->designation_status == 1 ): ?> selected <?php endif ?> >Active</option>
                                    <option value="0"
                                    <?php if ($designation_edit->designation_status == 0 ): ?> selected <?php endif ?>>DeActive</option>
                            </select>
                    
                        </div>
                    </div>
                    @if ($errors->has('designation_status'))
                     <p class="text-right text-danger">{{$errors->first('designation_status')}}</p>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary btn-sm m-t-10">Submit</button>
            </form>
         </div>
    </div>

@endsection