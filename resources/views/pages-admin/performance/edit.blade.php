@extends('layout.admin')
@section('title','Admin | Performance Edit')
@section('contentBody')
	<div class="card">
        <div class="card-header">
            <h2>Add Performance Record</h2>
        </div>
        <div class="card-body card-padding">
            <form role="form" method="post" action="{{ url('performance',$performance->id) }}" class="remove-margin-p">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group ">
                    <div class="fg-line">
                        <label for="name">Name</label>
                        <input type="text" class="form-control input-sm" id="name"
                                               name="name"  placeholder="Enter name" value="{{ empty(Input::old('name')) ? $performance->name : Input::old('name') }}">
                    </div>
                    @if ($errors->has('name'))
                        <p class="text-right text-danger">{{$errors->first('name')}}</p>
                    @endif
                </div>
                <div class="row">
                    <div class="col-sm-4">
                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="month">Month</label>
                                    <input type="text" class="form-control input-sm" id="month"
                                           name="month" placeholder="month" value="{{ empty(Input::old('month')) ? $performance->month : Input::old('quantity') }}" >
                                </div>
                                @if ($errors->has('month'))
                                 <p class="text-right text-danger">{{$errors->first('month')}}</p>
                                @endif
                            </div>
                    </div>
                    <div class="col-sm-4">
                            <h4>Start Date</h4>
                                <div class="input-group form-group">
                                        <div class="dtp-container">
                                            <input type='text' class="form-control date-picker" placeholder="Click here..." id="start_date" name="start_date" value="{{ empty(Input::old('start_date')) ? $performance->start_date : Input::old('start_date') }}" />
                                        </div>
                                @if ($errors->has('start_date'))
                                 <p class="text-right text-danger">{{$errors->first('start_date')}}</p>
                                @endif
                                </div>
                        </div>
                        <div class="col-sm-4">
                            <h4> End Date </h4>
                                <div class="input-group form-group">
                                        <div class="dtp-container">
                                            <input type='text' class="form-control date-picker" placeholder="Click here..." id="end_date" name="end_date" value="{{ empty(Input::old('end_date')) ? $performance->end_date : Input::old('end_date') }}"/>
                                        </div>
                                @if ($errors->has('end_date'))
                                 <p class="text-right text-danger">{{$errors->first('end_date')}}</p>
                                @endif
                                </div>
                        </div>
                </div>
                <div class="form-group ">
                    <div class="fg-line">
                        <label for="working_report">Working Report</label>
                            <textarea class="form-control" rows="5" placeholder="working_report......" name="working_report" id="contact_address">{{ empty(Input::old('working_report')) ? $performance->working_report : Input::old('working_report') }}</textarea>
                                </div>
                                @if ($errors->has('working_report'))
                                 <p class="text-right text-danger">{{$errors->first('working_report')}}</p>
                                @endif
                </div>
                <div class="form-group ">
                    <div class="fg-line">
                        <label for="achivement">Achivement</label>
                            <textarea class="form-control" rows="5" placeholder="achivement......" name="achivement" id="achivement">{{ empty(Input::old('achivement')) ? $performance->achivement : Input::old('achivement') }}</textarea>
                                </div>
                                @if ($errors->has('achivement'))
                                 <p class="text-right text-danger">{{$errors->first('achivement')}}</p>
                                @endif
                </div>
                <div class="form-group ">
                    <div class="fg-line">
                        <label for="goal">Goal</label>
                        <input type="text" class="form-control input-sm" id="goal"
                                           name="goal" placeholder="goal......." value="{{ empty(Input::old('goal')) ? $performance->goal : Input::old('goal') }}">
                    </div>
                    @if ($errors->has('goal'))
                        <p class="text-right text-danger">{{$errors->first('goal')}}</p>
                    @endif
                </div>
                <div class="form-group ">
                    <div class="fg-line">
                        <label for="goal_report">Goal Report</label>
                        <textarea class="form-control" rows="5" placeholder="goal_report......" name="goal_report" id="goal_report">{{ empty(Input::old('goal_report')) ? $performance->goal_report : Input::old('goal_report') }}</textarea>
                    </div>
                    @if ($errors->has('goal_report'))
                        <p class="text-right text-danger">{{$errors->first('goal_report')}}</p>
                    @endif
                </div>
                <div class="form-group ">
                    <div class="fg-line">
                        <label for="target">Target</label>
                        <input type="text" class="form-control input-sm" id="target"
                                           name="target" placeholder="target......." value="{{ empty(Input::old('target')) ? $performance->target : Input::old('target') }}" >
                    </div>
                    @if ($errors->has('target'))
                        <p class="text-right text-danger">{{$errors->first('target')}}</p>
                    @endif
                </div>
                <div class="form-group ">
                    <div class="fg-line">
                        <label for="present">Present</label>
                        <input type="text" class="form-control input-sm" id="present"
                                           name="present" placeholder="present......." value="{{ empty(Input::old('present')) ? $performance->present : Input::old('present') }}">
                    </div>
                    @if ($errors->has('present'))
                        <p class="text-right text-danger">{{ $errors->first('present') }}</p>
                    @endif
                </div>
                <div class="form-group ">
                    <div class="fg-line">
                        <label for="absent">Absent</label>
                        <input type="text" class="form-control input-sm" id="absent"
                                           name="absent" placeholder="absent......." value="{{ empty(Input::old('absent')) ? $performance->absent : Input::old('absent') }}">
                    </div>
                    @if ($errors->has('absent'))
                        <p class="text-right text-danger">{{$errors->first('absent')}}</p>
                    @endif
                </div>
                <div class="form-group ">
                    <div class="fg-line">
                        <label for="leave">leave</label>
                        <input type="text" class="form-control input-sm" id="leave"
                                           name="leave" placeholder="leave......." value="{{ empty(Input::old('leave')) ? $performance->leave : Input::old('leave') }}">
                    </div>
                    @if ($errors->has('leave'))
                        <p class="text-right text-danger">{{$errors->first('leave')}}</p>
                    @endif
                </div>
                <div class="form-group ">
                    <div class="fg-line">
                        <label for="payment">Payment</label>
                        <input type="text" class="form-control input-sm" id="payment"
                                           name="payment" placeholder="payment......." value="{{ empty(Input::old('payment')) ? $performance->payment : Input::old('payment') }}">
                    </div>
                    @if ($errors->has('payment'))
                        <p class="text-right text-danger">{{ $errors->first('payment') }}</p>
                    @endif
                </div>
                <div class="form-group ">
                    <div class="fg-line">
                        <label for="bonus">Bonus</label>
                        <input type="text" class="form-control input-sm" id="bonus"
                                           name="bonus" placeholder="bonus......." value="{{ empty(Input::old('bonus')) ? $performance->bonus : Input::old('bonus') }}">
                    </div>
                    @if ($errors->has('bonus'))
                        <p class="text-right text-danger">{{$errors->first('bonus')}}</p>
                    @endif
                </div>
                <div class="form-group ">
                    <div class="fg-line">
                        <label for="overtime">Overtime</label>
                        <input type="text" class="form-control input-sm" id="overtime"
                                           name="overtime" placeholder="overtime......." value="{{ empty(Input::old('overtime')) ? $performance->overtime : Input::old('overtime') }}">
                    </div>
                    @if ($errors->has('overtime'))
                        <p class="text-right text-danger">{{$errors->first('overtime')}}</p>
                    @endif
                </div>
                <div class="form-group ">
                    <div class="fg-line">
                        <label for="due_work_time">Due Work Time</label>
                        <input type="text" class="form-control input-sm" id="due_work_time"
                                           name="due_work_time" placeholder="due_work_time......." value="{{ empty(Input::old('due_work_time')) ? $performance->due_work_time : Input::old('due_work_time') }}">
                    </div>
                    @if ($errors->has('due_work_time'))
                        <p class="text-right text-danger">{{$errors->first('due_work_time')}}</p>
                    @endif
                </div>
                <div class="form-group ">
                    <div class="fg-line">
                        <label for="gap_time">Tap Time</label>
                        <input type="text" class="form-control input-sm" id="gap_time"
                                           name="gap_time" placeholder="gap_time......." value="{{ empty(Input::old('gap_time')) ? $performance->gap_time : Input::old('gap_time') }}">
                    </div>
                    @if ($errors->has('gap_time'))
                        <p class="text-right text-danger">{{$errors->first('gap_time')}}</p>
                    @endif
                </div>
                <div class="form-group ">
                    <div class="fg-line">
                        <label for="complain">Complain</label>
                        <textarea class="form-control" rows="5" placeholder="complain......" name="complain" id="complain">{{ empty(Input::old('complain')) ? $performance->complain : Input::old('complain') }}</textarea>
                    </div>
                    @if ($errors->has('complain'))
                        <p class="text-right text-danger">{{$errors->first('complain')}}</p>
                    @endif
                </div>
                <div class="form-group ">
                    <div class="fg-line">
                        <label for="remark">Remark</label>
                        <textarea class="form-control" rows="5" placeholder="remark......" name="remark" id="remark">{{ empty(Input::old('remark')) ? $performance->remark : Input::old('remark') }}</textarea>
                    </div>
                    @if ($errors->has('remark'))
                        <p class="text-right text-danger">{{$errors->first('remark')}}</p>
                    @endif
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-sm m-t-10 ">Update</button> 
                </div>
            </form>
        </div>
    </div>

@endsection