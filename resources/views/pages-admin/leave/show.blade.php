@extends('layout.admin')
@section('title','Admin | Leave Request')
@section('contentBody')
	<div class="card">
        <div class="card-header">
            <h2>Leave Request View</h2>
        </div>
        <div class="card-body card-padding">
           <div class="table-responsive">
                <table class="table table-bordered">
                        <tr>
                            <th>Name</th>
                            <td>{{ $leave->name}}</td>
                        </tr>
                        <tr>
                            <th>Designation</th>
                            <td>{{ $leave->designation }}</td>
                        </tr>
                        <tr>
                            <th>Leave Details</th>
                            <td>
                            @if( $leave->leave_from == $leave->leave_from )
                                {{ date('M j, Y', strtotime( $leave->leave_from )) }}
                            @else
                            {{ date('M j, Y', strtotime( $leave->leave_from )) }} To {{ date('M j, Y', strtotime( $leave->leave_to )) }}
                            @endif
                             <br>
                            Total Days:
                            <?php 
                                $start = strtotime( $leave->leave_from );
                                $end = strtotime($leave->leave_to);
                                $days_between = ceil(abs($end - $start) / 86400);
                                if ( $days_between >1 ) {
                                    echo $days_between;
                                }else {
                                    echo 1;
                                }
                                
                            ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Rejoining Date</th>
                            <td>{{ date('M j, Y', strtotime($leave->rejoin_date)) }}</td>
                        </tr>
                        <tr>
                            <th>Contact No</th>
                            <td>{{ $leave->contact_no }}</td>
                        </tr>
                        <tr>
                            <th>Contact Address</th>
                            <td>{{ $leave->contact_address }}</td>
                        </tr>
                        <tr>
                            <th>Recommended </th>
                            <td>{{ $leave->recommened }}</td>
                        </tr>
                        <form action="{{url('leave',$leave->id)}}" method="post">
                            <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <tr>
                                <th>Sanctioned</th>
                                <td>
                                <div class="form-group margin-top-40">
                                    <div class="fg-line ">
                                        <label class="radio radio-inline m-r-20">
                                            <input type="radio" name="sanctioned" value="1"
                                                @if( $leave->sanctioned == 1 )
                                                    {{'checked'}}
                                                
                                                @endif
                                            >
                                            
                                                <i class="input-helper"></i>Sanctioned
                                        </label>
                                        <label class="radio radio-inline m-r-20">
                                            <input type="radio" name="sanctioned" value="0"
                                                @if( $leave->sanctioned == 0 )
                                                    {{'checked'}}
                                                @endif

                                            >
                                                <i class="input-helper"></i>Not Sanctioned
                                        </label>
                                    </div>       
                                </div>
                                </th>
                            </tr>
                            <tr>
                                <td colspan="2" class="text-center">
                                    <button type="submit" class="btn btn-primary "> Apporved </button>
                                </td>
                            </tr>
                        </form>
           </table>
        </div>
        </div>
    </div>

@endsection