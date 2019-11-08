@extends('layouts.app')
@section('title')
    Home
@endsection
@section('content')
<section id="hero" class="hero hero-home bg-gray">
    <div class="container">
        <div class="row d-flex">
        <div class="col-lg-6 text order-2 order-lg-1">
            <h1>Welcome &nbsp; to &nbsp; the PicApp</h1>
            <p class="hero-text">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour</p>
            <div class="CTA">
                @guest
                <a href="{{route('login')}}" class="btn btn-outline-primary">Login</a>
                @else
                <a href="{{route('user_groups')}}" class="btn btn-primary btn-shadow btn-gradient link-scroll">View Groups</a>
                @endguest
            </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2"><img src="front/img/Macbook.png" alt="..." class="img-fluid"></div>
        </div>
    </div>
</section>
@endsection
