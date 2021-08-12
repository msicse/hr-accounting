@extends('layout.master')
@section('title','Login')
@section('content')

  <div class="jumbotron vertical-center">
    <div class="container">
    <div class="row ">
      <div class="row">
        <div class="col-md-12">
          @if(Session::has('error'))
            <div class="alert alert-danger text-center"><span class="glyphicon glyphicon glyphicon-remove"></span><em> {!! session('error') !!} </em></div>
          @endif
        </div>
      </div>
      <div class="col-md-6 col-md-offset-3">
      <h2 class="text-center">User Login</h2>
        <form action="{{ route('user.login')}} " method="post">
        {{ csrf_field() }}
          <div class="form-group">
            <label for="email">Email address:</label>
            <input type="email" class="form-control" id="email" name="email">
            @if ($errors->has('email'))
                        <p class="pull-right text-danger">{{$errors->first('email')}}</p>
            @endif
          </div>
          <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password"> 
            @if ($errors->has('password'))
                        <p class="pull-right text-danger">{{$errors->first('password')}}</p>
            @endif
          </div>
          <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </form>
      </div>
    </div>
    </div>
  </div>
@endsection
