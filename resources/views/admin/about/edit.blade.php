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
                  <div class="card-header"> Edit About</div>

                  <div class="card-body">

                    <form action="{{url('about/update/'.$about->id)}}" method="POST" >
                      @CSRF
                      {{}
                      <div class="form-group" style="margin-top: 15px">
                        <label for="category-name">Edit About Ttitle</label>
                        <input type="text" name="title" id="category-name" class="form-control" value="{{ $about->title}}" style="margin-top: 10px">
                      </div>

                      <div class="form-group" style="margin-top: 15px">
                        <label for="category-name">Edit About Short Description</label>
                        <textarea name="short_des" rows="3" id="category-name" class="form-control" style="margin-top: 10px"> {{ $about->short_des}} </textarea>
                      </div>

                      <div class="form-group" style="margin-top: 15px">
                        <label for="category-name">Edit About Long Description</label>
                        <textarea name="long_des" rows="3" id="category-name" class="form-control" style="margin-top: 10px"> {{ $about->long_des}} </textarea>
                      </div>

                      <button type="submit" class="btn btn-primary" style="margin-top:15px"> Update About </button>
                    </form>
                  </div>

                </div>
              </div>

            </div>
    
        </div>

    </div>

@endsection