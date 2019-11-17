@extends('admin.layouts.app')

@section('title')
User Likes
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
    <div class="card-header">
      <div class="d-flex justify-content-between">
        <div class="">
          <h6 class="font-weight-bold text-primary">User Likes</h6>
        </div>
        <div class="">
            <a class="btn btn-warning btn-sm" href="{{route('admin_user_groups',$user->id)}}">Back</a>
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
                  <th>Image</th>
                  <th>Code</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>#</th>
                  <th>Image</th>
                  <th>Code</th>
                </tr>
              </tfoot>
              <tbody>
                @forelse($likes as $key => $like)
                <tr>
                    <td>{{$num}}</td>
                    <td>
                        <a href="{{asset('storage/images')}}/{{$like->image->filename}}" data-toggle="lightbox" data-gallery="gallery">
                            <img src="{{asset('storage/images/thumbnail')}}/{{$like->image->small}}" class="img-fluid rounded">
                        </a>
                    </td>
                    <td>{{$group->code}}-{{$like->image->id}}</td>
                </tr>
                @php
                    $num =$num+1;
                @endphp
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

@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js"></script>
<script type="text/javascript">
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
