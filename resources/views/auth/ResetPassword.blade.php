<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Reset Password</title>
</head>
<body>

    <div class="d-flex justify-content-center align-items-center vh-100 flex-column">

        <h1 class="mb-4">
            Reset your password
        </h1>
    
        <form action="{{ route('reset.password.post') }}" method="POST">
            @csrf
            
            @if(Session::has('success'))
                <div class="alert alert-success">{{Session::get('success')}}</div>
            @endif
            
            @if(Session::has('fail'))
                <div class="alert alert-danger">{{Session::get('fail')}}</div>
            @endif

            <input type="hidden" name="token" value="{{ $token }}">

            <input type="text" name="email">
        
            <div>
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" value="{{old('password')}}" autofocus>
                <span class="text-danger">
                    @error('password')
                        {{ $message }}
                    @enderror
                </span>
            </div>

            <div class="mt-3">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" class="form-control" name="password_confirmation" size=35 required>
                <span class="text-danger">
                    @error('password_confirmation')
                        {{ $message }}
                    @enderror
                </span>
            </div>

            <div class="mt-2 text-center">
                <button class="mt-2 w-50 rounded-pill p-2 text-white fw-bold" style="border:none; background: #172f1e;">Reset Password</button>
            </div>
        </form>
    </div>

        {{-- 
    
        <div class="form-group row">
            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
            <div class="col-md-6">
                <input type="password" id="password" class="form-control" name="password" required autofocus>
                @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
            </div>
        </div>
    
        <div class="form-group row">
            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
            <div class="col-md-6">
                <input type="password" id="password-confirm" class="form-control" name="password_confirmation" required autofocus>
                @if ($errors->has('password_confirmation'))
                    <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                @endif
            </div>
        </div>
    
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                Reset Password
            </button>
        </div> --}}
</body>
</html>