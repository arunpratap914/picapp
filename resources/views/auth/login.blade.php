{{-- <!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>PicApp - Login</title>

  <!-- Custom fonts for this template-->
  <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                  </div> --}}
                @extends('layouts.app')
                @section('title')
                    Login
                @endsection
                @section('content')
                <section id="hero1" class="hero1 hero-home1 bg-gray1">
                        <div class="container">
                            <div class="align-items-center">

                  @if ($errors->any())
                    <div class="card border-left-danger shadow">
                        <div class="card-body">
                          <div class="row no-gutters align-items-center">
                              <div class="text-xs font-weight-bold text-danger text-uppercase">
                                @foreach ($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                              </div>
                          </div>
                        </div>
                    </div>
                  @endif
                  <h1>Login</h1>
                    <form method="POST" action="{{ route('login') }}" id="signupform" class="mt-5">
                        @csrf
                        <div class="form-group">
                            <input id="email" type="email" class="form-control form-control-user" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus aria-describedby="emailHelp" placeholder="Enter Email Address...">
                        </div>

                        <div class="form-group">
                            <input id="password" type="password" class="form-control form-control-user" name="password" required autocomplete="current-password" placeholder="Password">
                        </div>

                        <div class="form-group">
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="form-control" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="custom-control-label" for="remember">Remember Me</label>
                          </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            {{ __('Login') }}
                        </button>



                    </form>
                            </div>
                        </div>
                </section>
                    @endsection
                    {{-- <hr>
                    @if (Route::has('password.request'))
                    <div class="text-center">
                        <a class="small" href="{{ route('password.request') }}">Forgot Password?</a>
                    </div>
                    @endif
                    <div class="text-center">
                        <a class="small" href="/register">Create an Account!</a>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

</body>

</html> --}}
