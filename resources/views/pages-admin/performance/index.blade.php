@extends('layout.admin')
@section('title','performance')
@section('contentBody')
	<div class="card">
        <div class="card-header">
            <h2>Performance </h2>
        </div>
		<div class="card-body table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Month</th>
                        <th>Goal</th>
                        <th>Action</th>
                        
                    </tr>
                </thead>
                <tbody>
                <?php $i =0 ?>
                @foreach( $performances as $performance )
                    <?php $i++ ?>
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $performance->name }}</td>
                        <td>{{ $performance->month }}</td>
                        <td>{{ $performance->goal }}</td>
                        <!-- <td> {{ date('M j, Y', strtotime( $performance->created_at )) }}</td> -->
                        <td> <a href="{{ url('performance',$performance->id) }}">view</a> </td> 
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection