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
                                Year : {{ $leave->year }} <br>
                                Month : {{ $leave->month }} <br>
                                Days : {{ $leave->days }}
                             <br>
                            Total Days:
                                {{ $leave->total_days }}
                            </td>
                        </tr>
                        <tr>
                            <th>Rejoining Date</th>
                            <td>{{ $leave->rejoin_date }}</td>
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
                            <tr>
                                <th>Sanctioned</th>
                                <td>
                                <div class="form-group margin-top-40">
                                    <div class="fg-line ">
                                        <label class="radio radio-inline m-r-20">
                                            <input type="radio" name="sanctioned" value="1" disabled 
                                                @if( $leave->sanctioned == 1 )
                                                    {{'checked'}}
                                                
                                                @endif
                                            >
                                            
                                                <i class="input-helper"></i>Sanctioned
                                        </label>
                                        <label class="radio radio-inline m-r-20">
                                            <input type="radio" name="sanctioned" value="0" disabled 
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
           </table>
        </div>
        </div>
    </div>

@endsection