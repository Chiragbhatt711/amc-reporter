@extends('layouts.adminapp')
@section('content')
<!-- PAGE-HEADER -->
<div class="page-header d-flex align-items-center justify-content-between border-bottom mb-4">
    <h1 class="page-title">Manage AMC Contract Type</h1>
    {{-- <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">AMC Dashboard</li>
        </ol>
    </div> --}}
</div>
<!-- PAGE-HEADER END -->

<!-- CONTAINER -->
<div class="main-container container-fluid">
    <!-- Start:: row-2 -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">
                        @can('contract-type-create')
                            <a class="btn btn-primary btn-block float-end my-2" href="{{ route('contract_type.create') }}">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div id="grid-pagination">
                        <table class="table table-bordered dynamic-data-table">
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
                                        <td data-label="No">{{ $i }}</td>
                                        <td data-label="Group">{{ $value->group }}</td>
                                        <td data-label="Brand">{{ $value->brand }}</td>
                                        <td data-label="Model">{{ $value->model }}</td>
                                        <td data-label="Product Code">{{ $value->product_code }}</td>
                                        <td data-label="Product Name">{{ $value->product_name }}</td>
                                        <td data-label="Product Description">{{ $value->product_description }}</td>
                                        <td data-label="Action">
                                            @can('contract-type-edit')
                                                <a class="btn btn-sm btn-icon btn-info-light rounded-circle" href="{{Route('contract_type.edit',$value->id)}}"> <i class="bi bi-pencil-square" aria-hidden="true"></i> </a>
                                            @endcan
                                            @can('contract-type-delete')
                                                <a class="btn btn-sm btn-icon btn-secondary-light rounded-circle" onclick="deleteFunction( '{{ $value->id }}')"> <i class="bi bi-trash" aria-hidden="true"></i> </a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
            {!! Form::open(['method' => 'DELETE','style'=>'display:inline','id'=>'deleteForm']) !!}
                <input type="submit" class="btn btn-primary" value="Delete">
            {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
<!-- CONTAINER CLOSED -->
<script>
    function deleteFunction(id){
        $('#deleteForm').attr('action','{{ url("contract_type") }}'+ '/'+id);
        $('#deleteModal').modal('show');
    }
</script>
@endsection
