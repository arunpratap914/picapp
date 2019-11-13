@extends('layouts.app')
@section('title')
    Home
@endsection
@section('styles')
<style>
header{
    display: none;
}
</style>
@endsection
@section('content')
<section id="hero1" class="hero1 hero-home1 bg-gray1">
        <div class="container">
            <div class="row equal align-items-center">
                <div class="col-md-6 text-center">
                    <img src="/images/header-the-network-film-productions-october16.png" style="max-width: 100%;">
                </div>
                <div class="col-md-6 ">
            @if ($errors->any())
                <div class="card border-left-danger shadow mb-3">
                    <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="text-xs font-weight-bold text-danger text-uppercase">
                            @foreach ($errors->all() as $error)
                                <p class="mb-0">{{ $error }}</p>
                            @endforeach
                        </div>
                    </div>
                    </div>
                </div>
            @endif
            <h1 class="text-white">Login</h1>
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
                        <label class="custom-control-label text-white" for="remember">Remember Me</label>
                    </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-user btn-block">
                        {{ __('Login') }}
                    </button>



                </form>
            </div>
            </div>
        </div>
</section>
@endsection
