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
            <h2> Select Month and Year To View Offday <a href="{{ url('offday/month') }}"> <span class="pull-right btn btn-primary custom-btn"><i class="fa fa-arrow-left" aria-hidden="true"></i> back </span></a> </h2>
        </div>
        <div class="card-body card-padding">
            <form role="form" method="post" action="{{ route('viewoffday') }} " class="remove-margin-p">
                {{ csrf_field() }}
                
                <div class="col-md-6">
                        
                        <div class="form-group">
                            <div class="fg-line">
                                <div class="select">
                                    <h2 class="text-left">Year</h2>
                                    <select class="form-control" name="year">
                                        <option></option>
                                    @foreach( $offdays as $day)
                                        <option style="font-size: 20px;" value="{{ $day->year }}">{{ $day->year }}</option>
                                    
                                    @endforeach

                                  </select>
                            
                                </div>
                            </div>
                    
                                @if ($errors->has('year'))
                                 <p class="text-right text-danger">{{$errors->first('year')}}</p>
                                @endif
                        </div>
                </div>

                <div class="col-md-6">
                        <div class="form-group">
                            <div class="fg-line">
                                <div class="select">
                                    <h2 class="text-left">Month

                                        
                                    </h2>
                                    <select class="form-control" name="month">
                                        <option></option>
                                        @foreach( $offmonts as $day)

                                        <option value="{{ $day->month }}">
                                            
                                            @if( $day->month ==1 )
                                                January
                                            @elseif ( $day->month == 2 )
                                                    February
                                            @elseif ( $day->month == 3 )
                                                March
                                            @elseif( $day->month == 4 )
                                                April
                                            @elseif ( $day->month == 5 )
                                                May
                                            @elseif ( $day->month == 6 )
                                                Jun
                                            @elseif( $day->month == 7 )
                                                Julay
                                            @elseif( $day->month == 8 )
                                                August
                                            @elseif( $day->month == 9 )
                                                September
                                            @elseif( $day->month == 10 )
                                                October
                                            @elseif( $day->month == 11 )
                                                
                                                November
                                            
                                            @else

                                                 December

                                            @endif
                                        </option>

                                        @endforeach
                                    </select>
                            
                                </div>
                            </div>
                    
                                @if ($errors->has('month'))
                                 <p class="text-right text-danger">{{$errors->first('month')}}</p>
                                @endif
                        </div>
                </div>
                
                 <button type="submit" class="btn btn-primary btn-sm m-t-10">Submit</button>
            </form>

         </div>
    </div>
    

@endsection