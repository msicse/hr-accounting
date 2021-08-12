@extends('layout.admin')
@section('title','performance')
@section('contentBody')
    <div class="card">
    @if (Session::has('message'))
        <div class="alert alert-success">{{ Session::get('message') }}</div>
    @endif
        <div class="card-header">
            <h2>Performance Of {{ $performance->name }} </h2>
        </div>
        <div class="card-body table-responsive">
            <table class="table">
                <tbody>
                    <tr>
                        <th>#</th>
                        <td>{{ $performance->id }}</td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td>{{ $performance->name }}</td>
                    </tr>
                    <tr>
                        <th>Month</th>
                        <td>{{ $performance->month }}</td>
                    </tr>
                    <tr>
                        <th>Date</th>
                        <td>{{ date('M j, Y', strtotime($performance->start_date)) }} To {{ date('M j, Y', strtotime($performance->end_date)) }}</td>
                    </tr>
                    <tr>
                        <th>Working Report</th>
                        <td>{{ $performance->working_report }}</td>
                    </tr>
                    <tr>
                        <th>Achivement</th>
                        <td>{{ $performance->achivement }}</td>
                    </tr>
                    <tr>
                        <th>Goal</th>
                        <td>{{ $performance->goal}}</td>
                    </tr>
                    <tr>
                        <th>Goal</th>
                        <td>{{ $performance->goal_report }}</td>
                    </tr>
                    <tr>
                        <th>Target</th>
                        <td>{{ $performance->target }}</td>
                    </tr>
                    <tr>
                        <th>Present</th>
                        <td>{{ $performance->present }}</td>
                    </tr>
                    <tr>
                        <th>Absent</th>
                        <td>{{ $performance->absent }}</td>
                    </tr>
                    <tr>
                        <th>Leave</th>
                        <td>{{ $performance->leave }}</td>
                    </tr>
                    <tr>
                        <th>Payment</th>
                        <td>{{ $performance->payment }}</td>
                    </tr>
                    <tr>
                        <th>Bonus</th>
                        <td>{{ $performance->bonus }}</td>
                    </tr>
                    <tr>
                        <th>Overtime</th>
                        <td>{{ $performance->overtime }}</td>
                    </tr>
                    <tr>
                        <th>Due Work Time</th>
                        <td>{{ $performance->due_work_time }}</td>
                    </tr>
                    <tr>
                        <th>GapTime</th>
                        <td>{{ $performance->gap_time }}</td>
                    </tr>
                    <tr>
                        <th>Complain</th>
                        <td>{{ $performance->complain }}</td>
                    </tr>
                    <tr>
                        <th>Remark</th>
                        <td>{{ $performance->remark }}</td>
                    </tr>
                    <tr >
                        <td colspan="2" class="text-center">
                            <a href="{{ url('performance', [$performance->id,'edit']) }}" class="btn btn-primary btn-lg ">Edit</a>
                            <a class="btn btn-danger btn-lg " href="{{ url('performance',$performance->id) }}" data-method="delete" 
                            data-token="{{ csrf_token() }}" data-confirm="Are you sure?">Delete</a>
                        </td>
                        
                    </tr>


                </tbody>
            </table>
        </div>
    </div>
@endsection