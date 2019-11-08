@extends('admin.layouts.app')

@section('title')
Edit Group Detail
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
            <h6 class="m-0 font-weight-bold text-primary">Edit Group</h6>
          </div>
          <div class="">
            <a class="btn btn-warning btn-sm" href="{{route('group_list')}}">Back</a>
          </div>
        </div>
    </div>
    <div class="card-body">
        <form class="user" method="POST" action="{{ route('update_group',$group->id) }}">
            @csrf
            {{ method_field('patch') }}
            <div class="form-group row">
                <div class="col-sm-12 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" name="name" id="name" placeholder="Name" value="{{$group->name}}">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

            </div>
            <button type="submit" class="btn btn-primary btn-user btn-block">
              Update Group
            </button>
        </form>
    </div>
</div>
@endsection
