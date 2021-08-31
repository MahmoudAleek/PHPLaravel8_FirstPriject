@extends('admin.admin_master')

@section('index')
  
    <div class="py-12">
        
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>{{session('success')}}</strong> 
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        
        <div class="container">
            <div class="row">

              <div class="col-md-8">
                <div class="card">
                  <div class="card-header"> Edit Brand</div>

                  <div class="card-body">

                    <form action="{{url('brand/update/'.$brand->id)}}" method="POST" enctype="multipart/form-data">
                      @CSRF

                      <input type="hidden" name="old_image" value="{{$brand->brand_image}}">

                      <div class="form-group" style="margin-top: 15px">
                        <label for="category-name">Edit Brand Name</label>
                        <input type="text" name="brand_name" id="category-name" class="form-control" value="{{ $brand->brand_name}}" style="margin-top: 10px">
                        @error('category_name')
                          <span class="text-danger"> {{$message}} </span>
                        @enderror
                      </div>

                      <div class="form-group" style="margin-top: 15px">
                        <label for="category-name">Edit Brand Image</label>
                        <input type="file" name="brand_image" id="category-name" class="form-control" value="" style="margin-top: 10px">
                        @error('category_name')
                          <span class="text-danger"> {{$message}} </span>
                        @enderror
                      </div>

                      <div class="form-group" style="margin-top: 15px">
                        <img src="{{asset($brand->brand_image)}}" style="width:400px;height:200px">
                      </div>
  
                      <button type="submit" class="btn btn-primary" style="margin-top:15px"> Edit Brand </button>
                    </form>
                  </div>

                </div>
              </div>



            </div>
    
        </div>

    </div>

@endsection