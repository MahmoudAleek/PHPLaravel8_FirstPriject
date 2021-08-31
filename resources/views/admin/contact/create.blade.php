@extends('admin.admin_master')

@section('index')

<div class="col-lg-12">
    <div class="card card-default">
        <div class="card-header card-header-border-bottom">
            <h2>Create Service</h2>
        </div>
        <div class="card-body">
            <form action="{{route('store.contact')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlPassword">Contact email</label>
                    <input type="text" name="email" class="form-control" id="exampleFormControlPassword" placeholder="">
                </div>
                
                <div class="form-group">
                    <label for="exampleFormControlPassword">Contact Address</label>
                    <textarea type="text" name="address" rows=4 class="form-control" id="exampleFormControlPassword"  > </textarea>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlFile1">Contact Phone</label>
                    <input type="text" name="phone" class="form-control-file" id="exampleFormControlFile1">
                </div>

                
                <div class="form-footer pt-4 pt-5 mt-4 border-top">
                    <button type="submit" class="btn btn-primary btn-default">Submit</button>
                </div>
            </form>
        </div>
    </div>


</div>

@endsection