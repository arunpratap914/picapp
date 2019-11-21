@extends('admin.layouts.app')

@section('title')
Project List
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
          <h6 class="m-0 font-weight-bold text-primary">Project List</h6>
        </div>
        <div class="">
          <a class="btn btn-success btn-sm" href="{{route('create_new_group')}}">Add New</a>
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
              <th>Project Code</th>
              <th>Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Project Code</th>
              <th>Action</th>
            </tr>
          </tfoot>
          <tbody>
            @forelse($groups as $key => $group)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$group->name}}</td>
                <td>{{$group->code}}</td>
                <td>
                    <a href="{{ route('edit_group',$group->id) }}" class="btn btn-info btn-sm text-gray-100">Edit</a>
                    <button data-toggle="modal" data-target="#myModal" class="btn btn-danger btn-sm text-gray-100">Delete</button>
                    <a href="{{route('group_images',$group->id)}}" class="btn btn-primary btn-sm text-gray-100">Images</a>
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
                            <a class="btn btn-primary" href="{{ route('delete_group',$group->id) }}">Delete</a>
                        </div>
                        </div>
                    </div>
                </div>
            @empty
            <tr>
              <td colspan="3"> No Project Found</td>
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
