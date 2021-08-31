@extends('admin.admin_master')

@section('index')
    <div class="py-12">
        {{-- All Category Part --}}
        <div class="container">
            <div class="row">

              <div class="col-md-8">

                {{-- @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>{{session('success')}}</strong> 
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif --}}

                <div class="card">
                  <div class="card-header">All Brand</div>



                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#SL No</th>
                        <th scope="col">BrandName</th>
                        <th scope="col">BrandImage</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      

                      @foreach ($brands as $brand)
                      <tr>
                        <th scope="row"> {{ $brands->firstItem()+$loop->index }}</th>
                        <td> {{ $brand->brand_name }} </td>
                        <td> <img src="{{asset($brand->brand_image)}}" style="height:50px;width:80px"  > </td>

                        <td>
                          @if($brand->created_at == NULL)
                          <span class="text-danger"> No Date Set</span>
                          @else
                          <!-- EloquentORM Normal Way -->
                          <!-- {$Brand->created_at->diffForHumans()} -->

                          <!-- QueryBuilder Convert To String Way -->
                          {{ Carbon\Carbon::parse($brand->created_at)->diffForHumans() }}
                          @endif
                         </td>

                         <td>
                            <a href="{{ url('brand/edit/'.$brand->id) }}" class="btn btn-info">Edit</a>
                            <a href=" {{url('brand/delete/'.$brand->id)}}" class="btn btn-danger" onclick="return confirm('Are U Sure to delete') ">Delete</a>
                        </td>

                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  {{ $brands->links()}}

                </div>
              </div>

              <div class="col-md-4">
                <div class="card">
                  <div class="card-header"> Add Brand</div>

                  <div class="card-body">

                    <form action="{{route('store.brand')}}" method="POST" enctype="multipart/form-data">
                      @CSRF

                      <div class="form-group">
                        <label for="category-name">Brand Name</label>
                        <input type="text" name="brand_name" id="category-name" class="form-control" style="margin-top:10px">
                        @error('brand_name')
                          <span class="text-danger"> {{$message}} </span>
                        @enderror
                      </div>

                      <div class="form-group" style="margin-top:15px">
                        <label for="category-name">Brand Image</label>
                        <input type="file" name="brand_image" id="category-name" class="form-control" style="margin-top:10px">
                        @error('brand_image')
                          <span class="text-danger"> {{$message}} </span>
                        @enderror
                      </div>
  
                      <button type="submit" class="btn btn-primary" style="margin-top:15px"> Add Brand </button>
                    </form>
                  </div>

                </div>
              </div>

            </div>
    
        </div>

    </div>
        
    @endsection