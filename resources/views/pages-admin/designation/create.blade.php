@extends('layout.admin')
@section('title','Admin | Designation Create')
@section('contentBody')
	<div class="card">
        <div class="card-header">
            <h2>Designation Create</h2><a class="btn btn-primary pull-right" href="{{url('designaion')}}">Designation List</a>
        </div>
        <div class="card-body card-padding">
            <form role="form" method="post" action="{{ action("DesignationController@store") }}" class="remove-margin-p">
            {{ csrf_field() }}
                <div class="form-group ">
                    <div class="fg-line">
                        <label for="designation_name">Designation Name</label>
                        <input type="text" class="form-control input-sm" id="designation_name"
                                               name="designation_name" placeholder="Enter designation_name">
                    </div>
                    @if ($errors->has('designation_name'))
                        <p class="text-right text-danger">{{$errors->first('designation_name')}}</p>
                    @endif
                </div>
                <div class="form-group ">
                    <div class="fg-line">
                    <label for="designation_short_name">Designation Short Name</label>

                    <input type="text" class="form-control input-sm" id="designation_short_name"
                                           name="designation_short_name" placeholder="designation_short_name">
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
                                <option value="0">DeActive</option>
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