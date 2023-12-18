@extends('layouts.adminapp')
@section('content')
<!-- PAGE-HEADER -->
<div class="page-header d-flex align-items-center justify-content-between border-bottom mb-4">
    <h1 class="page-title">Manage Tax</h1>
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
                        @can('manage-tax-create')
                            <a class="btn btn-primary btn-block float-end my-2" href="{{ route('manage_tax.create') }}">
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
                                <th scope="col">Tax Profile Name</th>
                                <th scope="col">Tax Lable Name</th>
                                <th scope="col">Tax Caption 1</th>
                                <th scope="col">Tax 1(%)</th>
                                <th scope="col">Tax Caption 2</th>
                                <th scope="col">Tax 2(%)</th>
                                <th scope="col">Tax Caption 3</th>
                                <th scope="col">Tax 3(%)</th>
                                <th scope="col">Tax Caption 4</th>
                                <th scope="col">Tax 4(%)</th>
                                <th scope="col">Tax Caption 5</th>
                                <th scope="col">Tax 5(%)</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($tax) && $tax)
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach ($tax as $value)
                                        @php
                                            $i++;
                                        @endphp
                                        <tr>
                                            <td data-label="Tax Profile Name">{{ $value->profile_name }}</td>
                                            <td data-label="Tax Lable Name">{{ $value->tax_lable_name }}</td>
                                            <td data-label="Tax Caption 1">{{ $value->tax_caption_1 }}</td>
                                            <td data-label="Tax 1(%)">{{ $value->tax_percentage_1 }}</td>
                                            <td data-label="Tax Caption 2">{{ $value->tax_caption_2 }}</td>
                                            <td data-label="Tax 2(%)">{{ $value->tax_percentage_2 }}</td>
                                            <td data-label="Tax Caption 3">{{ $value->tax_caption_3 }}</td>
                                            <td data-label="Tax 3(%)">{{ $value->tax_percentage_3 }}</td>
                                            <td data-label="Tax Caption 4">{{ $value->tax_caption_4 }}</td>
                                            <td data-label="Tax 4(%)">{{ $value->tax_percentage_4 }}</td>
                                            <td data-label="Tax Caption 5">{{ $value->tax_caption_5 }}</td>
                                            <td data-label="Tax 5(%)">{{ $value->tax_percentage_5 }}</td>
                                            <td data-label="Action">
                                                @can('manage-tax-edit')
                                                    <a class="btn btn-sm btn-icon btn-info-light rounded-circle" href="{{Route('manage_tax.edit',$value->id)}}"> <i class="bi bi-pencil-square" aria-hidden="true"></i> </a>
                                                @endcan
                                                @can('manage-tax-delete')
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
        $('#deleteForm').attr('action','{{ url("manage_tax") }}'+ '/'+id);
        $('#deleteModal').modal('show');
    }
</script>
@endsection
