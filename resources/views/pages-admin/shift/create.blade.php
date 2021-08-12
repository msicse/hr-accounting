@extends('layout.admin')
@section('title','Admin | Shift Create')
@section('contentBody')
    <div class="card">
        <div class="card-header">
            <h2>Create Shift</h2> <a class="btn btn-primary pull-right" href="{{url('shift')}}"> Shift list </a>
        </div>
        <div class="card-body card-padding">
            <form role="form" method="post" action="{{ action("ShiftController@store") }}" class="remove-margin-p">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-6">
                        <p class="c-black f-500 m-b-20"> Start Time</p>
                            <div class="input-group form-group">
                                <span class="input-group-addon"><i class="zmdi zmdi-time"></i></span>
                                <div class="dtp-container">
                                    <input name="start" type='text' class="form-control time-picker"
                                                   placeholder="Click here...">
                                </div>
                            </div>
                    </div>
                    <div class="col-sm-6">
                        <p class="c-black f-500 m-b-20"> End Time</p>
                            <div class="input-group form-group">
                                <span class="input-group-addon"><i class="zmdi zmdi-time"></i></span>
                                <div class="dtp-container">
                                    <input type='text' name="end" class="form-control time-picker"
                                                   placeholder="Click here...">
                                </div>
                            </div>
                    </div>
                </div>
                
                    @if ($errors->has('designation_status'))
                     <p class="text-right text-danger">{{$errors->first('designation_status')}}</p>
                    @endif
                      
                    <button type="submit" class="btn btn-primary btn-sm m-t-10 ">Submit</button>
                 </div>
            </form>
    </div>

@endsection