@extends('layout.admin')
@section('title','Admin | Profile Create')
@section('contentBody')
    <div class="card">
        <div class="card-header">
            <h1>Profile Create</h1>
        </div>
        <div class="card-body card-padding">
            <form role="form" method="POST" action="{{ action('ProfileController@store') }}" class="remove-margin-p" enctype="multipart/form-data" >
                {{ csrf_field() }}
                
                <div class="row">
                        <div class="col-sm-6 text-center m-b-30">
                            <h3 class="f-500 c-black m-b-20">Upload Profile </h3>
                           
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview thumbnail" data-trigger="fileinput"></div>
                                <div>
                                    <span class="btn btn-info btn-file">
                                        <span class="fileinput-new">Select image</span>
                                        <span class="fileinput-exists">Change</span>
                                        <input type="file" name="profile_pic" value="{{ Input::old('profile_pic') }}"  >
                                    </span>
                                    <a href="#" class="btn btn-danger fileinput-exists"
                                       data-dismiss="fileinput">Remove</a>
                                </div>
                        </div>
                         @if ($errors->has('profile_pic'))
                         <p class="text-right text-danger">{{$errors->first('profile_pic')}}</p>
                        @endif
                        </div>
                        <div class="col-sm-6 text-center m-b-30">
                            <h3 class="f-500 c-black m-b-20">Upload NID </h3>
                           
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview thumbnail" data-trigger="fileinput"></div>
                                <div>
                                    <span class="btn btn-info btn-file">
                                        <span class="fileinput-new">Select image</span>
                                        <span class="fileinput-exists">Change</span>
                                        <input type="file" name="nid_upload" value="{{ Input::old('nid_upload') }}" >
                                    </span>
                                    <a href="#" class="btn btn-danger fileinput-exists"
                                       data-dismiss="fileinput">Remove</a>
                                </div>
                        </div>
                         @if ($errors->has('nid_upload'))
                         <p class="text-right text-danger">{{$errors->first('nid_upload')}}</p>
                        @endif
                        </div>
                </div>

                <div class="row">  
                    <div class="col-md-4">  
                        <div class="form-group ">
                            <div class="fg-line">
                                <label for="employee_id">Employee ID <sup style="font-size: 12px;" class="fa fa-star text-danger text-right" aria-hidden="true"></sup></label>
                                <input type="number" required class="form-control input-sm" id="employee_id" name="employee_id" placeholder="Enter employee_id" value="{{ Input::old('employee_id')  }}" />
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
                                    <h4>Type Of Employee</h4>
                                    <select class="form-control" name="employee_type" style="height: 24px;">
                                        <option></option>
                                        <option value="1" {{ Input::old('employee_type') == 1 ? 'selected' : '' }} >Contractual</option>
                                        <option value="2" {{ Input::old('employee_type') == 2 ? 'selected' : '' }} >Permanent</option>
                                  </select>
                            
                                </div>
                            </div>
                    
                                @if ($errors->has('employee_type'))
                                 <p class="text-right text-danger">{{$errors->first('employee_type')}}</p>
                                @endif
                        </div>
                    </div>
                    <div class="col-md-4">  
                        <div class="form-group ">
                            <div class="fg-line">
                                <label for="employee_id">Salary <sup style="font-size: 12px;" class="fa fa-star text-danger text-right" aria-hidden="true"></sup> </label>
                                <input type="text" class="form-control input-sm" id="salary" required name="salary" placeholder="salary" value="{{ Input::old('salary')  }}" />
                            </div>
                            @if ($errors->has('salary'))
                                <p class="text-right text-danger">{{$errors->first('salary')}}</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group ">
                            <div class="fg-line">
                                <label for="full_name">First Name <sup style="font-size: 12px;" class="fa fa-star text-danger text-right" aria-hidden="true"></sup></label>
                                <input type="text" required class="form-control input-sm" id="first_name" name="first_name" placeholder="Enter first_name" value="{{ Input::old('first_name')  }}" />
                            </div>
                            @if ($errors->has('first_name'))
                                <p class="text-right text-danger">{{$errors->first('first_name')}}</p>
                            @endif
                        </div>
                    </div>
                
                    <div class="col-md-4">
                        <div class="form-group ">
                            <div class="fg-line">
                                <label for="middle_name">Middle Name</label>
                                <input type="text" class="form-control input-sm" id="middle_name" name="middle_name" placeholder="Enter middle_name" value="{{ Input::old('middle_name')  }}" />
                            </div>
                            @if ($errors->has('middle_name'))
                                <p class="text-right text-danger">{{$errors->first('middle_name')}}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group ">
                            <div class="fg-line">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control input-sm" id="last_name" name="last_name" placeholder="Enter last_name" value="{{ Input::old('last_name')  }}" />
                            </div>
                            @if ($errors->has('last_name'))
                                <p class="text-right text-danger">{{$errors->first('full_name')}}</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-group ">
                        <div class="fg-line">
                            <label for="father_name">Father Name</label>
                            <input type="text" class="form-control input-sm" id="father_name" name="father_name" placeholder="father_name" value="{{ Input::old('father_name')  }}"  />
                        </div>
                        @if ($errors->has('father_name'))
                         <p class="text-right text-danger">{{$errors->first('father_name')}}</p>
                        @endif
                </div>
                <div class="form-group ">
                        <div class="fg-line">
                            <label for="mother_name">Mother Name</label>
                            <input type="text" class="form-control input-sm" id="mother_name" name="mother_name" placeholder="mother name" value="{{ Input::old('mother_name')  }}" />
                        </div>
                        @if ($errors->has('mother_name'))
                         <p class="text-right text-danger">{{$errors->first('mother_name')}}</p>
                        @endif
                </div>
                <div class="form-group ">
                    <div class="fg-line">
                            <label for="nid">National ID No.</label>
                            <input type="text" class="form-control input-sm" id="nid" name="nid" placeholder="nid" value="{{ Input::old('nid')  }}" />
                        </div>
                        @if ($errors->has('nid'))
                         <p class="text-right text-danger">{{$errors->first('nid')}}</p>
                        @endif
                </div>
                <div class="form-group ">
                        <div class="fg-line">
                            <label class="radio radio-inline m-r-20">
                                <input type="radio" name="gender" value="1" {{ Input::old('gender') == 1 ? 'checked' : '' }} />
                                <i class="input-helper"></i>Male
                            </label>
                            <label class="radio radio-inline m-r-20">
                                <input type="radio" name="gender" value="2" {{ Input::old('gender') == 2 ? 'checked' : '' }} />
                                <i class="input-helper"></i>Female
                            </label>
                        </div>
                        <hr>
                        @if ($errors->has('gender'))
                            <p class="text-right text-danger">{{$errors->first('gender')}}</p>
                        @endif
                </div>
                    <div class="form-group ">
                        <div class="fg-line">
                            <label class="radio radio-inline m-r-20">
                                <input type="radio" name="maritial_status" value="1" {{ Input::old('maritial_status') == 1 ? 'checked' : ''  }} >
                                <i class="input-helper"></i>Married
                            </label>
                            <label class="radio radio-inline m-r-20">
                                <input type="radio" name="maritial_status" value="2" {{ Input::old('maritial_status') == 2 ? 'checked' : ''  }} >
                                <i class="input-helper"></i>Unmarried
                            </label>
                        </div>
                        <hr>
                        @if ($errors->has('maritial_status'))
                            <p class="text-right text-danger">{{$errors->first('maritial_status')}}</p>
                        @endif
                    </div>
                    <div class="col-sm-4">
                        <h4>Date of Birth</h4>
                            <div class="input-group form-group">
                                <span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
                                    <div class="dtp-container">
                                        <input type='text' class="form-control date-picker" placeholder="Click here..." id="date_of_birth" name="date_of_birth"  value="{{ Input::old('date_of_birth')  }}" />
                                    </div>
                            </div>
                        </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="fg-line">
                                <div class="select">
                                    <h4>Religion</h4>
                                    <select class="form-control" name="religion">
                                        <option></option>
                                        <option value="1" {{ Input::old('religion') == 1 ? 'selected' : '' }} >Islam</option>
                                        <option value="2" {{ Input::old('religion') == 2 ? 'selected' : '' }} >Hinduism</option>
                                        <option value="3" {{ Input::old('religion') == 3 ? 'selected' : '' }} >Buddhism</option>
                                        <option value="4" {{ Input::old('religion') == 4 ? 'selected' : '' }} >Christianity</option>
                                        <option value="5" {{ Input::old('religion') == 5 ? 'selected' : '' }} >Others</option>
                                  </select>
                            
                                </div>
                            </div>
                    
                                @if ($errors->has('religion'))
                                 <p class="text-right text-danger">{{$errors->first('religion')}}</p>
                                @endif
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="fg-line">
                                <div class="select">
                                    <h4>Blood Group</h4>
                                    <select class="form-control" name="blood_group">
                                        <option></option>
                                        <option value="1" {{ Input::old('blood_group') == 1 ? 'selected' : '' }} >A+</option>
                                        <option value="2" {{ Input::old('blood_group') == 2 ? 'selected' : '' }} >A-</option>
                                        <option value="3" {{ Input::old('blood_group') == 3 ? 'selected' : '' }} >B+</option>
                                        <option value="4" {{ Input::old('blood_group') == 4 ? 'selected' : '' }} >B-</option>
                                        <option value="5" {{ Input::old('blood_group') == 5 ? 'selected' : '' }} >AB+</option>
                                        <option value="6" {{ Input::old('blood_group') == 6 ? 'selected' : '' }} >AB-</option>
                                        <option value="7" {{ Input::old('blood_group') == 7 ? 'selected' : '' }} >O+</option>
                                        <option value="8" {{ Input::old('blood_group') == 8 ? 'selected' : '' }} >O-</option>
                                  </select>
                            
                                </div>
                            </div>
                            @if ($errors->has('blood_group'))
                             <p class="text-right text-danger">{{$errors->first('blood_group')}}</p>
                            @endif
                        </div>
                    </div> 
                    
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="ccode">Country Code</label>
                                    <input type="text" class="form-control input-sm" id="ccode" name="ccode" placeholder="ccode...." value="+" >
                                </div>
                                @if ($errors->has('ccode'))
                                 <p class="text-right text-danger">{{$errors->first('ccode')}}</p>
                                @endif
                            </div>
                        </div>
                        
                        <div class="col-md-10">
                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="phone">Phone No</label>
                                    <input type="text" class="form-control input-sm" id="phone" name="phone" placeholder="phone...." value="{{ Input::old('phone')  }}" >
                                </div>
                                @if ($errors->has('phone'))
                                 <p class="text-right text-danger">{{$errors->first('phone')}}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="fg-line">
                            <label for="email">Email</label>
                            <input type="email" class="form-control input-sm" id="email" name="email" placeholder="email...." value="{{ Input::old('email')  }}" >
                        </div>
                        @if ($errors->has('email'))
                         <p class="text-right text-danger">{{$errors->first('email')}}</p>
                        @endif
                    </div>
                    <div class="form-group ">
                        <div class="fg-line">
                            <label for="fb">Facebook Url</label>
                            <input type="text" class="form-control input-sm" id="fb" name="fb" placeholder="ex.www.facebook.com/yourname" value="{{ Input::old('fb')  }}" >
                        </div>
                        @if ($errors->has('fb'))
                         <p class="text-right text-danger">{{$errors->first('fb')}}</p>
                        @endif
                    </div>
                    <div class="form-group ">
                        <div class="fg-line">
                            <label for="fb">Skype</label>
                            <input type="text" class="form-control input-sm" id="skype" name="skype" placeholder="skype" value="{{ Input::old('skype')  }}" >
                        </div>
                        @if ($errors->has('skype'))
                         <p class="text-right text-danger">{{$errors->first('skype')}}</p>
                        @endif
                    </div>
                    <h3>Academic Qualification:</h3>
                    <div class="row">
                        <input type="hidden" name="ssc" value="ssc">
                        <div class="col-md-12">
                             <h4>SSC</h4>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="ssc_group">Concentration/ Major/Group:</label>
                                    <input type="text" class="form-control input-md" id="ssc_group" name="ssc_group" placeholder="" value="" >
                                </div>
                                @if ($errors->has('ssc_group'))
                                 <p class="text-right text-danger">{{$errors->first('ssc_group')}}</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="ssc_institute">Institute Name:</label>
                                    <input type="text" class="form-control input-md" id="ssc_institute" name="ssc_institute" placeholder="ssc_institute" value="" >
                                </div>
                                @if ($errors->has('fb'))
                                 <p class="text-right text-danger">{{$errors->first('fb')}}</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="ssc_result">Result</label>
                                    <input type="text" class="form-control input-md" id="ssc_result" name="ssc_result" placeholder="result" value="" >
                                </div>
                                @if ($errors->has('fb'))
                                 <p class="text-right text-danger">{{$errors->first('fb')}}</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="fg-line">
                                    <div class="select">
                                        <label for="ssc_result">Year</label>
                                        <select class="form-control" name="ssc_year">
                                            <option></option>
                                        @for( $i = 2020  ; $i >= 1964 ;$i-- )
                                            <option value="{{$i}}" {{ Input::old('ssc_year') == $i ? 'selected' : '' }} >{{$i}}</option>
                                        @endfor
                                      </select>
                                
                                    </div>
                                </div>
                                @if ($errors->has('ssc_year'))
                                 <p class="text-right text-danger">{{$errors->first('ssc_year')}}</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <input type="hidden" name="hsc" value="hsc">
                        <div class="col-md-12">
                             <h4>HSC</h4>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="hsc_group">Concentration/ Major/Group:</label>
                                    <input type="text" class="form-control input-md" id="hsc_group" name="hsc_group" placeholder="" value="" >
                                </div>
                                @if ($errors->has('hsc_group'))
                                 <p class="text-right text-danger">{{$errors->first('hsc_group')}}</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="hsc_institute">Institute Name:</label>
                                    <input type="text" class="form-control input-md" id="hsc_institute" name="hsc_institute" placeholder="" value="" >
                                </div>
                                @if ($errors->has('hsc_institute'))
                                 <p class="text-right text-danger">{{$errors->first('hsc_institute')}}</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="hsc_result">Result</label>
                                    <input type="text" class="form-control input-md" id="hsc_result" name="hsc_result" placeholder="result" value="" >
                                </div>
                                @if ($errors->has('hsc_result'))
                                 <p class="text-right text-danger">{{$errors->first('hsc_result')}}</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="fg-line">
                                    <div class="select">
                                        <label for="hsc_result">Year</label>
                                        <select class="form-control" name="hsc_year">
                                            <option></option>
                                        @for( $i = 2020  ; $i >= 1964 ;$i-- )
                                            <option value="{{$i}}" {{ Input::old('hsc_year') == $i ? 'selected' : '' }} >{{$i}}</option>
                                        @endfor
                                      </select>
                                
                                    </div>
                                </div>
                                @if ($errors->has('hsc_year'))
                                 <p class="text-right text-danger">{{$errors->first('hsc_year')}}</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <input type="hidden" name="hons" value="hons">
                        <div class="col-md-12">
                             <h4>Hons</h4>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="hons_group">Concentration/ Major/Group:</label>
                                    <input type="text" class="form-control input-md" id="hons_group" name="hons_group" placeholder="" value="" >
                                </div>
                                @if ($errors->has('hons_group'))
                                 <p class="text-right text-danger">{{$errors->first('hons_group')}}</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="hons_institute">Institute Name:</label>
                                    <input type="text" class="form-control input-md" id="hons_institute" name="hons_institute" placeholder="" value="" >
                                </div>
                                @if ($errors->has('hons_institute'))
                                 <p class="text-right text-danger">{{$errors->first('hons_institute')}}</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="hons_result">Result</label>
                                    <input type="text" class="form-control input-md" id="hons_result" name="hons_result" placeholder="" value="" >
                                </div>
                                @if ($errors->has('hons_result'))
                                 <p class="text-right text-danger">{{$errors->first('hons_result')}}</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="fg-line">
                                    <div class="select">
                                        <label for="hons_year">Year</label>
                                        <select class="form-control" name="hons_year">
                                            <option></option>
                                        @for( $i = 2020  ; $i >= 1964 ;$i-- )
                                            <option value="{{$i}}" {{ Input::old('hons_year') == $i ? 'selected' : '' }} >{{$i}}</option>
                                        @endfor
                                      </select>
                                
                                    </div>
                                </div>
                                @if ($errors->has('hons_year'))
                                 <p class="text-right text-danger">{{$errors->first('hons_year')}}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                             <h4>Masters</h4>
                        </div>

                        <div class="col-md-4">
                            <input type="hidden" name="masters" value="masters">
                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="master_group">Concentration/ Major/Group:</label>
                                    <input type="text" class="form-control input-md" id="master_group" name="master_group" placeholder="" value="" >
                                </div>
                                @if ($errors->has('master_group'))
                                 <p class="text-right text-danger">{{$errors->first('master_group')}}</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="ssc_institute">Institute Name:</label>
                                    <input type="text" class="form-control input-md" id="masters_institute" name="master_institute" placeholder="" value="" >
                                </div>
                                @if ($errors->has('fb'))
                                 <p class="text-right text-danger">{{$errors->first('fb')}}</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="ssc_result">Result</label>
                                    <input type="text" class="form-control input-md" id="master_result" name="master_result" placeholder="result" value="" >
                                </div>
                                @if ($errors->has('fb'))
                                 <p class="text-right text-danger">{{$errors->first('fb')}}</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="fg-line">
                                    <div class="select">
                                        <label for="masters_result">Year</label>
                                        <select class="form-control" name="master_year">
                                            <option></option>
                                        @for( $i = 2020  ; $i >= 1964 ;$i-- )
                                            <option value="{{$i}}" {{ Input::old('master_year') == $i ? 'selected' : '' }} >{{$i}}</option>
                                        @endfor
                                      </select>
                                
                                    </div>
                                </div>
                                @if ($errors->has('masters_year'))
                                 <p class="text-right text-danger">{{$errors->first('masters_year')}}</p>
                                @endif
                            </div>
                        </div>
                    </div>


                    <div class="form-group ">
                        <div class="fg-line">
                            <label for="marks">Marks</label>
                            <textarea class="form-control" rows="5" placeholder="marks......" name="marks" id="marks">{{ Input::old('marks') }}</textarea>
                        </div>
                        @if ($errors->has('marks'))
                         <p class="text-right text-danger">{{$errors->first('marks')}}</p>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Present Address:</h3>
                            <div class="col-md-2">
                                <div class="form-group ">
                                    <div class="fg-line">
                                        <label for="flat_no">Flat No :</label>
                                        <input type="text" class="form-control input-sm" id="flat_no" name="flat_no" placeholder="flat_no.." value="{{ Input::old('flat_no')  }}" >
                                    </div>
                                        @if ($errors->has('flat_no'))
                                         <p class="text-right text-danger">{{$errors->first('flat_no')}}</p>
                                        @endif
                                </div>
                            </div>
                            <div class="col-md-2 remove-padding">
                                <div class="form-group ">
                                    <div class="fg-line">
                                        <label for="house_no">House No :</label>
                                        <input type="text" class="form-control input-sm" id="house_no" name="house_no" placeholder="house_no.." value="{{ Input::old('house_no')  }}" >
                                    </div>
                                        @if ($errors->has('house_no'))
                                         <p class="text-right text-danger">{{$errors->first('house_no')}}</p>
                                        @endif
                                </div>
                            </div>

                           <div class="col-md-2">
                                <div class="form-group ">
                                    <div class="fg-line">
                                        <label for="road_no">Road No :</label>
                                        <input type="text" class="form-control input-sm" id="road_no" name="road_no" placeholder="road no.." value="{{ Input::old('road_no')  }}" >
                                    </div>
                                        @if ($errors->has('road_no'))
                                         <p class="text-right text-danger">{{$errors->first('road_no')}}</p>
                                        @endif
                                </div>
                            </div>
                            <div class="col-md-2 remove-padding">
                                <div class="form-group">
                                    <div class="fg-line">
                                        <div class="select">
                                            <label for="dist">Dist :</label>
                                            <select class="form-control" name="dist" id="dis" onchange="find_thana(this.value);" >
                                                <option value="" selected>Select a District</option>
                                                
                                                <option value="Bagerhat" {{ Input::old('dist') == 'Bagerhat' ? 'selected' : '' }} >Bagerhat</option>
                                                <option value="Barishal" {{ Input::old('dist') == 'Barishal' ? 'selected' : '' }} >Barishal</option>
                                                <option value="Bandarban" {{ Input::old('dist') == 'Bandarban' ? 'selected' : '' }} >Bandarban</option>
                                                <option value="Barguna" {{ Input::old('dist') == 'Barguna' ? 'selected' : '' }} >Barguna</option>
                                                <option value="Bhola" {{ Input::old('dist') == 'Bhola' ? 'selected' : '' }} >Bhola</option>
                                                <option value="Brahmanbaria" {{ Input::old('dist') == 'Brahmanbaria' ? 'selected' : '' }} >Brahmanbaria</option>
                                                <option value="Bogra" {{ Input::old('dist') == 'Bogra' ? 'selected' : '' }} >Bogra</option>
                                                <option value="Chandpur" {{ Input::old('dist') == 'Chandpur' ? 'selected' : '' }} >Chandpur</option>
                                                <option value="Chapinawabganj" {{ Input::old('dist') == 'Chapinawabganj' ? 'selected' : '' }} >Chapai Nawabganj</option>
                                                <option value="Chittagong" {{ Input::old('dist') == 'Chittagong' ? 'selected' : '' }} >Chittagong</option>
                                                <option value="Chuadanga" {{ Input::old('dist') == 'Chuadanga' ? 'selected' : '' }} >Chuadanga</option>
                                                <option value="Comilla" {{ Input::old('dist') == 'Comilla' ? 'selected' : '' }} >Comilla</option>
                                                <option value="Coxs-Bazar" {{ Input::old('dist') == 'Coxs-Bazar' ? 'selected' : '' }} >Coxs-Bazar</option>
                                                
                                                <option value="Dhaka" {{ Input::old('dist') == 'Dhaka' ? 'selected' : '' }} >Dhaka</option>
                                                <option value="Dinajpur" {{ Input::old('dist') == 'Dinajpur' ? 'selected' : '' }} >Dinajpur</option>
                                                <option value="Faridpur" {{ Input::old('dist') == 'Faridpur' ? 'selected' : '' }} >Faridpur</option>
                                                <option value="Feni" {{ Input::old('dist') == 'Feni' ? 'selected' : '' }} >Feni</option>
                                                <option value="Gaibandha" {{ Input::old('dist') == 'Gaibandha' ? 'selected' : '' }} >Gaibandha</option>
                                                <option value="Gazipur" {{ Input::old('dist') == 'Gazipur' ? 'selected' : '' }} >Gazipur</option>
                                                <option value="Gopalganj" {{ Input::old('dist') == 'Gopalganj' ? 'selected' : '' }} >Gopalganj</option>
                                                <option value="Habiganj" {{ Input::old('dist') == 'Habiganj' ? 'selected' : '' }} >Habiganj</option>
                                                
                                                <option value="Jamalpur" {{ Input::old('dist') == 'Jamalpur' ? 'selected' : '' }} >Jamalpur</option>
                                                <option value="Jessore" {{ Input::old('dist') == 'Jessore' ? 'selected' : '' }} >Jessore</option>
                                                <option value="Jhalokathi" {{ Input::old('dist') == 'Jhalokathi' ? 'selected' : '' }} >Jhalokathi</option>
                                                <option value="Jinaidaha" {{ Input::old('dist') == 'Jinaidaha' ? 'selected' : '' }} >Jinaidaha</option>
                                                
                                                <option value="Joypurhat" {{ Input::old('dist') == 'Joypurhat' ? 'selected' : '' }} >Joypurhat</option>
                                                
                                                <option value="Khargrachhari" {{ Input::old('dist') == 'Khargrachhari' ? 'selected' : '' }} >Khargrachhari</option>
                                                <option value="Khulna" {{ Input::old('dist') == 'Khulna' ? 'selected' : '' }} >Khulna</option>
                                                <option value="Kishoreganj" {{ Input::old('dist') == 'Kishoreganj' ? 'selected' : '' }} >Kishoreganj</option>
                                                <option value="Kurigram" {{ Input::old('dist') == 'Kurigram' ? 'selected' : '' }} >Kurigram</option>
                                                <option value="Kustia" {{ Input::old('dist') == 'Kustia' ? 'selected' : '' }} >Kustia</option>
                                                <option value="Lakshmipur" {{ Input::old('dist') == 'Lakshmipur' ? 'selected' : '' }} >Lakshmipur</option>
                                                <option value="Lalmonirhat" {{ Input::old('dist') == 'Lalmonirhat' ? 'selected' : '' }} >Lalmonirhat</option>
                                                <option value="Madaripur" {{ Input::old('dist') == 'Madaripur' ? 'selected' : '' }} >Madaripur</option>
                                                <option value="Manikgonj" {{ Input::old('dist') == 'Manikgonj' ? 'selected' : '' }} >Manikgonj</option>
                                                <option value="Magura" {{ Input::old('dist') == 'Magura' ? 'selected' : '' }} >Magura</option>
                                                <option value="Munshiganj" {{ Input::old('dist') == 'Munshiganj' ? 'selected' : '' }} >Munshiganj</option>
                                                
                                                <option value="Meherpur" {{ Input::old('dist') == 'Meherpur' ? 'selected' : '' }} >Meherpur</option>
                                                
                                                <option value="Moulvibazar" {{ Input::old('dist') == 'Moulvibazar' ? 'selected' : '' }} >Moulvibazar</option>
                                                <option value="Mymensingh" {{ Input::old('dist') == 'Mymensingh' ? 'selected' : '' }} >Mymensingh</option>
                                                <option value="Narail" {{ Input::old('dist') == 'Narail' ? 'selected' : '' }} >Narail</option>
                                                <option value="Naogaon" {{ Input::old('dist') == 'Naogaon' ? 'selected' : '' }} >Naogaon</option>
                                                <option value="Narayanganj" {{ Input::old('dist') == 'Narayanganj' ? 'selected' : '' }} >Narayanganj</option>
                                                <option value="Narshingdi" {{ Input::old('dist') == 'Narshingdi' ? 'selected' : '' }} >Narshingdi</option>
                                                <option value="Natore" {{ Input::old('dist') == 'Natore' ? 'selected' : '' }} >Natore</option>
                                                <option value="Netrakona" {{ Input::old('dist') == 'Netrakona' ? 'selected' : '' }} >Netrakona</option>
                                                <option value="Nilphamari" {{ Input::old('dist') == 'Nilphamari' ? 'selected' : '' }} >Nilphamari</option>
                                                <option value="Noakhali" {{ Input::old('dist') == 'Noakhali' ? 'selected' : '' }} >Noakhali</option>
                                                <option value="Pabna" {{ Input::old('dist') == 'Pabna' ? 'selected' : '' }} >Pabna</option>
                                                <option value="Panchagarh" {{ Input::old('dist') == 'Panchagarh' ? 'selected' : '' }} >Panchagarh</option>
                                                <option value="Patuakhali" {{ Input::old('dist') == 'Patuakhali' ? 'selected' : '' }} >Patuakhali</option>
                                                <option value="Pirojpur" {{ Input::old('dist') == 'Pirojpur' ? 'selected' : '' }} >Pirojpur</option>
                                                <option value="Rajshahi" {{ Input::old('dist') == 'Rajshahi' ? 'selected' : '' }} >Rajshahi</option>
                                                <option value="Rajbari" {{ Input::old('dist') == 'Rajbari' ? 'selected' : '' }} >Rajbari</option>
                                                <option value="Rangamati" {{ Input::old('dist') == 'Rangamati' ? 'selected' : '' }} >Rangamati</option>
                                                <option value="Rangpur" {{ Input::old('dist') == 'Rangpur' ? 'selected' : '' }} >Rangpur</option>
                                                <option value="Satkhira" {{ Input::old('dist') == 'Satkhira' ? 'selected' : '' }} >Satkhira</option>
                                                
                                                <option value="Shariatpur" {{ Input::old('dist') == 'Shariatpur' ? 'selected' : '' }} >Shariatpur</option>
                                                <option value="Sherpur" {{ Input::old('dist') == 'Sherpur' ? 'selected' : '' }} >Sherpur</option>
                                                <option value="Sirajganj" {{ Input::old('dist') == 'Sirajganj' ? 'selected' : '' }} >Sirajganj</option>
                                                
                                                <option value="Sunamgonj" {{ Input::old('dist') == 'Sunamgonj' ? 'selected' : '' }} >Sunamgonj</option>
                                                <option value="Sylhet" {{ Input::old('dist') == 'Sylhet' ? 'selected' : '' }} >Sylhet</option>
                                                <option value="Tangail" {{ Input::old('dist') == 'Tangail' ? 'selected' : '' }} >Tangail</option>
                                                <option value="Thakurgaon" {{ Input::old('dist') == 'Thakurgaon' ? 'selected' : '' }} >Thakurgaon</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                    @if ($errors->has('dist'))
                                     <p class="text-right text-danger">{{$errors->first('dist')}}</p>
                                    @endif
                            </div>
                            <div class="col-md-2">
                                <div class="form-group ">
                                    <div class="fg-line">
                                        <label for="ps">P.S:</label>
                                        <select class="form-control" id="tha" onchange="find_post(this.value);" name="ps" >
                                         </select>
                                    </div>
                                    @if ($errors->has('ps'))
                                     <p class="text-right text-danger">{{$errors->first('ps')}}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group ">
                                    <label for="ps">P.O:</label>
                                    <select id="pos"   class="form-control" name="po" ></select>
                                    @if ($errors->has('po'))
                                     <p class="text-right text-danger">{{$errors->first('po')}}</p>
                                    @endif
                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <h3>Permanant Address:</h3>
                            <div class="col-md-3">
                                <div class="form-group ">
                                    <div class="fg-line">
                                        <label for="village">Vilage :</label>
                                        <input type="text" class="form-control input-sm" id="village" name="village" placeholder="village.." value="{{ Input::old('village')  }}" >
                                    </div>
                                    @if ($errors->has('village'))
                                     <p class="text-right text-danger">{{$errors->first('village')}}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="fg-line">
                                        <div class="select">
                                            <label for="dist">Dist :</label>
                                            <select class="form-control" name="per_dist" id="per-dist" onchange="find_thana_per(this.value);" >
                                                <option value="" selected>Select a District</option>
                                                
                                                <option value="Bagerhat" {{ Input::old('dist') == 'Bagerhat' ? 'selected' : '' }} >Bagerhat</option>
                                                <option value="Barishal" {{ Input::old('dist') == 'Barishal' ? 'selected' : '' }} >Barishal</option>
                                                <option value="Bandarban" {{ Input::old('dist') == 'Bandarban' ? 'selected' : '' }} >Bandarban</option>
                                                <option value="Barguna" {{ Input::old('dist') == 'Barguna' ? 'selected' : '' }} >Barguna</option>
                                                <option value="Bhola" {{ Input::old('dist') == 'Bhola' ? 'selected' : '' }} >Bhola</option>
                                                <option value="Brahmanbaria" {{ Input::old('dist') == 'Brahmanbaria' ? 'selected' : '' }} >Brahmanbaria</option>
                                                <option value="Bogra" {{ Input::old('dist') == 'Bogra' ? 'selected' : '' }} >Bogra</option>
                                                <option value="Chandpur" {{ Input::old('dist') == 'Chandpur' ? 'selected' : '' }} >Chandpur</option>
                                                <option value="Chapinawabganj" {{ Input::old('dist') == 'Chapinawabganj' ? 'selected' : '' }} >Chapai Nawabganj</option>
                                                <option value="Chittagong" {{ Input::old('dist') == 'Chittagong' ? 'selected' : '' }} >Chittagong</option>
                                                <option value="Chuadanga" {{ Input::old('dist') == 'Chuadanga' ? 'selected' : '' }} >Chuadanga</option>
                                                <option value="Comilla" {{ Input::old('dist') == 'Comilla' ? 'selected' : '' }} >Comilla</option>
                                                <option value="Coxs-Bazar" {{ Input::old('dist') == 'Coxs-Bazar' ? 'selected' : '' }} >Coxs-Bazar</option>
                                                
                                                <option value="Dhaka" {{ Input::old('dist') == 'Dhaka' ? 'selected' : '' }} >Dhaka</option>
                                                <option value="Dinajpur" {{ Input::old('dist') == 'Dinajpur' ? 'selected' : '' }} >Dinajpur</option>
                                                <option value="Faridpur" {{ Input::old('dist') == 'Faridpur' ? 'selected' : '' }} >Faridpur</option>
                                                <option value="Feni" {{ Input::old('dist') == 'Feni' ? 'selected' : '' }} >Feni</option>
                                                <option value="Gaibandha" {{ Input::old('dist') == 'Gaibandha' ? 'selected' : '' }} >Gaibandha</option>
                                                <option value="Gazipur" {{ Input::old('dist') == 'Gazipur' ? 'selected' : '' }} >Gazipur</option>
                                                <option value="Gopalganj" {{ Input::old('dist') == 'Gopalganj' ? 'selected' : '' }} >Gopalganj</option>
                                                <option value="Habiganj" {{ Input::old('dist') == 'Habiganj' ? 'selected' : '' }} >Habiganj</option>
                                                
                                                <option value="Jamalpur" {{ Input::old('dist') == 'Jamalpur' ? 'selected' : '' }} >Jamalpur</option>
                                                <option value="Jessore" {{ Input::old('dist') == 'Jessore' ? 'selected' : '' }} >Jessore</option>
                                                <option value="Jhalokathi" {{ Input::old('dist') == 'Jhalokathi' ? 'selected' : '' }} >Jhalokathi</option>
                                                <option value="Jinaidaha" {{ Input::old('dist') == 'Jinaidaha' ? 'selected' : '' }} >Jinaidaha</option>
                                                
                                                <option value="Joypurhat" {{ Input::old('dist') == 'Joypurhat' ? 'selected' : '' }} >Joypurhat</option>
                                                
                                                <option value="Khargrachhari" {{ Input::old('dist') == 'Khargrachhari' ? 'selected' : '' }} >Khargrachhari</option>
                                                <option value="Khulna" {{ Input::old('dist') == 'Khulna' ? 'selected' : '' }} >Khulna</option>
                                                <option value="Kishoreganj" {{ Input::old('dist') == 'Kishoreganj' ? 'selected' : '' }} >Kishoreganj</option>
                                                <option value="Kurigram" {{ Input::old('dist') == 'Kurigram' ? 'selected' : '' }} >Kurigram</option>
                                                <option value="Kustia" {{ Input::old('dist') == 'Kustia' ? 'selected' : '' }} >Kustia</option>
                                                <option value="Lakshmipur" {{ Input::old('dist') == 'Lakshmipur' ? 'selected' : '' }} >Lakshmipur</option>
                                                <option value="Lalmonirhat" {{ Input::old('dist') == 'Lalmonirhat' ? 'selected' : '' }} >Lalmonirhat</option>
                                                <option value="Madaripur" {{ Input::old('dist') == 'Madaripur' ? 'selected' : '' }} >Madaripur</option>
                                                <option value="Manikgonj" {{ Input::old('dist') == 'Manikgonj' ? 'selected' : '' }} >Manikgonj</option>
                                                <option value="Magura" {{ Input::old('dist') == 'Magura' ? 'selected' : '' }} >Magura</option>
                                                <option value="Munshiganj" {{ Input::old('dist') == 'Munshiganj' ? 'selected' : '' }} >Munshiganj</option>
                                                
                                                <option value="Meherpur" {{ Input::old('dist') == 'Meherpur' ? 'selected' : '' }} >Meherpur</option>
                                                
                                                <option value="Moulvibazar" {{ Input::old('dist') == 'Moulvibazar' ? 'selected' : '' }} >Moulvibazar</option>
                                                <option value="Mymensingh" {{ Input::old('dist') == 'Mymensingh' ? 'selected' : '' }} >Mymensingh</option>
                                                <option value="Narail" {{ Input::old('dist') == 'Narail' ? 'selected' : '' }} >Narail</option>
                                                <option value="Naogaon" {{ Input::old('dist') == 'Naogaon' ? 'selected' : '' }} >Naogaon</option>
                                                <option value="Narayanganj" {{ Input::old('dist') == 'Narayanganj' ? 'selected' : '' }} >Narayanganj</option>
                                                <option value="Narshingdi" {{ Input::old('dist') == 'Narshingdi' ? 'selected' : '' }} >Narshingdi</option>
                                                <option value="Natore" {{ Input::old('dist') == 'Natore' ? 'selected' : '' }} >Natore</option>
                                                <option value="Netrakona" {{ Input::old('dist') == 'Netrakona' ? 'selected' : '' }} >Netrakona</option>
                                                <option value="Nilphamari" {{ Input::old('dist') == 'Nilphamari' ? 'selected' : '' }} >Nilphamari</option>
                                                <option value="Noakhali" {{ Input::old('dist') == 'Noakhali' ? 'selected' : '' }} >Noakhali</option>
                                                <option value="Pabna" {{ Input::old('dist') == 'Pabna' ? 'selected' : '' }} >Pabna</option>
                                                <option value="Panchagarh" {{ Input::old('dist') == 'Panchagarh' ? 'selected' : '' }} >Panchagarh</option>
                                                <option value="Patuakhali" {{ Input::old('dist') == 'Patuakhali' ? 'selected' : '' }} >Patuakhali</option>
                                                <option value="Pirojpur" {{ Input::old('dist') == 'Pirojpur' ? 'selected' : '' }} >Pirojpur</option>
                                                <option value="Rajshahi" {{ Input::old('dist') == 'Rajshahi' ? 'selected' : '' }} >Rajshahi</option>
                                                <option value="Rajbari" {{ Input::old('dist') == 'Rajbari' ? 'selected' : '' }} >Rajbari</option>
                                                <option value="Rangamati" {{ Input::old('dist') == 'Rangamati' ? 'selected' : '' }} >Rangamati</option>
                                                <option value="Rangpur" {{ Input::old('dist') == 'Rangpur' ? 'selected' : '' }} >Rangpur</option>
                                                <option value="Satkhira" {{ Input::old('dist') == 'Satkhira' ? 'selected' : '' }} >Satkhira</option>
                                                
                                                <option value="Shariatpur" {{ Input::old('dist') == 'Shariatpur' ? 'selected' : '' }} >Shariatpur</option>
                                                <option value="Sherpur" {{ Input::old('dist') == 'Sherpur' ? 'selected' : '' }} >Sherpur</option>
                                                <option value="Sirajganj" {{ Input::old('dist') == 'Sirajganj' ? 'selected' : '' }} >Sirajganj</option>
                                                
                                                <option value="Sunamgonj" {{ Input::old('dist') == 'Sunamgonj' ? 'selected' : '' }} >Sunamgonj</option>
                                                <option value="Sylhet" {{ Input::old('dist') == 'Sylhet' ? 'selected' : '' }} >Sylhet</option>
                                                <option value="Tangail" {{ Input::old('dist') == 'Tangail' ? 'selected' : '' }} >Tangail</option>
                                                <option value="Thakurgaon" {{ Input::old('dist') == 'Thakurgaon' ? 'selected' : '' }} >Thakurgaon</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                    @if ($errors->has('per_dist'))
                                     <p class="text-right text-danger">{{$errors->first('per_dist')}}</p>
                                    @endif
                            </div>
                            <div class="col-md-3">
                                <div class="form-group ">
                                    <div class="fg-line">
                                        <label for="ps">P.S:</label>
                                        <select class="form-control" id="per-thana" onchange="find_post_per(this.value);" name="per_ps" >
                                         </select>
                                    </div>
                                    @if ($errors->has('ps'))
                                     <p class="text-right text-danger">{{$errors->first('ps')}}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group ">
                                    <label for="ps">P.O:</label>
                                    <select id="per-post"   class="form-control" name="per_po" ></select>
                                    @if ($errors->has('po'))
                                     <p class="text-right text-danger">{{$errors->first('per_po')}}</p>
                                    @endif
                                </div>
                            </div>
                            </div>

                            
                        </div>

                    <!--  end-row_permanent_addresass -->
                    
                    <div class="form-group ">
                        <div class="fg-line">
                            <label for="emergency_contact_number">Emegency Contact No :</label>
                            <input type="text" class="form-control input-sm" id="emergency_contact_number" name="emergency_contact_number" placeholder="emergency contact no" value="{{ Input::old('emergency_contact_number')  }}" >
                        </div>
                        @if ($errors->has('emergency_contact_number'))
                         <p class="text-right text-danger">{{$errors->first('emergency_contact_number')}}</p>
                        @endif
                    </div> 

                    <div class="row">
                        <div class="col-md-12">
                            <h3>Emergency Address:</h3>
                            <div class="col-md-2">
                                <div class="form-group ">
                                    <div class="fg-line">
                                        <label for="flat_no">Flat No :</label>
                                        <input type="text" class="form-control input-sm" id="flat_no" name="em_flat_no" placeholder="flat_no.." value="{{ Input::old('flat_no')  }}" >
                                    </div>
                                        @if ($errors->has('flat_no'))
                                         <p class="text-right text-danger">{{$errors->first('flat_no')}}</p>
                                        @endif
                                </div>
                            </div>
                            <div class="col-md-2 remove-padding">
                                <div class="form-group ">
                                    <div class="fg-line">
                                        <label for="em_house_no">House No :</label>
                                        <input type="text" class="form-control input-sm" id="house_no" name="em_house_no" placeholder="house_no.." value="{{ Input::old('house_no')  }}" >
                                    </div>
                                        @if ($errors->has('house_no'))
                                         <p class="text-right text-danger">{{$errors->first('house_no')}}</p>
                                        @endif
                                </div>
                            </div>

                           <div class="col-md-2">
                                <div class="form-group ">
                                    <div class="fg-line">
                                        <label for="road_no">Road No :</label>
                                        <input type="text" class="form-control input-sm" id="road_no" name="em_road_no" placeholder="road no.." value="{{ Input::old('road_no')  }}" >
                                    </div>
                                        @if ($errors->has('road_no'))
                                         <p class="text-right text-danger">{{$errors->first('road_no')}}</p>
                                        @endif
                                </div>
                            </div>
                            <div class="col-md-2 remove-padding">
                                <div class="form-group">
                                    <div class="fg-line">
                                        <div class="select">
                                            <label for="dist">Dist :</label>
                                            <select class="form-control" name="em_dist" id="em-dist" onchange="find_thana_em(this.value);" >
                                                <option value="" selected>Select a District</option>
                                                
                                                <option value="Bagerhat" {{ Input::old('dist') == 'Bagerhat' ? 'selected' : '' }} >Bagerhat</option>
                                                <option value="Barishal" {{ Input::old('dist') == 'Barishal' ? 'selected' : '' }} >Barishal</option>
                                                <option value="Bandarban" {{ Input::old('dist') == 'Bandarban' ? 'selected' : '' }} >Bandarban</option>
                                                <option value="Barguna" {{ Input::old('dist') == 'Barguna' ? 'selected' : '' }} >Barguna</option>
                                                <option value="Bhola" {{ Input::old('dist') == 'Bhola' ? 'selected' : '' }} >Bhola</option>
                                                <option value="Brahmanbaria" {{ Input::old('dist') == 'Brahmanbaria' ? 'selected' : '' }} >Brahmanbaria</option>
                                                <option value="Bogra" {{ Input::old('dist') == 'Bogra' ? 'selected' : '' }} >Bogra</option>
                                                <option value="Chandpur" {{ Input::old('dist') == 'Chandpur' ? 'selected' : '' }} >Chandpur</option>
                                                <option value="Chapinawabganj" {{ Input::old('dist') == 'Chapinawabganj' ? 'selected' : '' }} >Chapai Nawabganj</option>
                                                <option value="Chittagong" {{ Input::old('dist') == 'Chittagong' ? 'selected' : '' }} >Chittagong</option>
                                                <option value="Chuadanga" {{ Input::old('dist') == 'Chuadanga' ? 'selected' : '' }} >Chuadanga</option>
                                                <option value="Comilla" {{ Input::old('dist') == 'Comilla' ? 'selected' : '' }} >Comilla</option>
                                                <option value="Coxs-Bazar" {{ Input::old('dist') == 'Coxs-Bazar' ? 'selected' : '' }} >Coxs-Bazar</option>
                                                
                                                <option value="Dhaka" {{ Input::old('dist') == 'Dhaka' ? 'selected' : '' }} >Dhaka</option>
                                                <option value="Dinajpur" {{ Input::old('dist') == 'Dinajpur' ? 'selected' : '' }} >Dinajpur</option>
                                                <option value="Faridpur" {{ Input::old('dist') == 'Faridpur' ? 'selected' : '' }} >Faridpur</option>
                                                <option value="Feni" {{ Input::old('dist') == 'Feni' ? 'selected' : '' }} >Feni</option>
                                                <option value="Gaibandha" {{ Input::old('dist') == 'Gaibandha' ? 'selected' : '' }} >Gaibandha</option>
                                                <option value="Gazipur" {{ Input::old('dist') == 'Gazipur' ? 'selected' : '' }} >Gazipur</option>
                                                <option value="Gopalganj" {{ Input::old('dist') == 'Gopalganj' ? 'selected' : '' }} >Gopalganj</option>
                                                <option value="Habiganj" {{ Input::old('dist') == 'Habiganj' ? 'selected' : '' }} >Habiganj</option>
                                                
                                                <option value="Jamalpur" {{ Input::old('dist') == 'Jamalpur' ? 'selected' : '' }} >Jamalpur</option>
                                                <option value="Jessore" {{ Input::old('dist') == 'Jessore' ? 'selected' : '' }} >Jessore</option>
                                                <option value="Jhalokathi" {{ Input::old('dist') == 'Jhalokathi' ? 'selected' : '' }} >Jhalokathi</option>
                                                <option value="Jinaidaha" {{ Input::old('dist') == 'Jinaidaha' ? 'selected' : '' }} >Jinaidaha</option>
                                                
                                                <option value="Joypurhat" {{ Input::old('dist') == 'Joypurhat' ? 'selected' : '' }} >Joypurhat</option>
                                                
                                                <option value="Khargrachhari" {{ Input::old('dist') == 'Khargrachhari' ? 'selected' : '' }} >Khargrachhari</option>
                                                <option value="Khulna" {{ Input::old('dist') == 'Khulna' ? 'selected' : '' }} >Khulna</option>
                                                <option value="Kishoreganj" {{ Input::old('dist') == 'Kishoreganj' ? 'selected' : '' }} >Kishoreganj</option>
                                                <option value="Kurigram" {{ Input::old('dist') == 'Kurigram' ? 'selected' : '' }} >Kurigram</option>
                                                <option value="Kustia" {{ Input::old('dist') == 'Kustia' ? 'selected' : '' }} >Kustia</option>
                                                <option value="Lakshmipur" {{ Input::old('dist') == 'Lakshmipur' ? 'selected' : '' }} >Lakshmipur</option>
                                                <option value="Lalmonirhat" {{ Input::old('dist') == 'Lalmonirhat' ? 'selected' : '' }} >Lalmonirhat</option>
                                                <option value="Madaripur" {{ Input::old('dist') == 'Madaripur' ? 'selected' : '' }} >Madaripur</option>
                                                <option value="Manikgonj" {{ Input::old('dist') == 'Manikgonj' ? 'selected' : '' }} >Manikgonj</option>
                                                <option value="Magura" {{ Input::old('dist') == 'Magura' ? 'selected' : '' }} >Magura</option>
                                                <option value="Munshiganj" {{ Input::old('dist') == 'Munshiganj' ? 'selected' : '' }} >Munshiganj</option>
                                                
                                                <option value="Meherpur" {{ Input::old('dist') == 'Meherpur' ? 'selected' : '' }} >Meherpur</option>
                                                
                                                <option value="Moulvibazar" {{ Input::old('dist') == 'Moulvibazar' ? 'selected' : '' }} >Moulvibazar</option>
                                                <option value="Mymensingh" {{ Input::old('dist') == 'Mymensingh' ? 'selected' : '' }} >Mymensingh</option>
                                                <option value="Narail" {{ Input::old('dist') == 'Narail' ? 'selected' : '' }} >Narail</option>
                                                <option value="Naogaon" {{ Input::old('dist') == 'Naogaon' ? 'selected' : '' }} >Naogaon</option>
                                                <option value="Narayanganj" {{ Input::old('dist') == 'Narayanganj' ? 'selected' : '' }} >Narayanganj</option>
                                                <option value="Narshingdi" {{ Input::old('dist') == 'Narshingdi' ? 'selected' : '' }} >Narshingdi</option>
                                                <option value="Natore" {{ Input::old('dist') == 'Natore' ? 'selected' : '' }} >Natore</option>
                                                <option value="Netrakona" {{ Input::old('dist') == 'Netrakona' ? 'selected' : '' }} >Netrakona</option>
                                                <option value="Nilphamari" {{ Input::old('dist') == 'Nilphamari' ? 'selected' : '' }} >Nilphamari</option>
                                                <option value="Noakhali" {{ Input::old('dist') == 'Noakhali' ? 'selected' : '' }} >Noakhali</option>
                                                <option value="Pabna" {{ Input::old('dist') == 'Pabna' ? 'selected' : '' }} >Pabna</option>
                                                <option value="Panchagarh" {{ Input::old('dist') == 'Panchagarh' ? 'selected' : '' }} >Panchagarh</option>
                                                <option value="Patuakhali" {{ Input::old('dist') == 'Patuakhali' ? 'selected' : '' }} >Patuakhali</option>
                                                <option value="Pirojpur" {{ Input::old('dist') == 'Pirojpur' ? 'selected' : '' }} >Pirojpur</option>
                                                <option value="Rajshahi" {{ Input::old('dist') == 'Rajshahi' ? 'selected' : '' }} >Rajshahi</option>
                                                <option value="Rajbari" {{ Input::old('dist') == 'Rajbari' ? 'selected' : '' }} >Rajbari</option>
                                                <option value="Rangamati" {{ Input::old('dist') == 'Rangamati' ? 'selected' : '' }} >Rangamati</option>
                                                <option value="Rangpur" {{ Input::old('dist') == 'Rangpur' ? 'selected' : '' }} >Rangpur</option>
                                                <option value="Satkhira" {{ Input::old('dist') == 'Satkhira' ? 'selected' : '' }} >Satkhira</option>
                                                
                                                <option value="Shariatpur" {{ Input::old('dist') == 'Shariatpur' ? 'selected' : '' }} >Shariatpur</option>
                                                <option value="Sherpur" {{ Input::old('dist') == 'Sherpur' ? 'selected' : '' }} >Sherpur</option>
                                                <option value="Sirajganj" {{ Input::old('dist') == 'Sirajganj' ? 'selected' : '' }} >Sirajganj</option>
                                                
                                                <option value="Sunamgonj" {{ Input::old('dist') == 'Sunamgonj' ? 'selected' : '' }} >Sunamgonj</option>
                                                <option value="Sylhet" {{ Input::old('dist') == 'Sylhet' ? 'selected' : '' }} >Sylhet</option>
                                                <option value="Tangail" {{ Input::old('dist') == 'Tangail' ? 'selected' : '' }} >Tangail</option>
                                                <option value="Thakurgaon" {{ Input::old('dist') == 'Thakurgaon' ? 'selected' : '' }} >Thakurgaon</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                    @if ($errors->has('dist'))
                                     <p class="text-right text-danger">{{$errors->first('dist')}}</p>
                                    @endif
                            </div>
                            <div class="col-md-2">
                                <div class="form-group ">
                                    <div class="fg-line">
                                        <label for="ps">P.S:</label>
                                        <select class="form-control" id="em-thana" onchange="find_post_em(this.value);" name="em_ps" >
                                         </select>
                                    </div>
                                    @if ($errors->has('ps'))
                                     <p class="text-right text-danger">{{$errors->first('ps')}}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group ">
                                    <label for="ps">P.O:</label>
                                    <select id="em-post"   class="form-control" name="em_po" ></select>
                                    @if ($errors->has('po'))
                                     <p class="text-right text-danger">{{$errors->first('po')}}</p>
                                    @endif
                                </div>
                            </div>


                        </div>
                    </div>

                    <!--End-of-emergancy-address-row-->

                    <div class="row">
                        <div class="col-sm-4">
                                <h4 class="c-black f-500 ">Date of Join</h4>
                                <div class="input-group form-group">
                                    <span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
                                        <div class="dtp-container">
                                            <input type='text' class="form-control date-picker" placeholder="Click here..." name="date_of_join" value="{{ Input::old('date_of_join')  }}" >
                                        </div>
                                    @if ($errors->has('date_of_join'))
                                     <p class="text-right text-danger">{{$errors->first('date_of_join')}}</p>
                                    @endif
                                </div>
                        </div> 
                        <div class="col-sm-4 ">
                            <div class="form-group">
                                <div class="fg-line">
                                    <div class="select">
                                        <h4>Designation <sup style="font-size: 12px;" class="fa fa-star text-danger text-right" aria-hidden="true"></sup></h4>
                                        <select class="form-control" name="designation_id">
                                            <option></option>
                                            @foreach( $designation as $data)
                                            <option value="{{ $data->id }}" {{ Input::old('designation_id') == $data->id ? 'selected' : '' }} >{{$data->designation_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                                @if ($errors->has('designation_id'))
                                 <p class="text-right text-danger">{{$errors->first('designation_id')}}</p>
                                @endif
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="fg-line">
                                    <div class="select">
                                        <h4>Shift <sup style="font-size: 12px;" class="fa fa-star text-danger text-right" aria-hidden="true"></sup></h4>
                                        <select class="form-control" name="shift">
                                        <option></option>
                                        @foreach( $shift as $data)
                                        <option value="{{ $data->id }}" {{ Input::old('shift') == $data->id ? 'selected' : '' }} >{{ date('h-i a', strtotime($data->start)) }} to {{ date('h-i a', strtotime($data->end)) }}</option>
                                        @endforeach
                                    </select>
                                
                                    </div>
                                </div>
                                @if ($errors->has('shift'))
                                 <p class="text-right text-danger">{{$errors->first('shift')}}</p>
                                @endif
                            </div>  
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="fg-line">
                            <label for="reference">Previous Employee Record </label>
                            <textarea class="form-control" rows="5" placeholder="permanant address......" name="previous_record" id="previous_record">{{ Input::old('previous_record') }}</textarea>
                        </div>
                        @if ($errors->has('previous_record'))
                         <p class="text-right text-danger">{{$errors->first('previous_record')}}</p>
                        @endif
                    </div>
                    <div class="form-group ">
                        <div class="fg-line">
                            <label for="reference">Referenc </label>
                            <textarea class="form-control" rows="5" placeholder="permanant address......" name="reference" id="reference"> {{ Input::old('reference')}}</textarea>
                        </div>
                        @if ($errors->has('reference'))
                         <p class="text-right text-danger">{{$errors->first('reference')}}</p>
                        @endif
                    </div>
                <div class="row">
                    <div class="col-sm-12"> 
                    <center style="margin-top:20px; ">
                        <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                    </center>
                        
                    </div>
                </div>


                

                <div id="district" style="display: none;">

                    @include ('pages-admin.address.thana')
                   
                    
                    
                </div> <!-- End-of-Thana-->
                

                <div id="post" style="display: none;">
                    @include ('pages-admin.address.post')

                </div> <!--End-Of-Post-->

                
            </form>
        </div>
    </div>


    

@endsection
    
@section('scripts')
<script>
     $('#datepicker').datepicker({
                multidate: true,
            });

     function find_thana(district){
                //alert($('.'+district).html());
                
                $('#tha').html($('.'+district).html());
                $('#pos').html('');
            }
            
            function find_post(thana){

                var district = $('#dis').val();
                $('#pos').html($('.'+ district + '.' + thana).html());
            }
            
            
            function find_thana_per(district){
                //alert($('.'+district).html());
                
                $('#per-thana').html($('.'+district).html());
                $('#per-post').html('');
            }
            
            function find_post_per(thana){

                var district = $('#per-dist').val();
                $('#per-post').html($('.'+ district + '.' + thana).html());
            }
            
            function find_thana_em(district){
                //alert($('.'+district).html());
                
                $('#em-thana').html($('.'+district).html());
                $('#em-post').html('');
            }
            
            function find_post_em(thana){

                var district = $('#per-dist').val();
                $('#em-post').html($('.'+ district + '.' + thana).html());
            }
            
            

</script>
   
@endsection