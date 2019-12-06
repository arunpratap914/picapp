@extends('admin.layouts.app')

@section('title')
Upload Images
@endsection
@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
@endsection

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
      <div class="d-flex justify-content-between">
          <div class="">
            <h6 class="m-0 font-weight-bold text-primary">Folder Upload Images</h6>
          </div>
          <div class="">
            <a class="btn btn-warning btn-sm" href="{{route('group_images',$group->id)}}">Back</a>
          </div>
        </div>
    </div>
    <div class="card-body">
        <form method="post" action="{{url('admin/group/image/upload/store',$group->id)}}" enctype="multipart/form-data"
                  class="dropzone" id="dropzone">
            @csrf
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>

<script type="text/javascript">
Dropzone.autoDiscover = false;
$.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

        });
        Dropzone.options.dropzone =
         {
            maxFilesize: 100,
            renameFile: function(file) {

                relativePath = file.webkitRelativePath;
                var folder = relativePath.split("/");
                console.log(folder[0]);

                var dt = new Date();
                var time = dt.getTime();
                return folder[0]+'_'+time+file.name;

            },
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: false,
            timeout: 5000,




            success: function(file, response)
            {
                console.log(response);
            },
            error: function(file, response)
            {
               return false;
            }

};
$("#dropzone").dropzone({
    init: function() {
        this.hiddenFileInput.setAttribute("webkitdirectory", true);
    }
});
</script>
@endsection
