@extends('admin.admin_master')

@section('index')
    <div class="py-12">
        {{-- All slider Part --}}
        <div class="container">
            <div class="row">

              <h4>Home About</h4>
              <a href="{{route('add.about')}}"><button class="btn btn-info" >Add About</button></a>
              <br><br>

              <div class="col-md-12">

                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>{{session('success')}}</strong> 
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <div class="card">
                  <div class="card-header">All Home About</div>



                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col" width=10% >#SL</th>
                        <th scope="col"  width=15%>Home Title</th>
                        <th scope="col"  width=20%>Short Description</th>
                        <th scope="col"  width=25%>long Description</th>
                        <th scope="col"  width=15%>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      

                      @foreach ($homeabout as $aboutItem)
                      <tr>
                        <th scope="row"> {{ $homeabout->firstItem()+$loop->index }}</th>
                        <td> {{ $aboutItem->title }} </td>
                        <td> {{ $aboutItem->short_des }} </td>
                        <td> {{ $aboutItem->long_des }} </td>


                         <td>
                            <a href="{{ url('about/edit/'.$aboutItem->id) }}" class="btn btn-info">Edit</a>
                            <a href=" {{url('about/delete/'.$aboutItem->id)}}" class="btn btn-danger" onclick="return confirm('Are U Sure to delete') ">Delete</a>
                        </td>

                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  {{ $homeabout->links()}}

                </div>
              </div>


            </div>
    
        </div>

    </div>
        
    @endsection