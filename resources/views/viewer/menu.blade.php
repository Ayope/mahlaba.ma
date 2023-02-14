<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Mahlaba.ma</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link rel="stylesheet" href="../../css/app.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

</head>

<body>
  @if(Session::get('role') == 'admin' || Session::get('role') == 'superAdmin')
    @include('includes.navbar')
  @endif

<section>

    @if(!Session::has('loginUser'))
        <div class="d-flex justify-content-end pt-3 pe-3">
            <a href="{{ url('login') }}" class="btn btn-secondary me-2">Login</a>
            <a href="{{ url('registration') }}" class="btn btn-primary">SignUp</a>
        </div>
    @endif

    @if(Session::has('loginUser') && Session::get('role') != 'superAdmin')
    @if(Session::get('role') != 'admin')
    <div class="d-flex justify-content-end pt-3 pe-3">
        <a href="{{ route('edit') }}" class="btn btn-primary me-2">Edit Account</a>
        <a href="{{ url('logout') }}" class="btn btn-secondary ">Logout</a>
    </div>
    @endif
    @endif

    <div class="container">

      <div class=>
        <h2>Our Menu</h2>
        <p>Check Our <span>Yummy Menu</span></p>
      </div>

      <div>

        <div>

          <div class="d-flex flex-column text-center">
            <h1>Mahlaba.ma</h1>
            <h3>Menu</h3>
          </div>

          <div class="row gy-5 mt-3">
            @foreach($plates as $plate)
            <div class="col-lg-4 menu-item">
              <a href="{{asset('images/' . $plate->image)}}" class="glightbox" ><img class="border border-dark" src="{{asset('images/' . $plate->image)}}" height="190px" width="170px"></a>
              <h4>{{$plate->name}}</h4>
              <p>
                {{$plate->description}}
              </p>
              <p>
                {{$plate->price}} DH
              </p>
            </div><!-- Menu Item -->
            @endforeach

          </div>
        </div><!-- End Starter Menu Content -->

</body>
</html>
