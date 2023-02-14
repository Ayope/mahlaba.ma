<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Edit Profile</title>
</head>
<body style="overflow-y: hidden">
    @include('includes.navbar')
    
    <div class="d-flex justify-content-center align-items-center vh-100 flex-column">

        <h1 class="mb-4">
            Modify Profile
        </h1>

        <form action="{{route('update')}}" method="POST" enctype="multipart/form-data">


            @if(Session::has('success'))
                <div class="alert alert-success">{{Session::get('success')}}</div>
            @endif
            
            @if(Session::has('fail'))
                <div class="alert alert-danger">{{Session::get('fail')}}</div>
            @endif
            
            @method('PUT')

            @csrf
            <div class="pb-3">
                <label for="firstName">First Name: </label>
                <input type="text" class="form-control" name="firstName" size="35" value={{$user->firstName}}>
                <span class="text-danger">
                    @error('firstName')
                        {{ $message }}
                    @enderror
                </span>
            </div>

            <div class="pb-3">
                <label for="lastName">Last Name: </label>
                <input type="text" class="form-control" name="lastName" size="35" value={{$user->lastName}}>
                <span class="text-danger">
                    @error('lastName')
                        {{ $message }}
                    @enderror
                </span>
            </div>

            <div class="pb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" size="35" value={{$user->email}}>
                <span class="text-danger">
                    @error('email')
                        {{ $message }}
                    @enderror
                </span>
            </div>

            <div>
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password">
                <span class="text-danger">
                    @error('password')
                        {{ $message }}
                    @enderror
                </span>
            </div>

            <div class="mt-2 text-center">
                <button class="mt-2 w-50 rounded-pill p-2 text-white fw-bold" style="border:none; background: #172f1e;" name="login">Confirm</button>
            </div>
            
        </form>
        
        {{-- <div class="mt-2 text-center">
            <form action="{{route('deleteUser', [Session::get('loginUser'), $account = 2])}}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger mt-2 w-50 rounded-pill p-2 text-white fw-bold">Delete my account</button>
            </form>
        </div> --}}
    </div>

</body>
</html>