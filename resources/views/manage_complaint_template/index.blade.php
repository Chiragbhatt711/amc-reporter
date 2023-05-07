@extends('layouts.adminapp')
@section('content')
<div class="container">
@if ($message = Session::get('success'))
    <div class="alert alert_msg">
        <p>{{ $message }}</p>
    </div>
@endif
<div class="title">
    <h3>Manage Complaint Template</h3>
        @can('manage-complaint-template-create')
            <a class="btn add_btn" href="{{ route('manage_complaint_template.create') }}">
                <i class="fa fa-plus" aria-hidden="true"></i>
            </a>
        @endcan
</div>
<table class="table table-bordered dynamic-data-table">
    <thead  class="">
        <tr>
          <th scope="col">No</th>
          <th scope="col">Template Name</th>
          <th scope="col">Template Description</th>
          <th scope="col">Priority</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @if(isset($complaintTemplate) && $complaintTemplate)
            @php
                $i = 0;
            @endphp
            @foreach ($complaintTemplate as $value)
                @php
                    $i++;
                @endphp
                <tr>
                    <td data-label="No">{{ $i }}</td>
                    <td data-label="Template Name">{{ $value->title }}</td>
                    <td data-label="Template Description">{{ $value->description }}</td>
                    <td data-label="Priority">{{ $value->priority }}</td>
                    <td data-label="Action">
                        @can('manage-complaint-template-edit')
                            <a href="{{Route('manage_complaint_template.edit',$value->id)}}"> <i class="fa fa-pencil" aria-hidden="true"></i> </a>
                        @endcan
                        @can('manage-complaint-template-delete')
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
              <button type="button" class="btn btn_tile" data-bs-dismiss="modal">Cancel</button>
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
    $('#deleteForm').attr('action','{{ url("manage_complaint_template") }}'+ '/'+id);
    $('#deleteModal').modal('show');
}
</script>
@endsection
