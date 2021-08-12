@extends('layout.admin')
@section('title','Accounts | Manage Transfer')

@section('styles')
<style>
    .panel-heading {
    padding: 17px;
}
.input-sm{
        width: 100% !important;
        float:right !important;
    }
    #example_filter{
        padding-left: 266px;
        padding-right: 20px;
    }
    .datepicker{z-index:1151 !important;}

</style>


@endsection

@section('contentBody')
<h1 class="text-center">Accounting & Bookkeeping</h1>
<div class="card">
    <div class="card-header">
        <h3>Manage Account Transfer</h3>
    </div>

<div class="card-body card-padding">
    <div class="row">
        <div class="col-md-2 col-md-offset-10">
            <a  href="{{ route('transfer.index') }}" class="btn btn-primary  p-10">Transfer List</a>
        </div>

    </div>
    <br> <br> 
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
        <form role="form" method="POST" action="{{ route('transfer.store') }}" class="remove-margin-p" >
                {{ csrf_field() }}
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3>Add Account Transfer</h3>
                        </div>
                        <div class="panel-body">
                            <h4>Date</h4>
                            <div class="input-group form-group">

                                <span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
                                    <div class="dtp-container">
                                        <input type='text' class="form-control date-picker" placeholder="Click here..." id="date" name="date"  value="{{ Input::old('date')  }}" />
                                    </div>
                            </div>

                            <div class="form-group">
                                <div class="fg-line">
                                    <div class="select">
                                        <h4>From</h4>
                                        <select required name="from" id="" class="form-control">
                                            <option value=""></option>
                                            @foreach($accounts as $data)
                                                <option value="{{ $data->id }}">{{ $data->title  }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                 @if ($errors->has('from'))
                                        <p class="text-right text-danger">{{$errors->first('from')}}</p>
                                    @endif
                            </div>
                            <div class="form-group">
                                <div class="fg-line">
                                    <div class="select">
                                        <h4>To</h4>
                                        <select required name="to" id="" class="form-control">
                                            <option value=""></option>
                                            @foreach($accounts as $data)
                                                <option value="{{ $data->id }}">{{ $data->title  }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                     @if ($errors->has('to'))
                                        <p class="text-right text-danger">{{$errors->first('to')}}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group ">
                                <div class="fg-line">
                                    <label for="price">Amount</label>
                                    <input type="number" class="form-control input-sm" id="price" name="amount" placeholder="amount" value="" />
                                </div>
                                    @if ($errors->has('amount'))
                                        <p class="text-right text-danger">{{$errors->first('amount')}}</p>
                                    @endif
                            </div>

                            

                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save changes</button>
            </form>
            </div>
    </div>

</div>
</div>

@endsection


@section('scripts')

<script type="text/javascript">

    $(document).ready(function(){

             $('#datepicker').datepicker({
                    multidate: true,
            });

    });

</script>

@endsection