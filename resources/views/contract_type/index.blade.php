@extends('layouts.adminapp')
@section('content')
<div class="container">
@if ($message = Session::get('success'))
    <div class="alert alert_msg">
        <p>{{ $message }}</p>
    </div>
@endif
<div class="title">
    <h3>Manage AMC Contract Type</h3>
    <!-- <div class="pull-right"> -->
        @can('contract-type-create')
            <a class="btn add_btn" href="{{ route('contract_type.create') }}">
                <i class="fa fa-plus" aria-hidden="true"></i>
            </a>
        @endcan
    <!-- </div> -->
</div>
<table class="table  dynamic-data-table">
    <thead  class="">
        <tr>
          <th scope="col">No</th>
          <th scope="col">Group</th>
          <th scope="col">Brand</th>
          <th scope="col">Model</th>
          <th scope="col">Product Code</th>
          <th scope="col">Product Name</th>
          <th scope="col">Product Description</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @if(isset($contractType) && $contractType)
            @php
                $i = 0;
            @endphp
            @foreach ($contractType as $value)
                @php
                    $i++;
                @endphp
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $value->group }}</td>
                    <td>{{ $value->brand }}</td>
                    <td>{{ $value->model }}</td>
                    <td>{{ $value->product_code }}</td>
                    <td>{{ $value->product_name }}</td>
                    <td>{{ $value->product_description }}</td>
                    <td>
                        @can('contract-type-edit')
                            <a href="{{Route('contract_type.edit',$value->id)}}"> <i class="fa fa-pencil" aria-hidden="true"></i> </a>
                        @endcan
                        @can('contract-type-delete')
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
    $('#deleteForm').attr('action','{{ url("contract_type") }}'+ '/'+id);
    $('#deleteModal').modal('show');
}
</script>
@endsection
