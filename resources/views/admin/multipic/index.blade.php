@extends('admin.admin_master')

@section('index')
    <div class="py-12">
        {{-- All Category Part --}}
        <div class="container">
            <div class="row">

              <div class="col-md-8">
                <div class="card-group">
                @foreach ($images as $img)
                    <div class="col-md-3 mt-10" style="margin-right:30px">
                      <div class="card">
                        <img src="{{asset($img->image)}}" alt="">
                      </div>
                    </div>
                @endforeach
                </div>
              </div>

              <div class="col-md-4">
                <div class="card">
                  <div class="card-header"> Multi Image</div>

                  <div class="card-body">

                    <form action="{{route('store.images')}}" method="POST" enctype="multipart/form-data">
                      @CSRF

                      <div class="form-group" style="margin-top:15px">
                        <label for="category-name">Brand Image</label>
                        <input type="file" name="images[]" id="category-name" class="form-control" style="margin-top:10px" multiple>
                        @error('images')
                          <span class="text-danger"> {{$message}} </span>
                        @enderror
                      </div>
  
                      <button type="submit" class="btn btn-primary" style="margin-top:15px"> Add Image </button>
                    </form>
                  </div>

                </div>
              </div>

            </div>
    
        </div>

    </div>
@endsection