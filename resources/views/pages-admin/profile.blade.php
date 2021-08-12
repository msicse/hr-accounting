@extends('layout.admin')
@section('title','Admin | Profile Details')
@section('contentBody')
<div class="card" id="profile-main">
                        <div class="pm-overview c-overflow">

                            <div class="pmo-pic">
                                <div class="p-relative">
                                    <img class="img-responsive" src="{{ url('uploads/profile_pic', $profile->profile_pic ) }}" alt="">
                                </div>
                            </div>

                            <div class="pmo-block pmo-contact hidden-xs">
                                <h2>Contact</h2>

                                <ul>
                                    <li><i class="zmdi zmdi-phone"></i> {{ $profile->phone }}</li>
                                    <li><i class="zmdi zmdi-email"></i> {{ $profile->email }}</li>
                                    <li><i class="zmdi zmdi-facebook-box"></i> {{ $profile->fb }}</li>
                                    <li><i class="zmdi zmdi-skype"></i> {{ $profile->skype }}</li>
                                    <li>
                                        <i class="zmdi zmdi-pin"></i>
                                        <address class="m-b-0 ng-binding">
                                            {{ $profile->present_address }}
                                        </address>
                                    </li>
                                    <li>
                                        <i class="zmdi zmdi-pin"></i>Permanant Address <br>
                                        <address class="m-b-0 ng-binding">
                                            {{ $profile->permanent_address }}
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
                                       {{ $profile->marks }}
                                    </div>
                                
                                </div>
                            </div>

                            <div class="pmb-block">
                                <div class="pmbb-header">
                                    <h2><i class="zmdi zmdi-account m-r-10"></i> Basic Information</h2>
                                </div>
                                <div class="pmbb-body p-l-30">
                                    <div class="pmbb-view">
                                        <dl class="dl-horizontal">
                                            <dt>Full Name</dt>
                                            <dd>{{ $profile->first_name }}  {{ $profile->middle_name }} {{ $profile->last_name }}</dd>
                                        </dl>
                                        
                                        <dl class="dl-horizontal">
                                            <dt>Designation</dt>
                                            <dd>{{ $profile->designation_name }}</dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt>Father Name</dt>
                                            <dd>{{ $profile->father_name }}</dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt>Mother Name</dt>
                                            <dd>{{ $profile->mother_name }}</dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt>Gender</dt>
                                            <dd>
                                                @if( $profile->gender == 1 )
                                                    Male
                                                @else
                                                    Female
                                                @endif
                                            </dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt>Blood Group</dt>
                                            <dd>
                                            @if( $profile->gender == 1 )
                                                    A+
                                                @elseif( $profile->gender == 2 )
                                                   A-
                                                @elseif( $profile->gender == 3 )
                                                    B+
                                                @elseif( $profile->gender == 4 )
                                                    B-
                                                @elseif( $profile->gender == 5 )
                                                    AB+
                                                @elseif( $profile->gender == 6 )
                                                    AB-
                                                @elseif( $profile->gender == 7 )
                                                    O+
                                                @else
                                                   O-
                                                @endif</dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt>Martial Status</dt>
                                            <dd>
                                            @if( $profile->maritial_status == 1 )
                                                Married
                                            @else
                                                Unmarried
                                            @endif
                                            

                                            </dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt>Date Of Birth</dt>
                                            <dd>{{ date(' M j, Y',strtotime($profile->date_of_birth)) }}</dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt>Religion</dt>
                                            <dd>
                                                @if( $profile->religion == 1 )
                                                    Islam
                                                @elseif( $profile->religion == 2 )
                                                    Hinduism
                                                @elseif( $profile->religion == 3 )
                                                    Buddhism
                                                @elseif( $profile->religion == 4 )
                                                    Christianity
                                                @else
                                                    Others
                                                @endif


                                            </dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt>National Id</dt>
                                            <dd>{{ $profile->nid }}</dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt>Date of Join</dt>
                                            <dd>{{ date(' M j, Y',strtotime($profile->date_of_join)) }}</dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt>Shift</dt>
                                            <dd>{{ date('H:ia',strtotime($profile->start)) }} To {{ date('H:ia',strtotime($profile->end)) }}</dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt>Previous Employee Record</dt>
                                            <dd>{{ $profile->previous_record }}</dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt>Reference</dt>
                                            <dd>{{ $profile->reference }}</dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt>NID Copy </dt>
                                            <dd>
                                            <img class="img-responsive" src="{{ url('uploads/nid_upload', $profile->nid_upload ) }}" alt="" />
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
                                            <dd>{{ $profile->emergency_contact_number }} </dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <dt>Address</dt>
                                            <dd> {{ $profile->emergency_address  }}</dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>

                           
                        </div>
                    </div>
@endsection