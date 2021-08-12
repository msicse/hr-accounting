@extends('layout.master')
@section('title','Login')
@section('content')

  <div class="jumbotron vertical-center">
    <div class="container">
    <div class="row ">
      <div class="col-md-6 col-md-offset-3">
      <h2 class="text-center">User Registration</h2>
        <form action="{{ route('auth.register')}}" method="post">
        {{ csrf_field() }}
          <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name">
          </div>
          <div class="form-group">
            <label for="email">Email address:</label>
            <input type="email" class="form-control" id="email" name="email">
          </div>
          <div class="form-group">
            <label for="profile_id">Employee Id:</label>
            <input type="text" class="form-control" id="profile_id" name="profile_id">
          </div>
          <div class="form-group">
            <label for="role">Role:</label>
            <input type="text" class="form-control" id="role" name="role">
          </div>
          <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password">
          </div>
          <div class="form-group">
            <label for="password_confirmation">Password:</label>
            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
          </div>
          <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </form>
      </div>
    </div>
    </div>
  </div>
@endsection
