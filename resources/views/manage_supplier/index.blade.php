@extends('layouts.adminapp')
@section('content')
<!-- PAGE-HEADER -->
<div class="page-header d-flex align-items-center justify-content-between border-bottom mb-4">
    <h1 class="page-title">Manage Supplier</h1>
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
                        @can('manage-supplier-create')
                            <a class="btn btn-primary" href="{{ route('manage_supplier.create') }}">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div id="grid-pagination">
                        <div role="complementary" class="gridjs gridjs-container" style="width: 100%;">
                            <div class="gridjs-wrapper" style="height: auto;">
                                <table role="grid" class="gridjs-table" style="height: auto;">
                                    <thead  class="gridjs-thead">
                                        <tr>
                                        <th class="gridjs-th" data-column-id="Company Name">Company Name</th>
                                        <th class="gridjs-th" data-column-id="Person Name">Person Name</th>
                                        <th class="gridjs-th" data-column-id="Supplier Type">Supplier Type</th>
                                        <th class="gridjs-th" data-column-id="Address">Address</th>
                                        <th class="gridjs-th" data-column-id="City">City</th>
                                        <th class="gridjs-th" data-column-id="State">State</th>
                                        <th class="gridjs-th" data-column-id="Country">Country</th>
                                        <th class="gridjs-th" data-column-id="Pincode">Pincode</th>
                                        <th class="gridjs-th" data-column-id="Phone no">Phone no</th>
                                        <th class="gridjs-th" data-column-id="E-mail">E-mail</th>
                                        <th class="gridjs-th" data-column-id="Action">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($data) && $data)
                                            @php
                                                $i = 0;
                                            @endphp
                                            @foreach ($data as $value)
                                                @php
                                                    $i++;
                                                @endphp
                                                <tr>
                                                    <td class="gridjs-td" data-column-id="Company Name">{{ $value->company_name }}</td>
                                                    <td class="gridjs-td" data-column-id="Person Name">{{ $value->person_name }}</td>
                                                    <td class="gridjs-td" data-column-id="Supplier Type">{{ $value->supplier_type }}</td>
                                                    <td class="gridjs-td" data-column-id="Address">{{ $value->address }}</td>
                                                    <td class="gridjs-td" data-column-id="City">{{ $value->city }}</td>
                                                    <td class="gridjs-td" data-column-id="State">{{ $value->state }}</td>
                                                    <td class="gridjs-td" data-column-id="Country">{{ $value->country }}</td>
                                                    <td class="gridjs-td" data-column-id="Pincode">{{ $value->pincode }}</td>
                                                    <td class="gridjs-td" data-column-id="Phone No">{{ $value->phone_no }}</td>
                                                    <td class="gridjs-td" data-column-id="E-mail">{{ $value->e_mail }}</td>
                                                    <td class="gridjs-td" data-column-id="Action">
                                                        @can('manage-supplier-edit')
                                                            <a class="btn btn-sm btn-icon btn-info-light rounded-circle" href="{{Route('manage_supplier.edit',$value->id)}}"> <i class="fa fa-pencil" aria-hidden="true"></i> </a>
                                                        @endcan
                                                        @can('manage-supplier-delete')
                                                            <a class="btn btn-sm btn-icon btn-secondary-light rounded-circle" onclick="deleteFunction( '{{ $value->id }}')"> <i class="fa fa-trash" aria-hidden="true"></i> </a>
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
                <button type="button" class="btn btn_tile" data-bs-dismiss="modal">Cancel</button>
                {!! Form::open(['method' => 'DELETE','style'=>'display:inline','id'=>'deleteForm']) !!}
                    <input type="submit" class="btn btn-primary" value="Delete">
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<!-- CONTAINER CLOSED -->
@endsection

@section('js-script')
<script>
    function deleteFunction(id){
        $('#deleteForm').attr('action','{{ url("manage_supplier") }}'+ '/'+id);
        $('#deleteModal').modal('show');
    }
</script>
@endsection
