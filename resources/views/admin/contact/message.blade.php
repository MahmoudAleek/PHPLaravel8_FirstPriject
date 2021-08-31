@extends('admin.admin_master')

@section('index')
    <div class="py-12">
        {{-- All slider Part --}}
        <div class="container">
            <div class="row">

              <h4>Home Contact</h4>
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
                        <th scope="col"  width=10%>Name</th>
                        <th scope="col"  width=10%>Email</th>
                        <th scope="col"  width=10%>Subject</th>
                        <th scope="col"  width=10%>Message</th>
                        <th scope="col"  width=10%>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      

                      @foreach ($messages as $mess)
                      <tr>
                        <th scope="row"> {{ $messages->firstItem()+$loop->index }}</th>
                        <td> {{ $mess->name }} </td>
                        <td> {{ $mess->email }} </td>
                        <td> {{ $mess->subject }} </td>
                        <td> {{ $mess->message }} </td>
                        <td><a href=" {{url('/contact/messages/delete/'.$mess->id)}}" class="btn btn-danger" onclick="return confirm('Are U Sure to delete') ">Delete</a></td>

                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  {{ $messages->links()}}

                </div>
              </div>


            </div>
    
        </div>

    </div>
        
    @endsection