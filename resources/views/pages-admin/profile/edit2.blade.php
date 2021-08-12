@extends('layout.admin')
@section('title','Admin | Profile Edit')
@section('contentBody')
    <div class="card">
        <div class="card-header">
            <h1>Profile Edit</h1>
        </div>
        <div class="card-body card-padding">
            <form role="form" method="POST" action="{{url('profile',$profile_edit->employee_id)}}" class="remove-margin-p" enctype="multipart/form-data" >
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="row">
                        <div class="col-sm-6 text-center m-b-30">
                            <h3 class="f-500 c-black m-b-20">Upload Profile </h3>
                           
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview thumbnail" data-trigger="fileinput"></div>
                                <div>
                                    <span class="btn btn-info btn-file">
                                        <span class="fileinput-new" value="$profile_edit->profile_pic">Select image</span>
                                        <span class="fileinput-exists">Change</span>
                                        <input type="file" name="profile_pic"  >
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
                                        <input type="file" name="nid_upload" >
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
                                <label for="employee_id">Employee ID</label>
                                <input type="text" class="form-control input-sm" id="employee_id" name="employee_id" placeholder="Enter employee_id" 
                                @if( empty( Input::old('employee_id')))
                                               value ="{{ $profile_edit->employee_id }}"
                                            @else
                                                 value="{{ Input::old('employee_id')  }}"
                                            @endif
                            >
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
                                        <option value="1" selected"{{ $profile_edit->employee_type == 1 ? 'selected' : '' }}" >Contractual</option>
                                        <option value="2" {{ $profile_edit->employee_type ==  2 ? 'selected' : '' }} >Permanent</option>
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
                                <label for="employee_id">Salary </label>
                                <input type="text" class="form-control input-sm" id="salary" name="salary" placeholder="salary" @if( empty( Input::old('nid')))
                                               value = "{{ $profile_edit->salary }}"
                                            @else
                                                 value="{{ Input::old('salary')  }}"
                                            @endif
                              />
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
                                <label for="full_name">First Name</label>
                                <input type="text" class="form-control input-sm" id="first_name" name="first_name" placeholder="Enter first_name"
                                @if( empty( Input::old('first_name')))
                                               value = "{{ $profile_edit->first_name }}"
                                            @else
                                                 value="{{ Input::old('first_name')  }}"
                                            @endif
                                 />
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
                                <input type="text" class="form-control input-sm" id="middle_name" name="middle_name" placeholder="Enter middle_name" @if( empty( Input::old('middle_name')))
                                               value ="{{ $profile_edit->middle_name }}"
                                            @else
                                                 value="{{ Input::old('middle_name')  }}"
                                            @endif
                                 />
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
                                <input type="text" class="form-control input-sm" id="last_name" name="last_name" placeholder="Enter last_name" 
                                @if( empty( Input::old('last_name')))
                                               value = "{{ $profile_edit->last_name }}"
                                            @else
                                                 value="{{ Input::old('last_name')  }}"
                                            @endif
                                 />
                            </div>
                            @if ($errors->has('last_name'))
                                <p class="text-right text-danger">{{$errors->first('last_name')}}</p>
                            @endif
                        </div>
                    </div>
                </div>
                    <div class="form-group ">
                        <div class="fg-line">
                            <label for="father_name">Father Name</label>
                            <input type="text" class="form-control input-sm" id="father_name" name="father_name" placeholder="father_name" 
                            @if( empty( Input::old('father_name')))
                                               value = "{{ $profile_edit->father_name }}"
                                            @else
                                                 value="{{ Input::old('father_name')  }}"
                                            @endif
                            
                            />
                        </div>
                        @if ($errors->has('father_name'))
                         <p class="text-right text-danger">{{$errors->first('father_name')}}</p>
                        @endif
                    </div>
                    <div class="form-group ">
                        <div class="fg-line">
                            <label for="mother_name">Mother Name</label>
                            <input type="text" class="form-control input-sm" id="mother_name" name="mother_name" placeholder="mother name"
                            @if( empty( Input::old('mother_name')))
                                               value = "{{ $profile_edit->mother_name }}"
                                            @else
                                                 value="{{ Input::old('mother_name')  }}"
                                            @endif
                            />
                        </div>
                        @if ($errors->has('mother_name'))
                         <p class="text-right text-danger">{{$errors->first('mother_name')}}</p>
                        @endif
                    </div>
                    <div class="form-group ">
                        <div class="fg-line">
                            <label for="nid">National ID No</label>
                            <input type="text" class="form-control input-sm" id="nid" name="nid" placeholder="nid"
                            @if( empty( Input::old('nid')))
                                               value = "{{ $profile_edit->nid }}"
                                            @else
                                                 value="{{ Input::old('nid')  }}"
                                            @endif
                             />
                        </div>
                        @if ($errors->has('nid'))
                         <p class="text-right text-danger">{{$errors->first('nid')}}</p>
                        @endif
                    </div>
                    <div class="form-group ">
                        <div class="fg-line">
                            <label class="radio radio-inline m-r-20">
                                <input type="radio" name="gender" value="1" {{ $profile_edit->gender == 1 ? 'checked' :'' }} />
                                <i class="input-helper"></i>Male
                            </label>
                            <label class="radio radio-inline m-r-20">
                                <input type="radio" name="gender" value="2" {{ $profile_edit->gender == 2 ? 'checked' :'' }}/>
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
                                <input type="radio" name="maritial_status" value="1" {{ $profile_edit->maritial_status == 1 ? 'checked' :'' }}>
                                <i class="input-helper"></i>Married
                            </label>
                            <label class="radio radio-inline m-r-20">
                                <input type="radio" name="maritial_status" value="2" {{ $profile_edit->maritial_status == 2 ? 'checked' :'' }}>
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
                                        <input type='text' class="form-control date-picker" placeholder="Click here..." id="date_of_birth" name="date_of_birth"/>
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
                                        <option value="1" {{ $profile_edit->religion == 1 ? 'selected' :'' }} >Islam</option>
                                        <option value="2" {{ $profile_edit->religion == 2 ? 'selected' :'' }}>Hinduism</option>
                                        <option value="3" {{ $profile_edit->religion == 3 ? 'selected' :'' }}>Buddhism</option>
                                        <option value="4" {{ $profile_edit->religion == 4 ? 'selected' :'' }}>Christianity</option>
                                        <option value="5" {{ $profile_edit->religion == 5 ? 'selected' :'' }}>Others</option>
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
                                        <option value="1" {{ $profile_edit->blood_group == 1 ? 'selected' :'' }}>A+</option>
                                        <option value="2" {{ $profile_edit->blood_group == 2 ? 'selected' :'' }}>A-</option>
                                        <option value="3" {{ $profile_edit->blood_group == 3 ? 'selected' :'' }}>B+</option>
                                        <option value="4" {{ $profile_edit->blood_group == 4 ? 'selected' :'' }}>B-</option>
                                        <option value="5" {{ $profile_edit->blood_group == 5 ? 'selected' :'' }}>AB+</option>
                                        <option value="6" {{ $profile_edit->blood_group == 6 ? 'selected' :'' }}>AB-</option>
                                        <option value="7" {{ $profile_edit->blood_group == 7 ? 'selected' :'' }}>O+</option>
                                        <option value="8" {{ $profile_edit->blood_group == 8 ? 'selected' :'' }}>O-</option>
                                  </select>
                            
                                </div>
                            </div>
                            @if ($errors->has('blood_group'))
                             <p class="text-right text-danger">{{$errors->first('blood_group')}}</p>
                            @endif
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="ccode">Country Code</label>
                                    <input type="text" class="form-control input-sm" id="ccode" name="ccode"
                                @if( empty( Input::old('ccode')))
                                               value ="{{$profile_edit->ccode}}"
                                            @else
                                                 value="+{{Input::old('ccode')}}"
                                            @endif
                                 />
                                </div>
                                @if ($errors->has('ccode'))
                                 <p class="text-right text-danger">{{$errors->first('ccode')}}</p>
                                @endif
                            </div>
                        </div>
                        
                        <div class="col-md-9">
                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="phone">Phone No</label>
                                    <input type="text" class="form-control input-sm" id="phone" name="phone" placeholder="phone...." 
                                @if( empty( Input::old('phone')))
                                               value ="{{ $profile_edit->phone }}"
                                            @else
                                                 value="{{ Input::old('phone')  }}"
                                            @endif
                                 />
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
                            <input type="text" class="form-control input-sm" id="email" name="email" placeholder="email...."
                            @if( empty( Input::old('email')))
                                               value ="{{ $profile_edit->email }}"
                                            @else
                                                 value="{{ Input::old('email')  }}"
                                            @endif
                            >
                        </div>
                        @if ($errors->has('email'))
                         <p class="text-right text-danger">{{$errors->first('email')}}</p>
                        @endif
                    </div>
                    <div class="form-group ">
                        <div class="fg-line">
                            <label for="fb">Facebook Url</label>
                            <input type="text" class="form-control input-sm" id="fb" name="fb" placeholder="ex.www.facebook.com/yourname"
                            @if( empty( Input::old('fb')))
                                               value = "{{ $profile_edit->fb }}"
                                            @else
                                                 value="{{ Input::old('fb')  }}"
                                            @endif
                            >
                        </div>
                        @if ($errors->has('fb'))
                         <p class="text-right text-danger">{{$errors->first('fb')}}</p>
                        @endif
                    </div>
                    <div class="form-group ">
                        <div class="fg-line">
                            <label for="skype">Skype</label>
                            <input type="text" class="form-control input-sm" id="skype" name="skype" placeholder="skype"
                            @if( empty( Input::old('skype')))
                                               value = "{{ $profile_edit->skype }}"
                                            @else
                                                 value="{{ Input::old('skype')  }}"
                                            @endif
                            >
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
                        <?php 
                            $ssc = explode(",",$profile_edit->ssc);
                            $hsc = explode(",",$profile_edit->hsc);
                            $hons = explode(",",$profile_edit->hons);
                            $masters = explode(",",$profile_edit->masters);
                            
                            $em_add = explode(",",$profile_edit->emergency_address);
                            $per_add = explode(",",$profile_edit->permanent_address);
                            $pre_add = explode(",",$profile_edit->present_address);

                           // print_r($ssc);
                        ?>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="ssc_group">Concentration/ Major/Group:</label>
                                    <input type="text" class="form-control input-md" id="ssc_group" name="ssc_group" placeholder="" 
                                @if( empty( Input::old('ssc_group')))
                                               value = "{{ empty($ssc[1]) ? "" : $ssc[1] }}"
                                            @else
                                                 value="{{ Input::old('ssc_group')  }}"
                                            @endif
                                 />
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
                                    <input type="text" class="form-control input-md" id="ssc_institute" name="ssc_institute" placeholder="ssc_institute" 
                                @if( empty( Input::old('ssc_institute')))
                                               value = "{{ empty($ssc[3]) ?'': $ssc[3] }}"
                                            @else
                                                 value="{{ Input::old('ssc_institute')  }}"
                                            @endif
                                 />
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
                                    <input type="text" class="form-control input-md" id="ssc_result" name="ssc_result" placeholder="result" 
                                @if( empty( Input::old('ssc_result')))
                                               value = "{{ empty($ssc[4]) ? '' :$ssc[4] }}"
                                            @else
                                                 value="{{ Input::old('ssc_result')  }}"
                                            @endif
                                 />
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
                                        @for( $i = 2020  ; $i >= 1964 ; $i-- )
                                            <option value="{{$i}}" selected="{{ $ssc[2] == $i ? 'selected': ''}}" > {{ $i }} </option>
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
                                    <input type="text" class="form-control input-md" id="hsc_group" name="hsc_group" placeholder="" 
                                @if( empty( Input::old('hsc_group')))
                                               value = "{{ empty($hsc[1]) ? '' : $hsc[1] }}"
                                            @else
                                                 value="{{ Input::old('hsc_group')  }}"
                                            @endif
                                 />
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
                                    <input type="text" class="form-control input-md" id="hsc_institute" name="hsc_institute" placeholder="" 
                                @if( empty( Input::old('hsc_institute')))
                                               value = "{{ empty($hsc[3]) ? '' : $hsc[3] }}"
                                            @else
                                                 value="{{ Input::old('hsc_institute')  }}"
                                            @endif
                                 />
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
                                    <input type="text" class="form-control input-md" id="hsc_result" name="hsc_result" placeholder="result" 
                                @if( empty( Input::old('hsc_result')))
                                               value = "{{ empty($hsc[3]) ? '' : $hsc[3] }}"
                                            @else
                                                 value="{{ Input::old('hsc_result')  }}"
                                            @endif
                                 />
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
                                            <option value="{{$i}}">{{$i}}</option>
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
                                    <input type="text" class="form-control input-md" id="hons_group" name="hons_group" placeholder="" 
                                @if( empty( Input::old('hons_group')))
                                               value = "{{ empty($hons[1]) ? '' : $hons[1] }}"
                                            @else
                                                 value="{{ Input::old('hons_group')  }}"
                                            @endif
                                 />
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
                                    <input type="text" class="form-control input-md" id="hons_institute" name="hons_institute" placeholder="" 
                                @if( empty( Input::old('hons_institute')))
                                               value = "{{ empty($hons[2]) ? '' : $hons[2] }}"
                                            @else
                                                 value="{{ Input::old('hons_institute')  }}"
                                            @endif
                                 />
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
                                    <input type="text" class="form-control input-md" id="hons_result" name="hons_result" placeholder="" 
                                @if( empty( Input::old('hons_result')))
                                               value = "{{ empty($hons[3]) ? '' : $hons[3] }}"
                                            @else
                                                 value="{{ Input::old('hons_result')  }}"
                                            @endif
                                 />
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
                                            <option value="{{$i}}">{{$i}}</option>
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
                                    <input type="text" class="form-control input-md" id="master_group" name="master_group" placeholder="" 
                                @if( empty( Input::old('master_group')))
                                               value = "{{ empty($masters[1]) ? '' : $masters[1] }}"
                                            @else
                                                 value="{{ Input::old('master_group')  }}"
                                            @endif
                                 />
                                </div>
                                @if ($errors->has('master_group'))
                                 <p class="text-right text-danger">{{$errors->first('master_group')}}</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="master_institute">Institute Name:</label>
                                    <input type="text" class="form-control input-md" id="master_institute" name="master_institute" placeholder="" 
                                @if( empty( Input::old('master_institute')))
                                               value = " {{ empty($masters[2]) ? '' : $masters[2] }} "
                                            @else
                                                 value="{{ Input::old('master_institute')  }}"
                                            @endif
                                 />
                                </div>
                                @if ($errors->has('fb'))
                                 <p class="text-right text-danger">{{$errors->first('fb')}}</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="master_result">Result</label>
                                    <input type="text" class="form-control input-md" id="master_result" name="master_result" placeholder="result" @if( empty( Input::old('master_result')))
                                               value = " {{ empty($masters[3]) ? '' : $masters[3] }} "
                                            @else
                                                 value="{{ Input::old('master_result')  }}"
                                            @endif
                                 />
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
                                            <option value="{{$i}}" {{  }}>{{$i}}</option>
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
                            <textarea class="form-control" rows="5" placeholder="marks......" name="marks" id="marks">@if( empty( Input::old('marks'))) {{ $profile_edit->marks }}@else
                                                 {{ Input::old('marks')  }}@endif</textarea>
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
                                        <label for="house_no">Flat No :</label>
                                        <input type="text" class="form-control input-sm" id="flat_no" name="flat_no" placeholder="flat no.." 
                                            @if( empty( Input::old('flat_no')))
                                               value = "{{ empty($pre_add[0]) ? '' : $pre_add[0] }}"
                                            @else
                                                 value="{{ Input::old('flat_no')  }}"
                                            @endif
                                 />
                                    </div>
                                        @if ($errors->has('flat_no'))
                                         <p class="text-right text-danger">{{$errors->first('flat_no')}}</p>
                                        @endif
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group ">
                                    <div class="fg-line">
                                        <label for="house_no">House No :</label>
                                        <input type="text" class="form-control input-sm" id="house_no" name="house_no" placeholder="house_no.." 
                                            @if( empty( Input::old('house_no')))
                                               value = "{{ empty($pre_add[0]) ? '' : $pre_add[0] }}"
                                            @else
                                                 value="{{ Input::old('house_no')  }}"
                                            @endif
                                 />
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
                                        <input type="text" class="form-control input-sm" id="road_no" name="road_no" placeholder="road no.." 
                                @if( empty( Input::old('road_no')))
                                               value = "{{ empty($pre_add[1]) ? '' : $pre_add[1] }}"
                                            @else
                                                 value="{{ Input::old('road_no')  }}"
                                            @endif
                                 />
                                    </div>
                                        @if ($errors->has('road_no'))
                                         <p class="text-right text-danger">{{$errors->first('road_no')}}</p>
                                        @endif
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group ">
                                    <div class="fg-line">
                                        <label for="po">P.O :</label>
                                        <input type="text" class="form-control input-sm" id="po" name="po" placeholder="P.O" 
                                @if( empty( Input::old('po')))
                                               value = "{{ empty($pre_add[2]) ? '' : $pre_add[2]}}"
                                            @else
                                                 value="{{ Input::old('po')  }}"
                                            @endif
                                 />
                                    </div>
                                    @if ($errors->has('po'))
                                     <p class="text-right text-danger">{{$errors->first('po')}}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group ">
                                    <div class="fg-line">
                                        <label for="ps">P.S:</label>
                                        <input type="text" class="form-control input-sm" id="ps" name="ps" placeholder="P.S" 
                                @if( empty( Input::old('ps')))
                                               value = " {{ empty($pre_add[3]) ? '' : $pre_add[3] }} "
                                            @else
                                                 value="{{ Input::old('ps')  }}"
                                            @endif
                                 />
                                    </div>
                                    @if ($errors->has('ps'))
                                     <p class="text-right text-danger">{{$errors->first('ps')}}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="fg-line">
                                        <div class="select">
                                            <label for="dist">Dist :</label>
                                            <select class="form-control" name="dist">
                                                <option value="{{empty($pre_add[4]) ? '' : $pre_add[4]}}"> {{empty($pre_add[4]) ? '' : $pre_add[4]}}</option>
                                                
                                                <option value="Bagerhat">Bagerhat</option>
                                                <option value="Barisal">Barisal</option>
                                                <option value="Bandarban">Bandarban</option>
                                                <option value="Borguna">Borguna</option>
                                                <option value="Bhola">Bhola</option>
                                                <option value="Brahman-baria">Brahman-baria</option>
                                                <option value="Bogra">Bogra</option>
                                                <option value="Chandpur">Chandpur</option>
                                                <option value="Chapai Nawabganj">Chapai Nawabganj</option>
                                                <option value="Chawmuhani">Chawmuhani</option>
                                                <option value="Chittagong">Chittagong</option>
                                                <option value="Chuadanga">Chuadanga</option>
                                                <option value="Comilla">Comilla</option>
                                                <option value="Cox’s Bazar">Cox’s Bazar</option>
                                                <option value="Dawlatpur">Dawlatpur</option>
                                                <option value="Dhaka">Dhaka</option>
                                                <option value="Dinajpur">Dinajpur</option>
                                                <option value="Faridpur">Faridpur</option>
                                                <option value="Feni">Feni</option>
                                                <option value="Gaibanda">Gaibanda</option>
                                                <option value="Gopalganj">Gopalganj</option>
                                                <option value="Habiganj">Habiganj</option>
                                                <option value="Ishwardi">Ishwardi</option>
                                                <option value="Jamalpur">Jamalpur</option>
                                                <option value="Jessore">Jessore</option>
                                                <option value="Jhalakathi">Jhalakathi</option>
                                                <option value="Jhenaidah">Jhenaidah</option>
                                                <option value="Joydebpur">Joydebpur</option>
                                                <option value="Joypurhat">Joypurhat</option>
                                                <option value="Kaptai">Kaptai</option>
                                                <option value="Khargrachhari">Khargrachhari</option>
                                                <option value="Khulna">Khulna</option>
                                                <option value="Kishoregonj">Kishoregonj</option>
                                                <option value="Kurigram">Kurigram</option>
                                                <option value="Kushtia">Kushtia</option>
                                                <option value="Madaripur">Madaripur</option>
                                                <option value="Manikgonj">Manikgonj</option>
                                                <option value="Manikgonj">Manikgonj</option>
                                                <option value="Manikgonj">Manikgonj</option>
                                                <option value="Maijdee">Maijdee</option>
                                                <option value="Meherpur">Meherpur</option>
                                                <option value="Mirzapur">Mirzapur</option>
                                                <option value="Mongla">Mongla</option>
                                                <option value="Moulvi-Bazar">Moulvi-Bazar</option>
                                                <option value="Mymensingh">Mymensingh</option>
                                                <option value="Narail">Narail</option>
                                                <option value="Narshingdi">Narshingdi</option>
                                                <option value="Natore">Natore</option>
                                                <option value="Netrokona">Netrokona</option>
                                                <option value="Nilfamari">Nilfamari</option>
                                                <option value="Noakhali">Noakhali</option>
                                                <option value="Pabna">Pabna</option>
                                                <option value="Panchagar">Panchagar</option>
                                                <option value="Rajshahi">Rajshahi</option>
                                                <option value="Rangamati">Rangamati</option>
                                                <option value="Rangpur">Rangpur</option>
                                                <option value="Satkhira">Satkhira</option>
                                                <option value="Shantahar">Shantahar</option>
                                                <option value="Shariatpur">Shariatpur</option>
                                                <option value="Sherpur">Sherpur</option>
                                                <option value="Sirajgong">Sirajgong</option>
                                                <option value="Shrimongal">Shrimongal</option>
                                                <option value="Sunamgonj">Sunamgonj</option>
                                                <option value="Sylhet">Sylhet</option>
                                                <option value="Tangail">Tangail</option>
                                                <option value="Thakurgaon">Thakurgaon</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                    @if ($errors->has('dist'))
                                     <p class="text-right text-danger">{{$errors->first('dist')}}</p>
                                    @endif
                            </div>


                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Permanant Address:</h3>
                            <div class="col-md-3">
                                <div class="form-group ">
                                    <div class="fg-line">
                                        <label for="village">Village :</label>
                                        <input type="text" class="form-control input-sm" id="village" name="village" placeholder="village.." 
                                @if( empty( Input::old('village')))
                                               value = " {{ empty($per_add[0]) ? '' : $per_add[0] }} "
                                            @else
                                                 value="{{ Input::old('village')  }}"
                                            @endif
                                 />
                                    </div>
                                    @if ($errors->has('village'))
                                     <p class="text-right text-danger">{{$errors->first('village')}}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group ">
                                    <div class="fg-line">
                                        <label for="per_po">P.O :</label>
                                        <input type="text" class="form-control input-sm" id="per_po" name="per_po" placeholder="P.O" 
                                @if( empty( Input::old('per_po')))
                                               value = " {{ empty($per_add[1]) ? '' : $per_add[1]  }} "
                                            @else
                                                 value="{{ Input::old('per_po')  }}"
                                            @endif
                                 />
                                    </div>
                                    @if ($errors->has('per_po'))
                                     <p class="text-right text-danger">{{$errors->first('per_po')}}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group ">
                                    <div class="fg-line">
                                        <label for="per_ps">P.S:</label>
                                        <input type="text" class="form-control input-sm" id="per_ps" name="per_ps" placeholder="P.S" 
                                @if( empty( Input::old('per_ps')))
                                               value = " {{ empty($per_add[2]) ? '' : $per_add[2]  }} "
                                            @else
                                                 value="{{ Input::old('per_ps')  }}"
                                            @endif
                                 />
                                    </div>
                                    @if ($errors->has('per_ps'))
                                     <p class="text-right text-danger">{{$errors->first('per_ps')}}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="fg-line">
                                        <div class="select">
                                            <label for="per_dist">Dist :</label>
                                            <select class="form-control" name="per_dist">
                                        <option class="{{ empty($per_add[3]) ? '' : $per_add[3]  }}">{{empty($per_add[3]) ? '' : $per_add[3]}} </option>
                                                
                                                <option value="Bagerhat">Bagerhat</option>
                                                <option value="Barisal">Barisal</option>
                                                <option value="Bandarban">Bandarban</option>
                                                <option value="Borguna">Borguna</option>
                                                <option value="Bhola">Bhola</option>
                                                <option value="Brahman-baria">Brahman-baria</option>
                                                <option value="Bogra">Bogra</option>
                                                <option value="Chandpur">Chandpur</option>
                                                <option value="Chapai Nawabganj">Chapai Nawabganj</option>
                                                <option value="Chawmuhani">Chawmuhani</option>
                                                <option value="Chittagong">Chittagong</option>
                                                <option value="Chuadanga">Chuadanga</option>
                                                <option value="Comilla">Comilla</option>
                                                <option value="Cox’s Bazar">Cox’s Bazar</option>
                                                <option value="Dawlatpur">Dawlatpur</option>
                                                <option value="Dhaka">Dhaka</option>
                                                <option value="Dinajpur">Dinajpur</option>
                                                <option value="Faridpur">Faridpur</option>
                                                <option value="Feni">Feni</option>
                                                <option value="Gaibanda">Gaibanda</option>
                                                <option value="Gopalganj">Gopalganj</option>
                                                <option value="Habiganj">Habiganj</option>
                                                <option value="Ishwardi">Ishwardi</option>
                                                <option value="Jamalpur">Jamalpur</option>
                                                <option value="Jessore">Jessore</option>
                                                <option value="Jhalakathi">Jhalakathi</option>
                                                <option value="Jhenaidah">Jhenaidah</option>
                                                <option value="Joydebpur">Joydebpur</option>
                                                <option value="Joypurhat">Joypurhat</option>
                                                <option value="Kaptai">Kaptai</option>
                                                <option value="Khargrachhari">Khargrachhari</option>
                                                <option value="Khulna">Khulna</option>
                                                <option value="Kishoregonj">Kishoregonj</option>
                                                <option value="Kurigram">Kurigram</option>
                                                <option value="Kushtia">Kushtia</option>
                                                <option value="Madaripur">Madaripur</option>
                                                <option value="Manikgonj">Manikgonj</option>
                                                <option value="Manikgonj">Manikgonj</option>
                                                <option value="Manikgonj">Manikgonj</option>
                                                <option value="Maijdee">Maijdee</option>
                                                <option value="Meherpur">Meherpur</option>
                                                <option value="Mirzapur">Mirzapur</option>
                                                <option value="Mongla">Mongla</option>
                                                <option value="Moulvi-Bazar">Moulvi-Bazar</option>
                                                <option value="Mymensingh">Mymensingh</option>
                                                <option value="Narail">Narail</option>
                                                <option value="Narshingdi">Narshingdi</option>
                                                <option value="Natore">Natore</option>
                                                <option value="Netrokona">Netrokona</option>
                                                <option value="Nilfamari">Nilfamari</option>
                                                <option value="Noakhali">Noakhali</option>
                                                <option value="Pabna">Pabna</option>
                                                <option value="Panchagar">Panchagar</option>
                                                <option value="Rajshahi">Rajshahi</option>
                                                <option value="Rangamati">Rangamati</option>
                                                <option value="Rangpur">Rangpur</option>
                                                <option value="Satkhira">Satkhira</option>
                                                <option value="Shantahar">Shantahar</option>
                                                <option value="Shariatpur">Shariatpur</option>
                                                <option value="Sherpur">Sherpur</option>
                                                <option value="Sirajgong">Sirajgong</option>
                                                <option value="Shrimongal">Shrimongal</option>
                                                <option value="Sunamgonj">Sunamgonj</option>
                                                <option value="Sylhet">Sylhet</option>
                                                <option value="Tangail">Tangail</option>
                                                <option value="Thakurgaon">Thakurgaon</option>
                                                


                                            </select>
                                        </div>
                                    </div>
                                </div>
                                    @if ($errors->has('dist'))
                                     <p class="text-right text-danger">{{$errors->first('dist')}}</p>
                                    @endif
                            </div>

                            
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="fg-line">
                            <label for="emergency_contact_number">Emegency Contact No :</label>
                            <input type="text" class="form-control input-sm" id="emergency_contact_number" name="emergency_contact_number" placeholder="emergency contact no"
                            @if( empty( Input::old('emergency_contact_number')))
                                               value = "{{ $profile_edit->emergency_contact_number }}"
                                            @else
                                                 value="{{ Input::old('emergency_contact_number')  }}"
                                            @endif
                            >
                        </div>
                        @if ($errors->has('emergency_contact_number'))
                         <p class="text-right text-danger">{{$errors->first('emergency_contact_number')}}</p>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h2>Emergency Address:</h2>
                            <div class="col-md-2">
                                <div class="form-group ">
                                    <div class="fg-line">
                                        <label for="em_house_no">House No :</label>
                                        <input type="text" class="form-control input-sm" id="em_house_no" name="em_house_no" placeholder="house_no.." 
                                @if( empty( Input::old('em_house_no')))
                                               value = "{{ empty($em_add[0]) ? '' : $em_add[0] }}"
                                            @else
                                                value="{{ Input::old('em_house_no')  }}"
                                            @endif
                                 />
                                    </div>
                                        @if ($errors->has('em_house_no'))
                                         <p class="text-right text-danger">{{$errors->first('em_house_no')}}</p>
                                        @endif
                                </div>
                            </div>
                           <div class="col-md-2">
                                <div class="form-group ">
                                    <div class="fg-line">
                                        <label for="em_road_no">Road No :</label>
                                        <input type="text" class="form-control input-sm" id="em_road_no" name="em_road_no" placeholder="road no.." 
                                @if( empty( Input::old('em_road_no')))
                                               value = "{{ empty($em_add[1]) ? '' : $em_add[1]  }}"
                                            @else
                                                 value="{{ Input::old('em_road_no')  }}"
                                            @endif
                                 />
                                    </div>
                                        @if ($errors->has('em_road_no'))
                                         <p class="text-right text-danger">{{$errors->first('em_road_no')}}</p>
                                        @endif
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group ">
                                    <div class="fg-line">
                                        <label for="em_po">P.O :</label>
                                        <input type="text" class="form-control input-sm" id="em_po" name="em_po" placeholder="P.O" 
                                @if( empty( Input::old('em_po')))
                                               value = "{{ empty($em_add[2]) ? '' : $em_add[2] }}"
                                            @else
                                                 value="{{ Input::old('em_po')  }}"
                                            @endif
                                 />
                                    </div>
                                    @if ($errors->has('em_po'))
                                     <p class="text-right text-danger">{{$errors->first('em_po')}}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group ">
                                    <div class="fg-line">
                                        <label for="em_ps">P.S:</label>
                                        <input type="text" class="form-control input-sm" id="em_ps" name="em_ps" placeholder="P.S" 
                                @if( empty( Input::old('em_ps')))
                                               value = "{{ empty($em_add[3]) ? '' : $em_add[3] }}"
                                            @else
                                                 value="{{ Input::old('em_ps')  }}"
                                            @endif
                                 />
                                    </div>
                                    @if ($errors->has('em_ps'))
                                     <p class="text-right text-danger">{{$errors->first('em_ps')}}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="fg-line">
                                        <div class="select">
                                            <label for="em_dist">Dist :</label>
                                            <select class="form-control" name="em_dist">
                                                <option value="{{ empty($em_add[4]) ? '' : $em_add[4] }}">{{ empty($em_add[4]) ? '' : $em_add[4] }}</option>
                                                
                                                <option value="Bagerhat">Bagerhat</option>
                                                <option value="Barisal">Barisal</option>
                                                <option value="Bandarban">Bandarban</option>
                                                <option value="Borguna">Borguna</option>
                                                <option value="Bhola">Bhola</option>
                                                <option value="Brahman-baria">Brahman-baria</option>
                                                <option value="Bogra">Bogra</option>
                                                <option value="Chandpur">Chandpur</option>
                                                <option value="Chapai Nawabganj">Chapai Nawabganj</option>
                                                <option value="Chawmuhani">Chawmuhani</option>
                                                <option value="Chittagong">Chittagong</option>
                                                <option value="Chuadanga">Chuadanga</option>
                                                <option value="Comilla">Comilla</option>
                                                <option value="Cox’s Bazar">Cox’s Bazar</option>
                                                <option value="Dawlatpur">Dawlatpur</option>
                                                <option value="Dhaka">Dhaka</option>
                                                <option value="Dinajpur">Dinajpur</option>
                                                <option value="Faridpur">Faridpur</option>
                                                <option value="Feni">Feni</option>
                                                <option value="Gaibanda">Gaibanda</option>
                                                <option value="Gopalganj">Gopalganj</option>
                                                <option value="Habiganj">Habiganj</option>
                                                <option value="Ishwardi">Ishwardi</option>
                                                <option value="Jamalpur">Jamalpur</option>
                                                <option value="Jessore">Jessore</option>
                                                <option value="Jhalakathi">Jhalakathi</option>
                                                <option value="Jhenaidah">Jhenaidah</option>
                                                <option value="Joydebpur">Joydebpur</option>
                                                <option value="Joypurhat">Joypurhat</option>
                                                <option value="Kaptai">Kaptai</option>
                                                <option value="Khargrachhari">Khargrachhari</option>
                                                <option value="Khulna">Khulna</option>
                                                <option value="Kishoregonj">Kishoregonj</option>
                                                <option value="Kurigram">Kurigram</option>
                                                <option value="Kushtia">Kushtia</option>
                                                <option value="Madaripur">Madaripur</option>
                                                <option value="Manikgonj">Manikgonj</option>
                                                <option value="Manikgonj">Manikgonj</option>
                                                <option value="Manikgonj">Manikgonj</option>
                                                <option value="Maijdee">Maijdee</option>
                                                <option value="Meherpur">Meherpur</option>
                                                <option value="Mirzapur">Mirzapur</option>
                                                <option value="Mongla">Mongla</option>
                                                <option value="Moulvi-Bazar">Moulvi-Bazar</option>
                                                <option value="Mymensingh">Mymensingh</option>
                                                <option value="Narail">Narail</option>
                                                <option value="Narshingdi">Narshingdi</option>
                                                <option value="Natore">Natore</option>
                                                <option value="Netrokona">Netrokona</option>
                                                <option value="Nilfamari">Nilfamari</option>
                                                <option value="Noakhali">Noakhali</option>
                                                <option value="Pabna">Pabna</option>
                                                <option value="Panchagar">Panchagar</option>
                                                <option value="Rajshahi">Rajshahi</option>
                                                <option value="Rangamati">Rangamati</option>
                                                <option value="Rangpur">Rangpur</option>
                                                <option value="Satkhira">Satkhira</option>
                                                <option value="Shantahar">Shantahar</option>
                                                <option value="Shariatpur">Shariatpur</option>
                                                <option value="Sherpur">Sherpur</option>
                                                <option value="Sirajgong">Sirajgong</option>
                                                <option value="Shrimongal">Shrimongal</option>
                                                <option value="Sunamgonj">Sunamgonj</option>
                                                <option value="Sylhet">Sylhet</option>
                                                <option value="Tangail">Tangail</option>
                                                <option value="Thakurgaon">Thakurgaon</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                    @if ($errors->has('em_dist'))
                                     <p class="text-right text-danger">{{$errors->first('em_dist')}}</p>
                                    @endif
                            </div>


                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-4">
                                <h4 class="c-black f-500 ">Date of Join</h4>
                                <div class="input-group form-group">
                                    <span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
                                        <div class="dtp-container">
                                            <input type='text' class="form-control date-picker" placeholder="Click here..." name="date_of_join"
                            @if( empty( Input::old('date_of_join')))
                                               value = "{{ $profile_edit->date_of_join }}"
                                            @else
                                                 value="{{ Input::old('date_of_join')  }}"
                                            @endif
                            >
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
                                    <h4>Designation</h4>
                                    <select class="form-control" name="designation_id">
                                        @foreach( $designation as $data)
                                        <option value="{{ $data->id }}" selected  >{{$data->designation_name }}</option>
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
                                        <h4>Shift</h4>
                                        <select class="form-control" name="shift">
                                            <option></option>
                                            @foreach( $shift as $data)
                                            <option value="{{ $data->id }}" selected >{{ date('h-i a', strtotime($data->start)) }} to {{ date('h-i a', strtotime($data->end)) }}</option>
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
                            <textarea class="form-control" rows="5" placeholder="permanant address......" name="previous_record" id="previous_record"></textarea>
                        </div>
                        @if ($errors->has('previous_record'))
                         <p class="text-right text-danger">{{$errors->first('previous_record')}}</p>
                        @endif
                    </div>
                    <div class="form-group ">
                        <div class="fg-line">
                            <label for="reference">Referenc </label>
                            <textarea class="form-control" rows="5" placeholder="permanant address......" name="reference" id="reference"></textarea>
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
                
            </form>
        </div>
    </div>

@endsection