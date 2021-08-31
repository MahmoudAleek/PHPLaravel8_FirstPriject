@extends('admin.admin_master')

@section('index')
    <div class="py-12">
        {{-- All slider Part --}}
        <div class="container">
            <div class="row">

              <h4>Home Contact</h4>
              <a href="{{route('add.contact')}}"><button class="btn btn-info" >Add Contact</button></a>
              <br><br>

              <div class="col-md-12">

                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>{{session('success')}}</strong> 
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <div class="card">
                  <div class="card-header">All Home Contact</div>



                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col" width=10% >#SL</th>
                        <th scope="col"  width=10%>Contact Address</th>
                        <th scope="col"  width=10%>Contact Email</th>
                        <th scope="col"  width=10%>Contact Phone</th>
                        <th scope="col"  width=10%>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      

                      @foreach ($contacts as $con)
                      <tr>
                        <th scope="row"> {{ $contacts->firstItem()+$loop->index }}</th>
                        <td> {{ $con->address }} </td>
                        <td> {{ $con->email }} </td>
                        <td> {{ $con->phone }} </td>


                         <td>
                            <a href="{{ url('admin/contact/edit/'.$con->id) }}" class="btn btn-info">Edit</a>
                            <a href=" {{url('admin/contact/delete/'.$con->id)}}" class="btn btn-danger" onclick="return confirm('Are U Sure to delete') ">Delete</a>
                        </td>

                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  {{ $contacts->links()}}

                </div>
              </div>


            </div>
    
        </div>

    </div>
        
    @endsection