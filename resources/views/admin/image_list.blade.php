@extends('admin.layouts.app')

@section('title')
Images
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
    <div class="card-header">
      <div class="d-flex justify-content-between">
        <div class="">
          <h6 class="font-weight-bold text-primary">Images</h6>
        </div>
        <div class="">
          <a class="btn btn-success btn-sm" href="{{route('admin_upload_image')}}">Add New</a>
        </div>
      </div>
    </div>

    <div class="card-body">
      <div class="container">
        <div class="row">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th width="2%">#</th>
                  <th width="15%">Image</th>
                  <th>Title</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>#</th>
                  <th>Image</th>
                  <th>Title</th>
                  <th>Action</th>
                </tr>
              </tfoot>
              <tbody>
                @forelse($images as $key => $image)
                <tr id="image_{{$image->id}}">
                    <td>{{$key+1}}</td>
                    <td>
                            <a href="{{asset('storage/images')}}/{{$image->filename}}" data-toggle="lightbox" data-gallery="gallery">
                                <img src="{{asset('storage/images/thumbnail')}}/{{$image->small}}" class="img-fluid rounded">
                            </a>
                    </td>
                    <td>{{$image->title}}</td>
                    <td>
                      <a href="{{ route('edit_image',$image->id) }}" class="btn btn-info btn-sm text-gray-100">Edit</a>
                    <button data-toggle="modal" data-target="#myModal{{$image->id}}" class="btn btn-danger btn-sm">Delete</button>
                    </td>
                </tr>
                @empty
                <tr>
                  <td colspan="3"> No Image Found</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
</div>

@forelse($images as $key => $image)
<!-- The Modal -->
<div class="modal" id="myModal{{$image->id}}">
    <div class="modal-dialog">
        <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">Confirm Delete</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            Select "Delete" below if you want to delete this item.
        </div>

        <div class="modal-footer">
            <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button class="btn btn-primary" id="dlt_btn" onclick="return delete_image({{$image->id}});">Delete</button>
        </div>
        </div>
    </div>
</div>
@empty
@endforelse
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js"></script>
<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
function delete_image(id){
    $.ajax({
        type:'POST',
        url:"{{route('delete_image')}}",
        data:{id:id},
        success:function(data){
            $("#myModal"+data.id).modal('hide');
            $("#image_"+data.id).remove();
        }
    });
}
$(document).on("click", '[data-toggle="lightbox"]', function(event) {
  event.preventDefault();
  $(this).ekkoLightbox();
});
</script>
<!-- Page level plugins -->
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<!-- Page level custom scripts -->
<script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
@endsection
