@extends('layout.admin')
@section('title','Admin | Profile Details')
@section('contentBody')
<div class="card" id="profile-main">
                        <div class="pm-overview c-overflow">

                            <div class="pmo-pic">
                                <div class="p-relative">
                                    <img class="img-responsive" src="{{ url('uploads/profile_pic', $profile_view->profile_pic ) }}" alt="">
                                </div>
                            </div>

                            <div class="pmo-block pmo-contact hidden-xs">
                                <h2>Contact</h2>

                                <ul>
                                    <li><i class="zmdi zmdi-phone"></i> {{ $profile_view->phone }}</li>
                                    <li><i class="zmdi zmdi-email"></i> {{ $profile_view->email }}</li>
                                    <li><i class="zmdi zmdi-facebook-box"></i> {{ $profile_view->fb }}</li>
                                    <li><i class="zmdi zmdi-skype"></i> {{ $profile_view->skype }}</li>
                                    <li>
                                        <i class="zmdi zmdi-pin"></i>
                                        <address class="m-b-0 ng-binding">
                                            {{ $profile_view->present_address }}
                                        </address>
                                    </li>
                                    <li>
                                        <i class="zmdi zmdi-pin"></i>Permanant Address <br>
                                        <address class="m-b-0 ng-binding">
                                            {{ $profile_view->permanent_address }}
                                        </address>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="pm-body clearfix">
                            <div class="pmb-block">
                                <div class="pmbb-header">
                                    <h2><i class="zmdi zmdi-equalizer m-r-10"></i> Marks </h2>
                                </div>
                                <div class="pmbb-body p-l-30">
                                    <div class="pmbb-view">
                                       {{ $profile_view->marks }}
                                    </div>
                                
                                </div>
                            </div>

                            <div class="pmb-block">
                                <div class="pmbb-header">
                                    <h2><i class="zmdi zmdi-account m-r-10"></i> Educational Qualification </h2>
                                </div>
                                <div class="pmbb-body p-l-30">
                                        <h4>SSC</h4>
                                        <hr>
                                        <dl class="dl-horizontal">
                                            <?php 
                                               $ssc = explode(",",$profile_view->ssc);
                                               $hsc = explode(",",$profile_view->hsc);
                                               $hons = explode(",",$profile_view->hons);
                                               $masters = explode(",",$profile_view->masters);
                                            ?>

                                            <dt>Concentration/ Major/Group:</dt>
                                            <dd>{{ empty($ssc[1]) ? "" : $ssc[1] }}</dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt>Institute Name:</dt>
                                            <dd>{{ empty($ssc[3]) ? "" : $ssc[3] }}</dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt>Result:</dt>
                                            <dd>{{ empty($ssc[4]) ? "" : $ssc[4] }}</dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt>Passing Year:</dt>
                                            <dd>{{ empty($ssc[2]) ? "" : $ssc[2] }}</dd>
                                        </dl>


                                            <h4>HSC</h4>
                                            <hr>
                                        <dl class="dl-horizontal">
                                            <dt>Concentration/ Major/Group:</dt>
                                            <dd>{{ empty($hsc[1]) ? "" : $hsc[1] }}</dd>
                                        </dl>
                                        <dl class="dl-horizontal">

                                            <dt>Institute Name:</dt>
                                            <dd>{{ empty($hsc[3]) ? "" : $hsc[3] }}</dd>
                                        </dl>
                                        <dl class="dl-horizontal">

                                            <dt>Result:</dt>
                                            <dd>{{ empty($hsc[4]) ? "" : $hsc[4] }}</dd>
                                        </dl>
                                        <dl class="dl-horizontal">

                                            <dt>Passing Year:</dt>
                                            <dd>{{ empty($hsc[2]) ? "" : $hsc[2] }}</dd>
                                        </dl>

                                
                                            <h4>Hons</h4>
                                            <hr>
                                        <dl class="dl-horizontal">
                                            <dt>Concentration/ Major/Group:</dt>
                                            <dd>{{ empty($hons[1]) ? "" : $hons[1] }}</dd>
                                        </dl>
                                        <dl class="dl-horizontal">

                                            <dt>Institute Name:</dt>
                                            <dd>{{ empty($hons[3]) ? "" : $hons[3] }}</dd>
                                        </dl>
                                        <dl class="dl-horizontal">

                                            <dt>Result:</dt>
                                            <dd>{{ empty($hons[4]) ? "" : $hons[4] }}</dd>
                                        </dl>
                                        <dl class="dl-horizontal">

                                            <dt>Passing Year:</dt>
                                            <dd>{{ empty($hons[2]) ? "" : $hons[2] }}</dd>
                                        </dl>

                                            <h4>Masters</h4>
                                            <hr>
                                        <dl class="dl-horizontal">

                                            <dt>Concentration/ Major/Group:</dt>
                                            <dd>{{ empty($masters[1]) ? '' : $masters[1] }}</dd>
                                        </dl>
                                        <dl class="dl-horizontal">

                                            <dt>Institute Name:</dt>
                                            <dd>{{ empty($masters[3]) ? '' : $masters[3] }}</dd>
                                        </dl>
                                        <dl class="dl-horizontal">

                                            <dt>Result:</dt>
                                            <dd>{{ empty($masters[4]) ? '' : $masters[4] }}</dd>
                                        </dl>
                                        <dl class="dl-horizontal">

                                            <dt>Passing Year:</dt>
                                            <dd>{{ empty($masters[2]) ? '' : $masters[2] }}</dd>

                                        </dl>


                                </div>
                            </div>

                            <div class="pmb-block">
                                <div class="pmbb-header">
                                    <h2><i class="zmdi zmdi-account m-r-10"></i> Basic Information</h2>
                                </div>
                                <div class="pmbb-body p-l-30">
                                    <div class="pmbb-view">
                                        <dl class="dl-horizontal">
                                            <dt>Employee Id</dt>
                                            <dd>{{ $profile_view->employee_id }}</dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt>Salary</dt>
                                            <dd>{{ $profile_view->salary }}</dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt>Full Name</dt>
                                            <dd>{{ $profile_view->first_name }} {{ $profile_view->middle_name }} {{ $profile_view->last_name }}</dd>
                                        </dl>
                                        
                                        <dl class="dl-horizontal">
                                            <dt>Designation</dt>
                                            <dd>{{ $profile_view->designation_name }}</dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt>Father Name</dt>
                                            <dd>{{ $profile_view->father_name }}</dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt>Mother Name</dt>
                                            <dd>{{ $profile_view->mother_name }}</dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt>Gender</dt>
                                            <dd>
                                                @if( $profile_view->gender == 1 )
                                                    Male
                                                @else
                                                    Female
                                                @endif
                                            </dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt>Blood Group</dt>
                                            <dd>
                                            @if( $profile_view->gender == 1 )
                                                    A+
                                                @elseif( $profile_view->gender == 2 )
                                                   A-
                                                @elseif( $profile_view->gender == 3 )
                                                    B+
                                                @elseif( $profile_view->gender == 4 )
                                                    B-
                                                @elseif( $profile_view->gender == 5 )
                                                    AB+
                                                @elseif( $profile_view->gender == 6 )
                                                    AB-
                                                @elseif( $profile_view->gender == 7 )
                                                    O+
                                                @else
                                                   O-
                                                @endif</dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt>Martial Status</dt>
                                            <dd>
                                            @if( $profile_view->maritial_status == 1 )
                                                Married
                                            @else
                                                Unmarried
                                            @endif
                                            

                                            </dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt>Date Of Birth</dt>
                                            <dd>
                                            @if( !empty($profile_view->date_of_birth))
                                            {{ date(' M j, Y',strtotime($profile_view->date_of_birth)) }}
                                            @endif
                                            </dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt>Religion</dt>
                                            <dd>
                                                @if( $profile_view->religion == 1 )
                                                    Islam
                                                @elseif( $profile_view->religion == 2 )
                                                    Hinduism
                                                @elseif( $profile_view->religion == 3 )
                                                    Buddhism
                                                @elseif( $profile_view->religion == 4 )
                                                    Christianity
                                                @else
                                                    Others
                                                @endif


                                            </dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt>National Id</dt>
                                            <dd>{{ $profile_view->nid }}</dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt>Date of Join</dt>
                                            <dd>
                                            @if( !empty($profile_view->date_of_join))
                                            {{ date(' M j, Y',strtotime($profile_view->date_of_join)) }}
                                            @endif
                                            </dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt>Shift</dt>
                                            <dd>
                                            {{ date('H:ia', strtotime($profile_view->start)) }} To {{ date('H:ia', strtotime($profile_view->end)) }}
                                            </dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt>Previous Employee Record</dt>
                                            <dd>{{ $profile_view->previous_record }}</dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt>Reference</dt>
                                            <dd>{{ $profile_view->reference }}</dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt>NID Copy </dt>
                                            <dd>
                                            <img class="img-responsive" src="{{ url('uploads/nid_upload', $profile_view->nid_upload ) }}" alt="" />
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                            <div class="pmb-block">
                                <div class="pmbb-header">
                                    <h2><i class="zmdi zmdi-phone m-r-10"></i> Emergency Information</h2>
                                </div>
                                <div class="pmbb-body p-l-30">
                                    <div class="pmbb-view">
                                        <dl class="dl-horizontal">
                                            <dt>Contact No.</dt>
                                            <dd>{{ $profile_view->emergency_contact_number }} </dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt>Address</dt>
                                            <dd> {{ $profile_view->emergency_address  }}</dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>

                           
                        </div>
                    </div>
@endsection