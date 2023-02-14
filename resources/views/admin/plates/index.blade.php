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

    <div class="d-flex flex-column my-3 container">
      @if(Session::has('success'))
        <div class="alert alert-success">{{Session::get('success')}}</div>
      @endif
      
      @if(Session::has('fail'))
        <div class="alert alert-danger">{{Session::get('fail')}}</div>
      @endif

        <h3>
            Plates List:
        </h3>

        <a class="btn btn-primary" href="{{url('create')}}">+ ADD</a>
        
        <table class="table">
            <thead>
                <tr>
                    <th>Images</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            

                @foreach ($plates as $plate)
                    <tr>
                        <th><img src="{{asset('images/' . $plate->image)}}" height="100px" width="80px"></th>
                        <th>{{$plate->name}}</th>
                        <th>{{$plate->price}}</th>
                        <th>{{$plate->description}}</th>
                        <th>
                            <a class="btn btn-primary mb-2" href="{{route('edit.get', $plate->id)}}">UPDATE</a>

                            <form action="{{route('delete', $plate->id)}}" method="POST">
                              @csrf
                              @method('DELETE')
                              <button class="btn btn-danger" type="submit">DELETE</button>
                            </form>

                        </th>
                    </tr> 
                @endforeach                    
                
            </tbody>
        </table>
    </div>




</body>
</html>