@extends('admin.layouts.app')

@section('title')
Create Project
@endsection

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
      <div class="d-flex justify-content-between">
          <div class="">
            <h6 class="m-0 font-weight-bold text-primary">Create Project</h6>
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
                    <label for="name">Name :-</label>
                    <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" name="name" id="name">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-sm-12 mb-3 mb-sm-0 mt-3">
                    <label for="code">Unique Code :-</label>
                    <input type="text" class="form-control form-control-user @error('code') is-invalid @enderror" name="code" id="code">
                    @error('code')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-sm-12 mb-3 mb-sm-0 mt-3">
                    <label for="client">Client :-</label>
                    <input type="text" class="form-control form-control-user @error('client') is-invalid @enderror" name="client" id="client">
                    @error('client')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-sm-12 mb-3 mb-sm-0 mt-3">
                    <label for="location">Location :-</label>
                    <input type="text" class="form-control form-control-user @error('location') is-invalid @enderror" name="location" id="location">
                    @error('location')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                {{-- <div class="col-sm-12 mb-3 mb-sm-0 mt-3">
                    <label for=""></label>
                    <input type="date" class="form-control form-control-user @error('dated') is-invalid @enderror" name="dated" id="dated" placeholder="Date">
                    @error('dated')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div> --}}
                <input type="hidden" name="uploaded_by" id="uploaded_by" value="{{Auth::user()->id}}">
                <div class="col-sm-12 mb-3 mb-sm-0 mt-3">
                    <label for="scouted_by">Scouted By :-</label>
                    <input type="text" class="form-control form-control-user @error('scouted_by') is-invalid @enderror" name="scouted_by" id="scouted_by">
                    @error('scouted_by')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-sm-12 mb-3 mb-sm-0 mt-3">
                    <label for="spec_tag">Tags :-</label>
                    <input type="text" class="form-control form-control-user @error('spec_tag') is-invalid @enderror" name="spec_tag" id="spec_tag">
                    @error('spec_tag')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-user btn-block">
              Create Project
            </button>
        </form>
    </div>
</div>
@endsection
