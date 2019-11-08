@extends('admin.layouts.app')

@section('title')
Change User Password
@endsection

@section('content')
@if (\Session::has('success'))
    <div class="card border-left-success shadow">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
              <div class="text-xs font-weight-bold text-success text-uppercase">
                {!! \Session::get('success') !!}
              </div>
          </div>
        </div>
    </div>
@endif
<div class="card shadow mb-4">
    <div class="card-header py-3">
      <div class="d-flex justify-content-between">
        <div class="">
            <h6 class="m-0 font-weight-bold text-primary">Change User Password</h6>
        </div>
        <div class="">
          <a class="btn btn-warning btn-sm" href="{{route('user_list')}}">Back</a>
        </div>
      </div>
    </div>
    <div class="card-body">
        <form class="user" method="POST" action="{{ route('update_admin_password') }}">
            @csrf
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <p class="text-lg">{{ Auth::user()->name }}</p>
                </div>
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <p class="text-lg">{{ Auth::user()->email }}</p>
                </div>
            </div>


            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password">
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password">
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-user btn-block">
              Change Password
            </button>
        </form>
    </div>
</div>
@endsection
