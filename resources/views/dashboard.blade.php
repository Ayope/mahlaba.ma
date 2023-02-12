<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Dashboard</title>
</head>
<body>

    <nav class="navbar bg-primary">
        <div class="container-fluid">
            <h4><a class="navbar-brand" href="#">Dashboard</a></h4>
          
            <a href="{{ url('logout') }}" class="btn btn-secondary" type="submit">Logout</a>
        </div>
    </nav>

    <div class="d-flex vh-100 flex-column my-3 container">
        <h3>
            Users List:
        </h3>
        <table class="table">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            

                @foreach ($users as $user)
                    <tr>
                        <th>{{$user->firstName}}</th>
                        <th>{{$user->lastName}}</th>
                        <th>{{$user->email}}</th>
                        <th class="d-flex">
                            <a class="btn btn-danger me-1" href="#">DELETE</a>
                            
                            <div>
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Set as
                                </button>
                                
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Admin</a></li>
                                    <li><a class="dropdown-item" href="#">User</a></li>
                                </ul>
                            </div>
                        </th>
                    </tr> 
                @endforeach                    
                
            </tbody>
        </table>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>