@extends('admin.layouts.app')

@section('title')
Edit Image Detail
@endsection

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css">
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<style type="text/css">
.row {
  margin: 15px;
}
</style>
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
    <div class="card-body row">
        <div class = "col-md-6">
            <div class="d-flex justify-content-around mb-1">
                {{-- <div class="p-2 bg-info">Flex item 1</div> --}}
                <div class="p-2">
                    <a href="{{asset('storage/images')}}/{{$image->filename}}" data-toggle="lightbox" data-gallery="gallery">
                        <img src="{{asset('storage/images/thumbnail')}}/{{$image->large}}" class="img-fluid rounded pb-1" width="">
                    </a>
                </div>
                {{-- <div class="p-2 bg-primary">Flex item 3</div> --}}
            </div>
        </div>
        <div class = "col-md-6 pt-4">
            <form class="user" method="POST" action="{{ route('update_image',$image->id) }}">
                @csrf
                {{ method_field('patch') }}
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label>Project Tag:-</label>
                        <input type="text" class="form-control form-control-user @error('tag') is-invalid @enderror" name="tag" id="tag" value="{{$image->tag}}" readonly>
                        @error('tag')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label>Uploaded By Folder Name:-</label>
                        <input type="text" class="form-control form-control-user @error('title') is-invalid @enderror" name="title" id="title" value="{{$image->title}}" readonly>
                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-12 mb-3 mb-sm-0 pt-4">
                        <label>Custom Tags (seperated by comma):-</label>
                        <input type="text" class="form-control form-control-user @error('description') is-invalid @enderror" name="description" id="description" value="{{$image->description}}">
                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block mt-4">
                Update Image
                </button>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js"></script>
<script type="text/javascript">
$(document).on("click", '[data-toggle="lightbox"]', function(event) {
  event.preventDefault();
  $(this).ekkoLightbox();
});
</script>
@endsection
