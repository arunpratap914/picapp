@extends('admin.layouts.app')

@section('title')
Edit Image Detail
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
            <h6 class="m-0 font-weight-bold text-primary">Edit Image</h6>
          </div>
          <div class="">
            <a class="btn btn-warning btn-sm" href="{{route('admin_images')}}">Back</a>
          </div>
        </div>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-around mb-1">
            {{-- <div class="p-2 bg-info">Flex item 1</div> --}}
            <div class="p-2"><img src="{{asset('storage/images/thumbnail')}}/{{$image->small}}" class="img-fluid rounded pb-1" width="200px"></div>
            {{-- <div class="p-2 bg-primary">Flex item 3</div> --}}
        </div>
        <form class="user" method="POST" action="{{ route('update_image',$image->id) }}">
            @csrf
            {{ method_field('patch') }}
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user @error('title') is-invalid @enderror" name="title" id="title" placeholder="Enter title..." value="{{$image->title}}">
                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user @error('description') is-invalid @enderror" name="description" id="description" placeholder="Enter description..." value="{{$image->description}}">
                    @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

            </div>
            <button type="submit" class="btn btn-primary btn-user btn-block">
              Update Image
            </button>
        </form>
    </div>
</div>
@endsection
