@extends('layout.admin')
@section('title','Admin | User Create')
@section('contentBody')
	<div class="card">
        <div class="card-header">
            <h2>Create User</h2>
        </div>
        <div class="card-body card-padding">
            <form action="{{ route('user.store')}}" method="post">

                <div class="form-group">
                    <div class="fg-line">
                        <div class="select">
                            <h4>Employee Id</h4>
                            <select class="form-control" name="profile_id" id="profileShow" style="height: 24px;">
                                <option value=""></option>
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
        {{ csrf_field() }}
          <div class="form-group">
            <label for="name"><h4>Name:</h4></label>
            <input type="text" class="form-control" id="name" readonly name="name" value="{{ Input::old('name')  }}">
            @if ($errors->has('name'))
              <p class="text-right text-danger">{{$errors->first('name')}}</p>
            @endif
          </div>
          <div class="form-group">
            <label for="email"><h4>Email address:</h4></label>
            <input type="text" class="form-control" readonly id="email" name="email" value="{{ Input::old('email')  }}">
            @if ($errors->has('email'))
              <p class="text-right text-danger">{{$errors->first('email')}}</p>
            @endif
          </div>

          <div class="form-group">
              <div class="fg-line">
                  <div class="select">
                      <h4>Role</h4>
                        <select class="form-control" name="role" style="height: 24px;">
                        <option value=""></option>
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

@section('scripts')
    <script>

        $('#profileShow').change(function(){

            var id = $("#profileShow option:selected").val();
            //alert(id);
            var url = location.origin + "/employee-show/" + id;

            $.get(url,function(data){

                $('#email').val(data.email);
                $('#name').val(data.first_name+" "+data.last_name);

            });
        });
    </script>
@endsection
