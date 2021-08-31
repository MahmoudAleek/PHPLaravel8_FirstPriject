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
                  <div class="card-header"> Edit Slider</div>

                  <div class="card-body">

                    <form action="{{url('slider/update/'.$slider->id)}}" method="POST" enctype="multipart/form-data">
                      @CSRF

                      <input type="hidden" name="slider_old_image" value="{{$slider->image}}">

                      <div class="form-group" style="margin-top: 15px">
                        <label for="category-name">Edit Slider Ttitle</label>
                        <input type="text" name="title" id="category-name" class="form-control" value="{{ $slider->title}}" style="margin-top: 10px">
                      </div>

                      <div class="form-group" style="margin-top: 15px">
                        <label for="category-name">Edit Slider Description</label>
                        <textarea name="description" rows="3" id="category-name" class="form-control" style="margin-top: 10px"> {{ $slider->description}} </textarea>
                      </div>

                      <div class="form-group" style="margin-top: 15px">
                        <label for="category-name">Edit Slider Image</label>
                        <input type="file" name="image" id="category-name" class="form-control" value="" style="margin-top: 10px">
                      </div>

                      <div class="form-group" style="margin-top: 15px">
                        <img src="{{asset($slider->image)}}" style="width:400px;height:200px">
                      </div>
  
                      <button type="submit" class="btn btn-primary" style="margin-top:15px"> Edit Slider </button>
                    </form>
                  </div>

                </div>
              </div>

            </div>
    
        </div>

    </div>

@endsection