@extends('admin.layouts.app')

@section('title')
Project Images
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
<div class="card shadow mb-4">
    <div class="card-header py-3">
      <div class="d-flex justify-content-between">
        <div class="">
        <h6 class="m-0 font-weight-bold text-primary">{{$group->name}} Project Images</h6>
        </div>
        <div class="">
          <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">Select From Library</button>
        <a href="{{route('admin_upload_image_group',$group->id)}}" class="btn btn-success btn-sm">Upload</a>
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
                        <div class="d-flex justify-content-between mb-1">
                          <div class="p-2">{{$group->code}}-{{$image->id}}</div>
                          <button class="btn btn-sm btn-danger mr-2" onclick="return delete_image({{$image->id}},{{$group->id}});" style="border-radius: 50%; width: 30px; height: 30px; margin-top: 5px; font-size: 14px; line-height: 14px;">X</button>
                        </div>
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
          <h4 class="modal-title">Select Images</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <div class="container">
                <div class="row"><!--
                    @forelse($images as $key => $image)
                        <div class="col-md-2 p-2" id="12image_{{$image->id}}">

                            <img src="{{asset('storage/images/thumbnail')}}/{{$image->small}}" class="img-fluid rounded" @if (!in_array($image->id, $selected_images)) onclick="return add_image({{$image->id}},{{$group->id}});" @endif>
                            @if (in_array($image->id, $selected_images))
                                <p>Already added</p>
                            @endif
                            <p id="12image_added_{{$image->id}}" style="display: none;">Added</p>
                        </div>
                    @empty
                        <p>No Image Found</p>
                    @endforelse
  -->
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th width="15%">Image</th>
                  <th style="display:none">Project Tag</th>
                  <th style="display:none">Folder Tag*</th>
                  <th style="display:none">Tag*</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Image</th>
                  <th style="display:none">Project Tag</th>
                  <th style="display:none">Folder Tag*</th>
                  <th style="display:none">Tag*</th>
                </tr>
              </tfoot>
              <tbody class="row p-0 m-0">
                @forelse($images as $key => $image)
                <tr id="image_{{$image->id}}" class="col-md-2 border-0 m-0 p-0">
                    <td class="border-0 pb-2" id="image_{{$image->id}}">
                       <img src="{{asset('storage/images/thumbnail')}}/{{$image->small}}" data-toggle="tooltip" data-placement="bottom" title="Click To Add" style="cursor: pointer;" class="img-fluid rounded" @if (!in_array($image->id, $selected_images)) onclick="return add_image({{$image->id}},{{$group->id}});" @endif>
                       @if (in_array($image->id, $selected_images))
                                <p>Already added</p>
                            @endif
                            <p id="image_added_{{$image->id}}" style="display: none;">Added</p>
                    </td>
                    <td style="display:none">{{$image->tag}}</td>
                    <td style="display:none">{{$image->title}}</td>
                    <td style="display:none">{{$image->description}}</td>
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
<!-- Page level plugins -->
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<!-- Page level custom scripts -->
<script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
@endsection
