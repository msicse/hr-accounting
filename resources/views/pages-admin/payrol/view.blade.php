@extends('layout.admin')
@section('title','Admin | Payroll')
@section('styles')
    <style>
        .form-control{
            font-size: 20px;

        }
        .m-t-40 {
            margin-top: 30px;
        }
    </style>
@stop
@section('contentBody')
	<div class="card">
        <div class="card-header">
            <h2>Payrol <a href="{{ url('offday/month') }}"> <span class="pull-right btn btn-primary custom-btn"><i class="fa fa-arrow-left" aria-hidden="true"></i> back </span></a></h2>
        </div>
        <div class="card-body card-padding">
            <form role="form" method="post" action="{{ route('payrol.index') }} " class="remove-margin-p">
            {{ csrf_field() }}
                  
                 
                <div class="col-md-4">
                    
                    <div class="form-group m-t-40">
                        <div class="fg-line">
                            <label for="employee_id">Employee ID</label>
                            <input type="text" class="form-control input-sm" id="employee_id" name="employee_id" placeholder="Enter employee_id" value="" />
                        </div>
                        @if ($errors->has('employee_id'))
                            <p class="text-right text-danger">{{$errors->first('employee_id')}}</p>
                        @endif
                    </div>

                </div>

                <div class="col-md-4">
                        
                        <div class="form-group">
                            <div class="fg-line">
                                <div class="select">
                                    <h2 class="text-left">Year</h2>
                                    <select class="form-control" name="year">
                                        <option></option>
                                    @for ($i = 2016; $i <= 2050; $i++)
                                        <option style="font-size: 20px;" value="{{ $i }}">{{ $i }}</option>
                                    @endfor

                                  </select>
                            
                                </div>
                            </div>
                    
                                @if ($errors->has('year'))
                                 <p class="text-right text-danger">{{$errors->first('year')}}</p>
                                @endif
                        </div>

                    </div>
                
                <div class="col-md-4">
                        <div class="form-group">
                            <div class="fg-line">
                                <div class="select">
                                    <h2 class="text-left">Month</h2>
                                    <select class="form-control" name="month">
                                        <option></option>
                                        <option value="1">January</option>
                                        <option value="2">February</option>
                                        <option value="3">March</option>
                                        <option value="4">April</option>
                                        <option value="5">May</option>
                                        <option value="6">June</option>
                                        <option value="7">July</option>
                                        <option value="8">August</option>
                                        <option value="9">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                  </select>
                            
                                </div>
                            </div>
                    
                                @if ($errors->has('month'))
                                 <p class="text-right text-danger">{{$errors->first('month')}}</p>
                                @endif
                        </div>

                </div>
                


                   
                 <button type="submit" class="btn btn-primary btn-sm m-t-10">Submit</button>
            </form>

         </div>
    </div>
    

@endsection