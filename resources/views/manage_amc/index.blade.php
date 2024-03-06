@extends('layouts.adminapp')
@section('content')
<!-- PAGE-HEADER -->
<div class="page-header d-flex align-items-center justify-content-between border-bottom mb-4">
    <h1 class="page-title">Manage AMC</h1>
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
                        @can('manage-amc-create')
                            <a class="btn btn-primary btn-block float-end my-2" href="{{ route('manage_amc.create') }}">
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
                                  <th scope="col">Party Name</th>
                                  <th scope="col">Person Name</th>
                                  <th scope="col">City</th>
                                  <th scope="col">Mobile No</th>
                                  <th scope="col">AMC Type</th>
                                  <th scope="col">AMC Start Date</th>
                                  <th scope="col">AMC End Date</th>
                                  <th scope="col">Contract Amount</th>
                                  <th scope="col">Taxt</th>
                                  <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($manageAmc) && $manageAmc)
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach ($manageAmc as $value)
                                        @php
                                            $i++;
                                        @endphp
                                        <tr>
                                            <td data-label="No">
                                                <a class="btn btn-sm btn-icon btn-info-light rounded-circle" href="javascript:void(0);" onclick="productDitailsShow('{{ $value->id }}');" id="productShow_{{ $value->id }}">
                                                    +
                                                </a>
                                                <a class="btn btn-sm btn-icon btn-info-light rounded-circle" href="javascript:void(0);" onclick="productDitailsHide('{{ $value->id }}');" style="display:none;" id="productHide_{{ $value->id }}">
                                                    -
                                                </a>
                                                {{ $i }}
                                            </td>
                                            <td data-label="Party Name">{{ $value->party_name }}</td>
                                            <td data-label="Person Name">{{ $value->person_name }}</td>
                                            <td data-label="City">{{ $value->city }}</td>
                                            <td data-label="Mobile No">{{ $value->mobile_no }}</td>
                                            <td data-label="AMC Type">{{ $value->amc_type }}</td>
                                            <td data-label="AMC Start Date">{{ $value->start_date }}</td>
                                            <td data-label="AMC End Date">{{ $value->end_date }}</td>
                                            <td data-label="Contract Amount">{{ $value->contract_amount }}</td>
                                            <td data-label="Taxt">{{ $value->tax }}</td>
                                            <td data-label="Action">
                                                @can('manage-amc-edit')
                                                    <a class="btn btn-sm btn-icon btn-info-light rounded-circle" href="{{Route('manage_amc.edit',$value->id)}}"> <i class="bi bi-pencil-square" aria-hidden="true"></i> </a>
                                                @endcan
                                                @can('manage-amc-delete')
                                                    <a class="btn btn-sm btn-icon btn-secondary-light rounded-circle" onclick="deleteFunction( '{{ $value->id }}')"> <i class="bi bi-trash" aria-hidden="true"></i> </a>
                                                @endcan
                                                <a class="btn btn-sm btn-icon btn-secondary-light rounded-circle" href="{{Route('manage_amc.show',$value->id)}}"> <i class="bi bi-printer" aria-hidden="true"></i> </a>
                                            </td>
                                        </tr>
                                        <tr class="child_row_{{ $value->id }}" style="display: none">
                                            <th> </th>
                                            <th scope="col">Product Code</th>
                                            <th scope="col">Product Name</th>
                                            <th scope="col">Model</th>
                                            <th scope="col">Brand</th>
                                            <th scope="col">Qty</th>
                                            <th scope="col">Note</th>
                                        </tr>
                                        @php
                                            $product = getAmcProductDetails($value->id);
                                        @endphp
                                        @if(isset($product) && $product)
                                            @foreach ($product as $data)
                                                <tr class="child_row_{{ $value->id }}" style="display: none">
                                                    <td></td>
                                                    <td data-label="Product Code">{{ $data->product_code }}</td>
                                                    <td data-label="Product Name">{{ $data->product_name }}</td>
                                                    <td data-label="Model">{{ $data->model }}</td>
                                                    <td data-label="Brand">{{ $data->brand }}</td>
                                                    <td data-label="Qty">{{ $data->qty }}</td>
                                                    <td data-label="Note">{{ $data->note }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
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
        $('#deleteForm').attr('action','{{ url("manage_amc") }}'+ '/'+id);
        $('#deleteModal').modal('show');
    }
</script>
@endsection
