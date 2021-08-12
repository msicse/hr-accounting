@extends('layout.admin')
@section('title','Admin | Off Day')
@section('styles')
    <style>
        .form-control{
            font-size: 20px;
        }
    </style>
@stop
@section('contentBody')
	<div class="card">
        <div class="card-header">
            <h2>Offday List</h2>
        </div>
       <div class="card-body table-responsive">
       <a  class="btn btn-primary" href="{{ url('offdayview', [$offdays[0]->id,'edit']) }}">Edit</a>
        


            <table class="table">
                <caption>Year: {{ $year }} | Month: 
				@if( $month ==1 )
                                                January
                                            @elseif ( $month == 2 )
                                                    February
                                            @elseif ( $month == 3 )
                                                March
                                            @elseif( $month == 4 )
                                                April
                                            @elseif ( $month == 5 )
                                                May
                                            @elseif ( $month == 6 )
                                                Jun
                                            @elseif( $month == 7 )
                                                Julay
                                            @elseif( $month == 8 )
                                                August
                                            @elseif( $month == 9 )
                                                September
                                            @elseif( $month == 10 )
                                                October
                                            @elseif( $month == 11 )
                                                
                                                November
                                            
                                            @else
												December
											@endif
				
				</caption>

                <thead>
                    <tr>
                        <th>#</th>
                        <th>Day</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=0 ; ?>
                    @foreach( $offdays as $offday )
                        <?php $i++ ;?>
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{$offday->off_days}}</td>
                            <td>
                                <a href="{{ url('offdayview',$offday->id) }}" data-method="delete" 
                                data-token="{{ csrf_token() }}" data-confirm="Are you sure?"><i class="fa fa-trash-o text-danger custom-font" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
         </div>
    </div>

@endsection