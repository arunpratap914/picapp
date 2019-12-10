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
            <div class="dz-message" data-dz-message><span>Drop Folder/Directory here to upload</span></div>
        </form>
    </div>
    <div class="card-header py-3">
      <div class="d-flex justify-content-between">
          <div class="">
            <h6 class="m-0 font-weight-bold text-primary">Upload Images</h6>
          </div>
        </div>
    </div>
    <div class="card-body">
        <form method="post" action="{{url('admin/group/image/upload/store',$group->id)}}" enctype="multipart/form-data"
                  class="dropzone" id="dropzone2">
            @csrf
            <div class="dz-message" data-dz-message><span>Drop Files here to upload</span></div>
        </form>
    </div>
</div>
<div class="black-back" style="position: absolute;width: 100%;left: 0px;top: 0px;background: rgba(0, 0, 0, 0.3);height: 100%;display:none;">
    <div class="class-open" style="position: absolute;top: 10%;right: 2%;background: #bf0303;color: white;padding: 10px 20px;font-size: 20px;">
        Please wait while uploading..
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
            resizeQuality: 0.8,
            resizeWidth: 2000,
            renameFile: function(file) {

                relativePath = file.webkitRelativePath;
                var folder = relativePath.split("/");
                //console.log(folder[0]);

                var dt = new Date();
                var time = dt.getTime();
                return folder[0]+'_'+time+file.name;

            },
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: false,
            timeout: 5000,




            success: function(file, response)
            {
                //console.log(response);
            },
            error: function(file, response)
            {
               return false;
            }
};
var myDropzoneTheSecond = new Dropzone(
    //id of drop zone element 2
    '#dropzone2', {
        maxFilesize: 100,
        resizeQuality: 0.8,
        resizeWidth: 2000,
        renameFile: function(file) {
            var dt = new Date();
            var time = dt.getTime();
            var str = time+file.name;
            var newStr = str.replace(/_/g, "-");
            return newStr;

        },
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        addRemoveLinks: false,
        timeout: 5000,
    }
    //this
        //this.on("queuecomplete", function() {console.log('complete now');$('.black-back').hide();});
).on("addedfile", function() { $('.black-back').show(); }).on("queuecomplete", function() {$('.black-back').hide();});
$("#dropzone").dropzone({
    init: function() {
        this.on("addedfile", function() { $('.black-back').show(); });
        this.on("queuecomplete", function() { $('.black-back').hide(); });
        //console.log('start');
        this.hiddenFileInput.setAttribute("webkitdirectory", true);
    }
});
// $("#dropzone2").dropzone({
//     init: function() {
//         this.on("addedfile", function() { console.log('start now'); $('.black-back').show(); });
//         this.on("queuecomplete", function() {console.log('complete now');$('.black-back').hide();});
//         console.log('start');
//         //t//his.hiddenFileInput.setAttribute("webkitdirectory", true);
//     }
// });

</script>
@endsection
