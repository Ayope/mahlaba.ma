<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Users</title>
</head>
<body>
    {{-- {{dd($users)}} --}}
    @include('includes.navbar')   

    <div class="d-flex flex-column my-3 container">
        <h3>
            Users List:
        </h3>

        @if(Session::has('success'))
          <div class="alert alert-success">{{Session::get('success')}}</div>
        @endif
  
        @if(Session::has('fail'))
          <div class="alert alert-danger">{{Session::get('fail')}}</div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>role</th>
                    @if(Session::get('role') == 'superAdmin')
                      <th>Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
            

                @foreach ($users as $user)
                    <tr>
                        <th>{{$user->firstName}}</th>
                        <th>{{$user->lastName}}</th>
                        <th>{{$user->email}}</th>
                        <th>{{$user->role}}</th>
                        @if(Session::get('role') == 'superAdmin')
                          <th class="d-flex">
                              <form action="{{route('deleteUser', [$user->id, $account = 1])}}" method="POST">
                                  @csrf
                                  @method('DELETE')
                                  <button class="btn btn-danger me-2" type="submit">DELETE</button>
                                </form>
                              
                              <div>

                                  <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                      Set as
                                  </button>
                                    
                                  <ul class="dropdown-menu">
                                      <li><a class="dropdown-item" href="{{route('switch', [$index = 1, $user->id])}}">Admin</a></li>
                                      <li><a class="dropdown-item" href="{{route('switch', [$index = 2, $user->id])}}">User</a></li>
                                  </ul>
                              </div>
                          </th>
                        @endif
                    </tr> 
                @endforeach                    
                
            </tbody>
        </table>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>