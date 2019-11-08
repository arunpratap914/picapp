@extends('admin.layouts.app')

@section('title')
Create Image Group
@endsection

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
      <div class="d-flex justify-content-between">
          <div class="">
            <h6 class="m-0 font-weight-bold text-primary">Create Image Group</h6>
          </div>
          <div class="">
            <a class="btn btn-warning btn-sm" href="{{route('group_list')}}">Back</a>
          </div>
        </div>
    </div>
    <div class="card-body">
        <form class="user" method="POST" action="{{ route('save_new_group') }}">
            @csrf
            <div class="form-group row">
                <div class="col-sm-12 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" name="name" id="name" placeholder="Name">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-user btn-block">
              Create Group
            </button>
        </form>
    </div>
</div>
@endsection
