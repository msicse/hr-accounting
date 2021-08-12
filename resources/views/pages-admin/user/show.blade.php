@extends('layout.admin')
@section('title','Admin | User Create')
@section('contentBody')
	<div class="card">
        <div class="card-header">
            <h2>User Details</h2>
        </div>
        <div class="card-body card-padding table-responsive">

          <table class="table table-border">
            <tr>
              <th>Name</th>
              <td>{{ $user->name }}</td>
            </tr>
            <tr>
              <th>Employee Id</th>
              <td>{{ $user->profile_id }}</td>
            </tr>
            <tr>
              <th>Role</th>
              <td>{{ $user->role }}</td>
            </tr>
            <tr>
              <th>Email</th>
              <td>{{ $user->email }}</td>
            </tr>
          </table>
            
        </div>
    </div>

@endsection