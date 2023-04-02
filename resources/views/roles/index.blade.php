@extends('layouts.adminapp')
@section('content')
<div class="container">
    @if ($message = Session::get('success'))
        <div class="alert alert_msg">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="title">
        <h3>Manage User Role</h3>
        <!-- <div class="pull-right"> -->
            @can('role-create')
                <a class="btn add_btn" href="{{ Route('roles.create') }}">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                </a>
            @endcan
        <!-- </div> -->
    </div>
    <table class="table table-bordered dynamic-data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($roles) && $roles)
                @php
                    $i = 0;
                @endphp
                @foreach ($roles as $value)
                    @php $i++;  @endphp
                    <tr>
                        <td data-label="No">{{ $i }}</td>
                        <td data-label="Name">{{ $value->name }}</td>
                        <td data-label="Action">
                            @can('role-edit')
                                <a href="{{Route('roles.edit',$value->id)}}"> <i class="fa fa-pencil" aria-hidden="true"></i> </a>
                            @endcan
                            @can('role-delete')
                                <a onclick="deleteFunction( '{{ $value->id }}')"> <i class="fa fa-trash" aria-hidden="true"></i> </a>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    <div class="modal" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are sure want to delete</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn_tile" data-dismiss="modal">Cancel</button>
                    {!! Form::open(['method' => 'DELETE','style'=>'display:inline','id'=>'deleteForm']) !!}
                        <input type="submit" class="btn btn_tile" value="Delete">
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
      @endsection
@section('js-script')
<script>
function deleteFunction(id){
    $('#deleteForm').attr('action','{{ url("roles") }}'+ '/'+id);
    $('#deleteModal').modal('show');
}
</script>
