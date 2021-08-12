@extends('layout.admin')
@section('contentBody')
	<div class="card">
        <div class="card-header">
            <h2>Shift</h2><a class="btn btn-primary pull-right" href="{{url('shift/create')}}">Add Shift</a>  
        </div>
		<div class="card-body table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php $i = 0 ; ?>
                @foreach( $shifts as $shift )
                    <?php $i++?>
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ date('h-i a', strtotime($shift->start))}}</td>
                        <td>{{ date('h-i a', strtotime($shift->end))}}</td>
                        <td> 
                           
                            <a href="{{ url('shift',$shift->id) }}" data-method="delete" 
                            data-token="{{ csrf_token() }}" data-confirm="Are you sure?"><i class="fa fa-trash-o text-danger custom-font" aria-hidden="true"></i></a>
                            
                        </td> 
                        
                    </tr>
                   
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection