@extends('layout.admin')
@section('title','Admin | Account Create')
@section('contentBody')
<div class="card">
    <h1 class="text-center">Accounting & Bookkeeping</h1>
    <hr>
    <div class="card-header">
        <h3>Create New Account</h3>
    </div>
  
    <div class="card-body card-padding">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">

                <form role="form" method="POST" action="{{ route('accounts.store') }}" class="remove-margin-p" >
                {{ csrf_field() }}
                    
                    <div class="form-group">
                        <div class="fg-line">
                            <div class="select">
                                <h4>Account Type</h4>
                                <select class="form-control" name="type">
                                    <option></option>
                                    <option value="1" {{ Input::old('type') == 1 ? 'selected' : '' }} > Bank </option> 
                                    <option value="2" {{ Input::old('type') == 2 ? 'selected' : '' }} > Cash </option>
                                    <option value="3" {{ Input::old('type') == 3 ? 'selected' : '' }} > Other </option>             
                                </select>
                            </div>
                        </div>
                        @if ($errors->has('type'))
                            <p class="text-right text-danger">{{$errors->first('type')}}</p>
                        @endif
                    </div>

                    <div class="form-group ">
                        <div class="fg-line">
                            <label for="title">Account Title</label>
                            <input type="text" class="form-control input-sm" id="title" name="title" placeholder="Account Title" value="{{ Input::old('title')  }}" />
                        </div>
                        @if ($errors->has('title'))
                            <p class="text-right text-danger">{{$errors->first('title')}}</p>
                        @endif
                    </div>

                    <div class="form-group ">
                        <div class="fg-line">
                            <label for="account_number">Account Number</label>
                            <input type="text" class="form-control input-sm" id="account_number" name="account_number" placeholder="Account Number" value="{{ Input::old('account_number')  }}" />
                        </div>
                        @if ($errors->has('account_number'))
                            <p class="text-right text-danger">{{$errors->first('account_number')}}</p>
                        @endif
                    </div>

                    <div class="form-group ">
                        <div class="fg-line">
                            <label for="balance">Starting Balance</label>
                            <input type="number" class="form-control input-sm" id="balance" name="balance" placeholder="Starting Balance" value="{{ Input::old('balance')  }}" />
                        </div>
                        @if ($errors->has('balance'))
                            <p class="text-right text-danger">{{$errors->first('balance')}}</p>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Submit</button>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
