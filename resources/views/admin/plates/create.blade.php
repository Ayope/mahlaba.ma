<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Add Plate</title>
</head>
<body >

    @include('includes.navbar')

    <form action="{{route('create.post')}}" method="post" class="container" enctype="multipart/form-data">     
      @if(Session::has('fail'))
          <div class="alert alert-danger">{{Session::get('fail')}}</div>
      @endif
      
      @csrf
        <div class="d-flex flex-column mb-3">
            <label for="image">Image</label>
            <input type="file" name="image" class="form-control" required value={{old('image')}}>
            <span class="text-danger">
              @error('image')
                  {{ $message }}
              @enderror
            </span>
        </div>
        
        <div class="d-flex flex-column mb-3">
            <label for="name">Plats name</label>
            <input type="text" name="name" required class="form-control" value={{old('name')}}>
            <span class="text-danger">
              @error('name')
                  {{ $message }}
              @enderror
          </span>
        </div>
        
        <div class="d-flex flex-column mb-3">
            <label for="price">Price</label>
            <input type="number" name="price" required class="form-control" value={{old('price')}}>
            <span class="text-danger">
              @error('price')
                  {{ $message }}
              @enderror
          </span>
        </div>

        <div class="d-flex flex-column mb-3">
            <label for="description">Description</label>
            <textarea name="description" cols="30" rows="10"  class="form-control" required>{{old('description')}}</textarea>
            <span class="text-danger">
              @error('description')
                  {{ $message }}
              @enderror
          </span>
          </div>
        
        <center class="d-flex w-100 justify-content-center">
            <button class="btn btn-primary d-flex justify-content-center my-3 me-2" type="submit">ADD</button>
            <a class="btn btn-secondary d-flex justify-content-center my-3 me-2" href="{{url('plates')}}">CANCEL</a>
        </center>
    </form>

</body>
</html>