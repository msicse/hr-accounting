@extends('layout.admin')
@section('title','Accounts | Manage Incomes')

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
        <h3>Add Expenses</h3>
    </div>
<div class="card-body card-padding">
    <div class="row">
        <div class="col-md-2 col-md-offset-10">
        <a href="{{  route('expenses.index') }}" class="btn btn-primary  p-10" >Return Back</a>
        </div>
    </div>
<div class="row">
    <div class="col-md-8 col-md-offset-2">

        <form role="form" method="POST" action="{{ route('expenses.store') }}" class="remove-margin-p" >
                {{ csrf_field() }}
            <div class="form-group ">
                <div class="fg-line">
                    <label for="title">Title</label>
                    <input type="text" class="form-control input-sm" name="title" placeholder="title" value="" />
                </div>
                    @if ($errors->has('title'))
                        <p class="text-right text-danger">{{$errors->first('title')}}</p>
                    @endif
            </div>

            <div class="form-group">
                <div class="fg-line">
                    <div class="select">
                        <h4>Category</h4>
                        <select class="form-control" name="income_category_id">
                            <option></option>
                            @foreach( $categories as $category )
                            <option value="{{ $category->id }}" {{ Input::old('category_id') == $category->id ? 'selected' : '' }} > {{ $category->income_name }} </option>
                            @endforeach
                                     
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group ">
                <div class="fg-line">
                    <label for="amount">Amount</label>
                    <input type="number" class="form-control input-sm" name="amount" placeholder="amount" value="" />
                </div>
                    @if ($errors->has('amount'))
                        <p class="text-right text-danger">{{$errors->first('amount')}}</p>
                    @endif
            </div>
            <div class="form-group">
                <div class="fg-line">
                    <div class="select">
                        <h4>Account</h4>
                        <select class="form-control" name="account_id">
                            <option></option>
                            @foreach( $accounts as $category )
                            <option value="{{ $category->id }}" {{ Input::old('account_id') == $category->id ? 'selected' : '' }} > {{ $category->title }} </option>
                            @endforeach
                                     
                        </select>
                    </div>
                </div>
            </div>
            <div>
            <label for="date">Date</label>
            <div class="input-group form-group">
                <span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
                <div class="dtp-container">
                    <input type='text' class="form-control date-picker" placeholder="Click here..." id="date" name="date"  value="{{ Input::old('due_date')  }}" />
                </div>
            </div>
            </div>
            <div class="form-group ">
                <div class="fg-line">
                    <label for="notes">Description</label>
                    <textarea class="form-control" rows="5" placeholder="description......" name="description" id="notes">{{ Input::old('notes') }}</textarea>
                </div>
                @if ($errors->has('description'))
                 <p class="text-right text-danger">{{$errors->first('description')}}</p>
                @endif
            </div>
            <p class="text-center">
                <button type="submit" class="btn btn-primary">Save changes</button>
            </p>
            
        </form>
    </div>
</div>
</div>
</div>
@stop