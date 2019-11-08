@extends('admin.layouts.app')

@section('title')
Edit Admin Detail
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
            <h6 class="m-0 font-weight-bold text-primary">Edit Detail</h6>
        </div>
        <div class="">
          <a class="btn btn-warning btn-sm" href="{{route('admin_dashboard')}}">Back</a>
        </div>
      </div>
    </div>
    <div class="card-body">
        <form class="user" method="POST" action="{{ route('update_admin_profile') }}">
            @csrf
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" name="name" id="name" placeholder="Name" value="{{ Auth::user()->name }}">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email Address" value="{{ Auth::user()->email }}">
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-user btn-block">
              Update Detail
            </button>
        </form>
    </div>
</div>
@endsection
