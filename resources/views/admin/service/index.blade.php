@extends('admin.admin_master')

@section('index')
    <div class="py-2">
        {{-- All slider Part --}}
        <div class="container">
            <div class="row">

              <h4>Home Service</h4>
              <a href="{{route('add.service')}}"><button class="btn btn-info" >Add Service</button></a>
              <br><br>

              <div class="col-md-12">

                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>{{session('success')}}</strong> 
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <div class="card">
                  <div class="card-header">All Services</div>



                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col" width=10% >#SL</th>
                        <th scope="col"  width=15%>Service Title</th>
                        <th scope="col"  width=25%>Description</th>
                        <th scope="col"  width=15%>Image</th>
                        <th scope="col"  width=15%>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      

                      @foreach ($services as $service)
                      <tr>
                        <th scope="row"> {{ $services->firstItem()+$loop->index }}</th>
                        <td> {{ $service->title }} </td>
                        <td> {{ $service->short_des }} </td>
                        <td> <img src="{{asset($service->image)}}" style="height:50px;width:80px"  > </td>


                         <td>
                            <a href="{{ url('slider/edit/'.$service->id) }}" class="btn btn-info">Edit</a>
                            <a href=" {{url('slider/delete/'.$service->id)}}" class="btn btn-danger" onclick="return confirm('Are U Sure to delete') ">Delete</a>
                        </td>

                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  {{ $services->links()}}

                </div>
              </div>


            </div>
    
        </div>

    </div>
        
    @endsection