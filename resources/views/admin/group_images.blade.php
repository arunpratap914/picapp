@extends('admin.layouts.app')

@section('title')
Group Images
@endsection

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css">
<style type="text/css">
.row {
  margin: 15px;
}
</style>
@endsection
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
      <div class="d-flex justify-content-between">
        <div class="">
            <h6 class="m-0 font-weight-bold text-primary">Group Images</h6>
        </div>
        <div class="">
          <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal">Add More</button>
          <a class="btn btn-warning btn-sm" href="{{route('group_list')}}">Back</a>
        </div>
      </div>
    </div>
    <div class="card-body">
        <div class="container">
            <div class="row">

                @forelse($group->images as $key => $image)
                    <div class="col-md-2 p-2" id="image_{{$image->id}}">
                        <a href="{{asset('storage/images')}}/{{$image->filename}}" data-toggle="lightbox" data-gallery="gallery">
                            <img src="{{asset('storage/images/thumbnail')}}/{{$image->small}}" class="img-fluid rounded">
                        </a>
                        <button class="btn btn-sm btn-danger" onclick="return delete_image({{$image->id}},{{$group->id}});">Delete</button>
                    </div>
                @empty
                    <p>No Image Found</p>
                @endforelse
            </div>
        </div>
    </div>
</div>



<!-- The Modal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h1 class="modal-title">Select Images</h1>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <div class="container">
                <div class="row">
                    @forelse($images as $key => $image)
                        <div class="col-md-2 p-2" id="image_{{$image->id}}">

                            <img src="{{asset('storage/images/thumbnail')}}/{{$image->small}}" class="img-fluid rounded" @if (!in_array($image->id, $selected_images)) onclick="return add_image({{$image->id}},{{$group->id}});" @endif>
                            @if (in_array($image->id, $selected_images))
                                <p>Already added</p>
                            @endif
                            <p id="image_added_{{$image->id}}" style="display: none;">Added</p>
                        </div>
                    @empty
                        <p>No Image Found</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js"></script>
<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
function add_image(image_id,group_id){
    $.ajax({
           type:'POST',
           url:"{{route('add_group_images')}}",
           data:{group_id:group_id,image_id:image_id},
           success:function(data){
                   $("#image_added_"+data.image).show();
           }
        });
}
function delete_image(image_id,group_id){
    $.ajax({
           type:'POST',
           url:"{{route('remove_group_images')}}",
           data:{group_id:group_id,image_id:image_id},
           success:function(data){
                   $("#image_"+data.image).hide();
           }
        });
}
$(document).on("click", '[data-toggle="lightbox"]', function(event) {
  event.preventDefault();
  $(this).ekkoLightbox();
});
$('#myModal').on('hidden.bs.modal', function () {
 location.reload();
})
</script>
@endsection
