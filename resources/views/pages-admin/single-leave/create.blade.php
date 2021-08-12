@extends('layout.admin')
@section('title','Admin | Leave Request')
@section('contentBody')
	<div class="card">
        <div class="card-header">
            <h2>Leave Request</h2>
        </div>
        <div class="card-body card-padding">
            <form role="form" method="post" action="{{ route("single-leaves.store") }}" class="remove-margin-p">
            {{ csrf_field() }}
                <div class="form-group ">
                    <div class="fg-line">
                        <label for="name">Name</label>
                        <input type="text" class="form-control input-sm" id="name"
                                               name="name"  value="{{ Auth::user()->name }}" placeholder="Enter name" readonly>
                    </div>
                    @if ($errors->has('name'))
                        <p class="text-right text-danger">{{$errors->first('name')}}</p>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group ">
                    <div class="fg-line">
                    <label for="designation">Designation</label>

                    <input type="text" class="form-control input-sm" id="designation"
                                           name="designation" placeholder="" value="{{$designation->designation_name }}" readonly >
                    </div>
                    @if ($errors->has('designation'))
                     <p class="text-right text-danger">{{$errors->first('designation')}}</p>
                    @endif
                </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group ">
                    <div class="fg-line">
                        <label for="name">Type Of Leave</label>
                        <input type="text" class="form-control input-sm" id="type"
                                               name="type" placeholder="Enter type">
                    </div>
                    @if ($errors->has('type'))
                        <p class="text-right text-danger">{{$errors->first('type')}}</p>
                    @endif
                </div>
                    </div>
                </div>
                
                <br> <br>
                <div class="row">
                        <div class="col-sm-3">
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
                        <div class="col-sm-3">  
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

                        <div class="col-sm-6">
                            <div class="form-group form-group-lg">
                                <div class="fg-line">
                                    <label for="days">Days </label> <br>
                                    <input type="text" class="form-control input-block" id="days"
                                           name="days" placeholder="days" data-role="tagsinput" >
                                </div>
                                @if ($errors->has('days'))
                                 <p class="text-right text-danger">{{$errors->first('days')}}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <br> <br>
                    <div class="row">
                        <div class="col-sm-4">
                            <h4>Joining Date </h4>
                                <div class="input-group form-group">
                                
                                        <div class="dtp-container">
                                            <input type='text' class="form-control date-picker" placeholder="Click here..." id="rejoin_date" name="rejoin_date"/>
                                        </div>
                                </div>
                        </div>

                        <div class="col-sm-4">
                           
                                <div class="form-group ">
                                <div class="fg-line">
                                    <label for="total_days">No Of Days On leave</label>
                                    <input type="text" class="form-control input-sm" id="total_days"
                                           name="total_days" placeholder="total_days">
                                </div>
                                @if ($errors->has('total_days'))
                                 <p class="text-right text-danger">{{$errors->first('total_days')}}</p>
                                @endif
                        </div>
                        </div>
                        <div class="col-sm-4">
                        <div class="form-group ">
                                <div class="fg-line">
                                    <label for="marks">Contact No</label>
                                    <input type="text" class="form-control input-sm" id="contact_no"
                                           name="contact_no" placeholder="designation">
                                </div>
                                @if ($errors->has('contact_no'))
                                 <p class="text-right text-danger">{{$errors->first('contact_no')}}</p>
                                @endif
                        </div>
                    </div>
                    </div>
                 <br> <br>
                <div class="row">
                   <div class="col-md-6">
                       <div class="form-group ">
                                <div class="fg-line">
                                    <label for="contact_address">Contact Address During Leave</label>
                                    <textarea class="form-control" rows="5" placeholder="contact_address during leave......" name="contact_address" id="contact_address"></textarea>
                                </div>
                                @if ($errors->has('contact_address'))
                                 <p class="text-right text-danger">{{$errors->first('contact_address')}}</p>
                                @endif
                        </div>
                        
                    </div>
                    <div class="col-md-6">

                       <div class="form-group ">
                                <div class="fg-line">
                                    <label for="marks">Recommended</label>
                                    <textarea class="form-control" rows="5" placeholder="Recommand......" name="recommened" id="recommened"></textarea>
                                </div>
                                @if ($errors->has('recommened'))
                                 <p class="text-right text-danger">{{$errors->first('recommened')}}</p>
                                @endif
                        </div>
                    
                    </div>

                </div>
                
                <button type="submit" class="btn btn-primary btn-sm m-t-10">Submit</button> 
            </form>
         </div>
    </div>

@endsection

@section('admin_scripts')
    
    <script>
        $('input').tagsinput({
          typeaheadjs: {
            name: 'citynames',
            displayKey: 'name',
            valueKey: 'name',
            source: citynames.ttAdapter()
          }
        });
    </script>
@endsection