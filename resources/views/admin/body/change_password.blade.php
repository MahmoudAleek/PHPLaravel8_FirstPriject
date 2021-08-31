@extends('admin.admin_master')

@section('index')
    <div class="card card-default">
    <div class="card-header card-header-border-bottom">
        <h2>Change Password</h2>
    </div>
    <div class="card-body">
        <form action="{{ route('update.password') }}"  method="POST" class="form-pill">
            @csrf
            <div class="form-group">
                <label for="exampleFormControlInput3">Current Password</label>
                <input type="password" name="current_password" class="form-control" id="current_password" >
                @error('current_password')
                <span class="text-danger">{{$message}}</span>
                @enderror
                @if(session('error')) <span class="text-danger" >{{session('error')}}</span> @endif 
            </div>

            <div class="form-group">
                <label for="exampleFormControlPassword3">New Password</label>
                <input type="password" name="password" class="form-control" id="password" >
                @error('password')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="exampleFormControlPassword3">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" >
                @error('password_confirmation')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary btn-default" >Update Password</button>
        </form>
    </div>
    </div>
@endsection