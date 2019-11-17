@extends('admin.layouts.app')

@section('title')
User Images Groups
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
          <h6 class="font-weight-bold text-primary">User Groups</h6>
        </div>
        <div class="">
            <a class="btn btn-warning btn-sm" href="{{route('user_list')}}">Back</a>
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
                  <th>Name</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Action</th>
                </tr>
              </tfoot>
              <tbody>
                @forelse($user->groups as $key => $group)
                <tr id="image_{{$group->id}}">
                    <td>{{$key+1}}</td>
                    <td>{{$group->name}}</td>
                <td><a href="{{route('admin_users_image_liked',[$user->id,$group->id])}}" class="btn btn-success btn-sm">View Liked Images</a></td>
                </tr>
                @empty
                <tr>
                  <td colspan="3"> No Group Found</td>
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
<!-- Page level plugins -->
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<!-- Page level custom scripts -->
<script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
@endsection
