@extends('admin.admin_master')

@section('index')
    <div class="py-12">
        {{-- All slider Part --}}
        <div class="container">
            <div class="row">

              <h4>Home Slider</h4>
              <a href="{{route('add.slider')}}"><button class="btn btn-info" >Add Slider</button></a>
              <br><br>

              <div class="col-md-12">

                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>{{session('success')}}</strong> 
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <div class="card">
                  <div class="card-header">All Sliders</div>



                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col" width=10% >#SL</th>
                        <th scope="col"  width=15%>Slider Title</th>
                        <th scope="col"  width=25%>Description</th>
                        <th scope="col"  width=15%>Image</th>
                        <th scope="col"  width=15%>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      

                      @foreach ($sliders as $slider)
                      <tr>
                        <th scope="row"> {{ $sliders->firstItem()+$loop->index }}</th>
                        <td> {{ $slider->title }} </td>
                        <td> {{ $slider->description }} </td>
                        <td> <img src="{{asset($slider->image)}}" style="height:50px;width:80px"  > </td>


                         <td>
                            <a href="{{ url('slider/edit/'.$slider->id) }}" class="btn btn-info">Edit</a>
                            <a href=" {{url('slider/delete/'.$slider->id)}}" class="btn btn-danger" onclick="return confirm('Are U Sure to delete') ">Delete</a>
                        </td>

                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  {{ $sliders->links()}}

                </div>
              </div>


            </div>
    
        </div>

    </div>
        
    @endsection