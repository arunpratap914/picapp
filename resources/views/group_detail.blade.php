@extends('layouts.app')
@section('title')
    Group
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
<section id="features" class="features">
    <div class="container">
        <h1 class="text-white">{{$group->name}}</h1>
        <div class="row">
            @forelse ($group->images as $key => $image)
            <div class="col-md-3 align-items-center p-3">
                    <a href="{{route('group',$group->id)}}">
                        <a href="{{asset('storage/images')}}/{{$image->filename}}" data-toggle="lightbox" data-gallery="gallery">
                            <img src="{{asset('storage/images/thumbnail')}}/{{$image->large}}" class="img-fluid rounded">
                        </a>
                    {{-- <h4>{{$image->filename}}</h4> --}}
                </a>
            </div>
            @empty
            <div class="col-md-12 pt-5 pl-5">
                    <p class="text-white">No Image Added</p>
                </div>
            @endforelse
        </div>

    </div>
</section>
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js"></script>
<script type="text/javascript">
$(document).on("click", '[data-toggle="lightbox"]', function(event) {
  event.preventDefault();
  $(this).ekkoLightbox();
});
$('#myModal').on('hidden.bs.modal', function () {
 location.reload();
})
</script>
@endsection
