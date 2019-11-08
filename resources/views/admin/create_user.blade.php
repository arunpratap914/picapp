@extends('admin.layouts.app')

@section('title')
Create User
@endsection

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
      <div class="d-flex justify-content-between">
        <div class="">
            <h6 class="m-0 font-weight-bold text-primary">Create User</h6>
        </div>
        <div class="">
          <a class="btn btn-warning btn-sm" href="{{route('user_list')}}">Back</a>
        </div>
      </div>
    </div>
    <div class="card-body">
        <form class="user" method="POST" action="{{ route('save_new_user') }}">
            @csrf
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" name="name" id="name" placeholder="Name">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email Address">
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password">
                </div>
                <div class="col-sm-6 mb-sm-0">
                    <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password">
                </div>
                @error('password')
                    <div class="alert alert-danger col-sm-12">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary btn-user btn-block">
              Create User
            </button>
        </form>
    </div>
</div>
@endsection
