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
                  <div class="card-header"> Edit Contact</div>

                  <div class="card-body">

                    <form action="{{url('/admin/contact/update/'.$updateContact->id)}}" method="POST" >
                      @CSRF

                      <div class="form-group" style="margin-top: 15px">
                        <label for="category-name">Edit Contact email</label>
                        <input type="text" name="email" id="category-name" class="form-control" value="{{ $updateContact->email}}" style="margin-top: 10px">
                      </div>

                      <div class="form-group" style="margin-top: 15px">
                        <label for="category-name">Edit Contact Address</label>
                        <textarea name="address" rows="3" id="category-name" class="form-control" style="margin-top: 10px"> {{ $updateContact->address}} </textarea>
                      </div>

                      <div class="form-group" style="margin-top: 15px">
                        <label for="category-name">Edit Contact Phone</label>
                        <input type="text" name="phone" id="category-name" class="form-control" value="{{$updateContact->phone}}" style="margin-top: 10px">
                      </div>

  
                      <button type="submit" class="btn btn-primary" style="margin-top:15px"> Edit Contact </button>
                    </form>
                  </div>

                </div>
              </div>

            </div>
    
        </div>

    </div>

@endsection