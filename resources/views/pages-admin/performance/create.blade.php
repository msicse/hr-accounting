@extends('layout.admin')
@section('title','Admin | Performance')
@section('contentBody')
	<div class="card">
        <div class="card-header">
            <h2>Add Performance Record</h2>
        </div>
        <div class="card-body card-padding">
            <form role="form" method="post" action="{{ action("PerformanceController@store") }}" class="remove-margin-p">
                {{ csrf_field() }}
                <div class="form-group ">
                    <div class="fg-line">
                        <label for="name">Name</label>
                        <input type="text" class="form-control input-sm" id="name"
                                               name="name"  value="" placeholder="Enter name">
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
                                           name="month" placeholder="month">
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
                                            <input type='text' class="form-control date-picker" placeholder="Click here..." id="start_date" name="start_date"/>
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
                                            <input type='text' class="form-control date-picker" placeholder="Click here..." id="end_date" name="end_date"/>
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
                            <textarea class="form-control" rows="5" placeholder="working_report......" name="working_report" id="contact_address"></textarea>
                                </div>
                                @if ($errors->has('working_report'))
                                 <p class="text-right text-danger">{{$errors->first('working_report')}}</p>
                                @endif
                </div>
                <div class="form-group ">
                    <div class="fg-line">
                        <label for="achivement">Achivement</label>
                            <textarea class="form-control" rows="5" placeholder="achivement......" name="achivement" id="achivement"></textarea>
                                </div>
                                @if ($errors->has('achivement'))
                                 <p class="text-right text-danger">{{$errors->first('achivement')}}</p>
                                @endif
                </div>
                <div class="form-group ">
                    <div class="fg-line">
                        <label for="goal">Goal</label>
                        <input type="text" class="form-control input-sm" id="goal"
                                           name="goal" placeholder="goal.......">
                    </div>
                    @if ($errors->has('goal'))
                        <p class="text-right text-danger">{{$errors->first('goal')}}</p>
                    @endif
                </div>
                <div class="form-group ">
                    <div class="fg-line">
                        <label for="goal_report">Goal Report</label>
                        <textarea class="form-control" rows="5" placeholder="goal_report......" name="goal_report" id="goal_report"></textarea>
                    </div>
                    @if ($errors->has('goal_report'))
                        <p class="text-right text-danger">{{$errors->first('goal_report')}}</p>
                    @endif
                </div>
                <div class="form-group ">
                    <div class="fg-line">
                        <label for="target">Target</label>
                        <input type="text" class="form-control input-sm" id="target"
                                           name="target" placeholder="target.......">
                    </div>
                    @if ($errors->has('target'))
                        <p class="text-right text-danger">{{$errors->first('target')}}</p>
                    @endif
                </div>
                <div class="form-group ">
                    <div class="fg-line">
                        <label for="present">Present</label>
                        <input type="text" class="form-control input-sm" id="present"
                                           name="present" placeholder="present.......">
                    </div>
                    @if ($errors->has('present'))
                        <p class="text-right text-danger">{{$errors->first('present')}}</p>
                    @endif
                </div>
                <div class="form-group ">
                    <div class="fg-line">
                        <label for="absent">Absent</label>
                        <input type="text" class="form-control input-sm" id="absent"
                                           name="absent" placeholder="absent.......">
                    </div>
                    @if ($errors->has('absent'))
                        <p class="text-right text-danger">{{$errors->first('absent')}}</p>
                    @endif
                </div>
                <div class="form-group ">
                    <div class="fg-line">
                        <label for="leave">leave</label>
                        <input type="text" class="form-control input-sm" id="leave"
                                           name="leave" placeholder="leave.......">
                    </div>
                    @if ($errors->has('leave'))
                        <p class="text-right text-danger">{{$errors->first('leave')}}</p>
                    @endif
                </div>
                <div class="form-group ">
                    <div class="fg-line">
                        <label for="payment">Payment</label>
                        <input type="text" class="form-control input-sm" id="payment"
                                           name="payment" placeholder="payment.......">
                    </div>
                    @if ($errors->has('payment'))
                        <p class="text-right text-danger">{{$errors->first('payment')}}</p>
                    @endif
                </div>
                <div class="form-group ">
                    <div class="fg-line">
                        <label for="bonus">Bonus</label>
                        <input type="text" class="form-control input-sm" id="bonus"
                                           name="bonus" placeholder="bonus.......">
                    </div>
                    @if ($errors->has('bonus'))
                        <p class="text-right text-danger">{{$errors->first('bonus')}}</p>
                    @endif
                </div>
                <div class="form-group ">
                    <div class="fg-line">
                        <label for="overtime">Overtime</label>
                        <input type="text" class="form-control input-sm" id="overtime"
                                           name="overtime" placeholder="overtime.......">
                    </div>
                    @if ($errors->has('overtime'))
                        <p class="text-right text-danger">{{$errors->first('overtime')}}</p>
                    @endif
                </div>
                <div class="form-group ">
                    <div class="fg-line">
                        <label for="due_work_time">Due Work Time</label>
                        <input type="text" class="form-control input-sm" id="due_work_time"
                                           name="due_work_time" placeholder="due_work_time.......">
                    </div>
                    @if ($errors->has('due_work_time'))
                        <p class="text-right text-danger">{{$errors->first('due_work_time')}}</p>
                    @endif
                </div>
                <div class="form-group ">
                    <div class="fg-line">
                        <label for="gap_time">gap_time</label>
                        <input type="text" class="form-control input-sm" id="gap_time"
                                           name="gap_time" placeholder="gap_time.......">
                    </div>
                    @if ($errors->has('gap_time'))
                        <p class="text-right text-danger">{{$errors->first('gap_time')}}</p>
                    @endif
                </div>
                <div class="form-group ">
                    <div class="fg-line">
                        <label for="complain">Complain</label>
                        <textarea class="form-control" rows="5" placeholder="complain......" name="complain" id="complain"></textarea>
                    </div>
                    @if ($errors->has('complain'))
                        <p class="text-right text-danger">{{$errors->first('complain')}}</p>
                    @endif
                </div>
                <div class="form-group ">
                    <div class="fg-line">
                        <label for="remark">Remark</label>
                        <textarea class="form-control" rows="5" placeholder="remark......" name="remark" id="remark"></textarea>
                    </div>
                    @if ($errors->has('remark'))
                        <p class="text-right text-danger">{{$errors->first('remark')}}</p>
                    @endif
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-sm m-t-10 ">Submit</button> 
                </div>
            </form>
        </div>
    </div>

@endsection