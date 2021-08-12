@extends('layout.admin')
@section('title','Admin | User Edit')
@section('contentBody')
	<div class="card">
        <div class="card-header">
            <h2>Edit User</h2>
        </div>
        <div class="card-body card-padding">
            <form action="{{ route('user.update',[$user->id])}}" method="post">
        <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group">
            <label for="name"><h4>Name:</h4></label>
            <input type="text" class="form-control" id="name" name="name" 
            @if( empty( Input::old('name')))
                  value = "{{ $user->name }}"
            @else
                  value="{{ Input::old('name')  }}"
            @endif
            >
            @if ($errors->has('name'))
              <p class="text-right text-danger">{{$errors->first('name')}}</p>
            @endif
          </div>
          <div class="form-group">
            <label for="email"><h4>Email address:</h4></label>
            <input type="text" class="form-control" id="email" name="email" 
            @if( empty( Input::old('name')))
                  value = "{{ $user->email }}"
            @else
                  value="{{ Input::old('email')  }}"
            @endif
            >
            @if ($errors->has('email'))
              <p class="text-right text-danger">{{$errors->first('email')}}</p>
            @endif
          </div>
          <div class="form-group">
            <div class="fg-line">
              <div class="select">
                  <h4>Employee Id</h4>
                        <select class="form-control" name="profile_id" style="height: 24px;" disabled>
                        <option value="{{ $user->profile_id }}" selected> {{ $user->profile_id }} </option>
                          @foreach( $profileids as $id )
                          <option value="{{$id}}" {{ Input::old('profile_id') == $id ? 'selected' : '' }}>{{ $id }}</option> 
                          @endforeach   
                        </select>
                            
                  </div>
              </div>
                @if ($errors->has('profile_id'))
                  <p class="text-right text-danger">{{$errors->first('profile_id')}}</p>
                @endif
          </div>
          <div class="form-group">
              <div class="fg-line">
                  <div class="select">
                      <h4>Role</h4>
                        <select class="form-control" name="role" style="height: 24px;">
                        <option value="{{ $user->role }}" selected>{{ $user->role }} </option>
                          <option value="admin" {{ Input::old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                          <option value="hr" {{ Input::old('role') == 'hr' ? 'selected' : '' }} >HR</option>
                          <option value="account" {{ Input::old('role') == 'account' ? 'selected' : '' }}>Account</option>
                          <option value="employee" {{ Input::old('role') == 'employee' ? 'selected' : '' }}>Employee</option>      
                        </select>
                            
                  </div>
              </div>
                @if ($errors->has('role'))
                  <p class="text-right text-danger">{{$errors->first('role')}}</p>
                @endif
          </div>
          <div class="form-group">
            <label for="password"><h4>Password:</h4></label>
            <input type="password" class="form-control" id="password" name="password" value="{{ Input::old('password')  }}">
            @if ($errors->has('password'))
              <p class="text-right text-danger">{{$errors->first('password')}}</p>
            @endif
          </div>
          
          <!-- <div class="form-group">
            <label for="password_confirmation">Password:</label>
            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
          </div> -->
          <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </form>
         </div>
    </div>

@endsection