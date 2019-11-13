@extends('admin.layouts.app')

@section('title')
User List
@endsection
@section('styles')
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
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
          <h6 class="m-0 font-weight-bold text-primary">User List</h6>
        </div>
        <div class="">
          <a class="btn btn-success btn-sm" href="{{route('create_new_user')}}">Add New</a>
        </div>
      </div>
    </div>

    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Email</th>
              <th>Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Email</th>
              <th>Action</th>
            </tr>
          </tfoot>
          <tbody>
            @forelse($users as $key => $user)
            <tr>
                <td>{{$key}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>
                    <a href="{{ route('edit_user',$user->id) }}" class="btn btn-info btn-sm text-gray-100">Edit</a>
                    <button class="btn btn-danger btn-sm text-gray-100" data-toggle="modal" data-target="#myModal">Delete</button>
                    <a href="{{ route('change_user_password',$user->id) }}" class="btn btn-primary btn-sm text-gray-100">Change Password</a>
                </td>
            </tr>
            <!-- The Modal -->
            <div class="modal" id="myModal">
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
                        <a class="btn btn-primary" href="{{ route('delete_user',$user->id) }}">Delete</a>
                    </div>
                    </div>
                </div>
            </div>
            @empty
            <tr>
              <td colspan="3"> No user Found</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
</div>






@endsection


@section('scripts')
<!-- Page level plugins -->
  <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

  <!-- Page level custom scripts -->
  <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
@endsection
