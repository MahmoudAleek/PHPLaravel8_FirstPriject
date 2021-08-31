@extends('admin.admin_master')

@section('index')
    <div class="card card-default">
    <div class="card-header card-header-border-bottom">
        <h2>Update User Profile</h2>
    </div>
    <div class="card-body">
        <form action="{{ route('update.profile') }}"  method="POST" enctype="multipart/form-data" class="form-pill">
            @csrf
            <input type="hidden" name="old_img" value="{{Auth()->user()->profile_photo_path}}">
            <div class="form-group">
                <label for="exampleFormControlInput3">User Name :</label>
                <input type="text" name="name" class="form-control" value="{{$user['name']}}" >
                @error('name')
                <span class="text-danger">{{$message}}</span>
                @enderror
             
            </div>

            <div class="form-group">
                <label for="exampleFormControlPassword3">User Email :</label>
                <input type="text" name="email" class="form-control" value="{{$user['email']}}" >
                @error('email')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="exampleFormControlPassword3">User Image :</label>
                <input type="file" name="image" id="image" class="form-control" value="" >

            </div>

            <div class="form-group" >
                <img src="{{asset(Auth::user()->profile_photo_path)}}" id="showimage" width="200px" height="200px" >
            </div>

            <button type="submit" class="btn btn-primary btn-default" >Update Profile</button>
        </form>
    </div>
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">

    $(document).ready(function(){
  
      $('#image').change(function(e){
        var reader = new FileReader();
        reader.onload = function(e){
          $('#showimage').attr('src',e.target.result);
        }
  
        reader.readAsDataURL(e.target.files['0']);
      });
  
    });
  </script>
@endsection