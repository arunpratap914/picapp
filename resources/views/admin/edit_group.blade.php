@extends('admin.layouts.app')

@section('title')
Edit Project
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
            <h6 class="m-0 font-weight-bold text-primary">Edit Project</h6>
          </div>
          <div class="">
            <a class="btn btn-warning btn-sm" href="{{route('group_list')}}">Back</a>
          </div>
        </div>
    </div>
    <div class="card-body" style="max-width:700px;">
        <form class="user" method="POST" action="{{ route('update_group',$group->id) }}">
            @csrf
            {{ method_field('patch') }}
            <div class="form-group row">
                <div class="col-sm-12 mb-3 mb-sm-0">
                    <label for="name">Name :-</label>
                    <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" name="name" id="name" placeholder="Name" value="{{$group->name}}">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-sm-12 mb-3 mb-sm-0 mt-3">
                    <label for="code">Unique Code :-</label>
                    <input type="text" class="form-control form-control-user @error('code') is-invalid @enderror" name="code" id="code" placeholder="Group Code" value="{{$group->code}}">
                    @error('code')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-sm-12 mb-3 mb-sm-0 mt-3">
                    <label for="client">Client :-</label>
                    <input type="text" class="form-control form-control-user @error('client') is-invalid @enderror" name="client" id="client" placeholder="Client" value="{{$group->client}}">
                    @error('client')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-sm-12 mb-3 mb-sm-0 mt-3">
                    <label for="location">Location :-</label>
                    <input type="text" class="form-control form-control-user @error('location') is-invalid @enderror" name="location" id="location" placeholder="Location" value="{{$group->location}}">
                    @error('location')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                {{-- <div class="col-sm-12 mb-3 mb-sm-0 mt-3">
                    <input type="date" class="form-control form-control-user @error('dated') is-invalid @enderror" name="dated" id="dated" placeholder="Date" value="{{$group->dated}}">
                    @error('dated')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div> --}}
                {{-- <input type="text" name="uploaded_by" id="uploaded_by" value="{{Auth::user()->id}}"> --}}
                <div class="col-sm-12 mb-3 mb-sm-0 mt-3">
                    <label for="scouted_by">Scouted By :-</label>
                    <input type="text" class="form-control form-control-user @error('scouted_by') is-invalid @enderror" name="scouted_by" id="scouted_by" placeholder="Scouted by" value="{{$group->scouted_by}}">
                    @error('scouted_by')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-sm-12 mb-3 mb-sm-0 mt-3">
                    <label for="spec_tag">Tags :-</label>
                    <input type="text" class="form-control form-control-user @error('spec_tag') is-invalid @enderror" name="spec_tag" id="spec_tag" placeholder="Special Tag" value="{{$group->spec_tag}}">
                    @error('spec_tag')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-user btn-block">
              Update Project
            </button><br>
        </form>
    </div>
</div>
@endsection
