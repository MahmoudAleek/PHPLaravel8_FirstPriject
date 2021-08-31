<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Document</title>
</head>
<body>

    <table class="table">
        <thead>
          <tr>
            <th scope="col">#Sl NO</th>
            <th scope="col">Book Name</th>
            <th scope="col">Type</th>
            <th scope="col">Created At</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
            <tr>
                <td>{{$book->id}}</td>
                <td>{{$book->name}}</td>
                <td>{{$book->type}}</td>
                <td>{{$book->created_at}}</td>

              </tr>
            @endforeach

        </tbody>
      </table>


      <div class="col-md-4">
        <div class="card">
          <div class="card-header"> Add Books</div>

          <div class="card-body">

            <form action="{{route('sasa_search2')}}" method="POST">
              @CSRF
              <div class="form-group">
                <label for="category-name">Book Name</label>
                <input type="text" name="book_name" id="category-name" class="form-control">
                @error('book_name')
                  <span class="text-danger"> {{$message}} </span>
                @enderror
              </div>
              <div class="form-group">
                <label for="category-name">Book Type</label>
                <input type="text" name="book_type" id="category-name" class="form-control">
                @error('book_type')
                  <span class="text-danger"> {{$message}} </span>
                @enderror
              </div>

              <button type="submit" class="btn btn-primary" style="margin-top:15px"> Add Book </button>
            </form>
          </div>

        </div>
      </div>

    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
          Dropdown button
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            @foreach ($books as $book)
          <li><a class="dropdown-item" href="{{url('search/'.$book->id)}}">{{$book->type}}</a></li>
            @endforeach
        </ul>
      </div>


      <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>