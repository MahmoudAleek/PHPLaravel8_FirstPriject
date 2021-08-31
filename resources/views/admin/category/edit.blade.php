<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          All Category... 
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="container">
            <div class="row">

              <div class="col-md-8">
                <div class="card">
                  <div class="card-header"> Edit Category</div>

                  <div class="card-body">

                    <form action="{{url('category/update/'.$category->id)}}" method="POST">
                      @CSRF
                      <div class="form-group">
                        <label for="category-name">Edit Category Name</label>
                        <input type="text" name="category_name" id="category-name" class="form-control" value="{{ $category->category_name}}">
                        @error('category_name')
                          <span class="text-danger"> {{$message}} </span>
                        @enderror
                      </div>
  
                      <button type="submit" class="btn btn-primary" style="margin-top:15px"> Edit Category </button>
                    </form>
                  </div>

                </div>
              </div>



            </div>
    
        </div>

    </div>



</x-app-layout>
