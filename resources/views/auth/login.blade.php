<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Login</title>
</head>
<body>
    
    <div class="d-flex justify-content-center align-items-center vh-100 flex-column">

        <h1 class="mb-4">
            Login
        </h1>

        <form action="{{route('login.user')}}" method="POST" enctype="multipart/form-data">
            @if(Session::has('success'))
                <div class="alert alert-success">{{Session::get('success')}}</div>
            @endif
            
            @if(Session::has('fail'))
                <div class="alert alert-danger">{{Session::get('fail')}}</div>
            @endif
            
            @csrf

            <div class="pb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" value="{{old('email')}}" size="35" >
                <span class="text-danger">
                    @error('email')
                        {{ $message }}
                    @enderror
                </span>
            </div>

            <div>
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" value="{{old('password')}}" >
                <span class="text-danger">
                    @error('password')
                        {{ $message }}
                    @enderror
                </span>
            </div>

            <div class="mt-2 text-center">
                <button class="mt-2 w-50 rounded-pill p-2 text-white fw-bold" style="border:none; background: #172f1e;" name="login">Login</button>
            </div>

            <div class="text-center mt-3">
                <p>Don't have an account, <a href="{{url('registration')}}" class="d-block text-decoration-none"> Register</a></p>
            </div>

            <div class="text-center mt-3">
                <a href="{{url('forgotPassword')}}" class="d-block text-decoration-none">Forgot Password?</a>
            </div>
        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>