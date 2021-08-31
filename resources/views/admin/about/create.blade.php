@extends('admin.admin_master')

@section('index')

<div class="col-lg-12">
    <div class="card card-default">
        <div class="card-header card-header-border-bottom">
            <h2>Create About</h2>
        </div>
        <div class="card-body">
            <form action="{{route('store.about')}}" method="POST" >
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlPassword">About Title</label>
                    <input type="text" name="title" class="form-control" id="exampleFormControlPassword" placeholder="About Title">
                    @error('title')
                    <span class="text-danger">{{$message}}</span>
                @enderror
                </div>
                
                <div class="form-group">
                    <label for="exampleFormControlPassword">Short Description</label>
                    <textarea type="text" name="short_des" rows=4 class="form-control" id="exampleFormControlPassword"  > </textarea>
                    @error('short_des')
                    <span class="text-danger">{{$message}}</span>
                @enderror
                </div>

                <div class="form-group">
                    <label for="exampleFormControlPassword">Long Description</label>
                    <textarea type="text" name="long_des" rows=4 class="form-control" id="exampleFormControlPassword"  > </textarea>
                    @error('long_des')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-footer pt-4 pt-5 mt-4 border-top">
                    <button type="submit" class="btn btn-primary btn-default">Submit</button>
                </div>
            </form>
        </div>
    </div>


</div>

@endsection