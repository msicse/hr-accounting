@extends('layout.admin')
@section('contentBody')
	<div class="card">

        <div class="card-header">
            <h2>Designation </h2>
        </div>
		<div class="card-body table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                        
                    </tr>
                </thead>
                <tbody>
                <?php $i =0 ?>
                @foreach( $leaves as $leave )
                    <?php $i++ ?>
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $leave->name }}</td>
                        <td>{{ $leave->designation }}</td>
                        <td> {{ date('M j, Y', strtotime( $leave->created_at )) }}</td>
                        <td>
                            @if($leave->sanctioned == 1)
                           <p class="text-success">Apporved</p> 
                            @else
                            <p class="text-danger">Not Apporved</p> 
                            @endif
                        </td>
                        <td> <a href="{{ route('single-leaves.show',[ $leave->id ]) }}">view</a> </td> 
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection