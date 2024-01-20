@extends('layouts.adminapp')
@section('content')
<!-- PAGE-HEADER -->
<div class="page-header d-flex align-items-center justify-content-between border-bottom mb-4">
    <h1 class="page-title">Manage Inward</h1>
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
                        @can('manage-inward-create')
                            <a class="btn btn-primary" href="{{ route('manage_inward.create') }}">
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
                                            <th class="gridjs-th" data-column-id="Inward Date">Inward Date</th>
                                            <th class="gridjs-th" data-column-id="Reference Bill No">Reference Bill No</th>
                                            <th class="gridjs-th" data-column-id="Supplier Type">Supplier Type</th>
                                            <th class="gridjs-th" data-column-id="Company Name">Company Name</th>
                                            <th class="gridjs-th" data-column-id="Person Name">Person Name</th>
                                            <th class="gridjs-th" data-column-id="City">City</th>
                                            <th class="gridjs-th" data-column-id="Total Item">Total Item</th>
                                            <th class="gridjs-th" data-column-id="Total Qty">Total Qty</th>
                                            <th class="gridjs-th" data-column-id="Total Amount">Total Amount</th>
                                            <th class="gridjs-th" data-column-id="Note">Note</th>
                                            <th class="gridjs-th" data-column-id="Action">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($inward) && $inward)
                                            @php
                                                $i = 0;
                                            @endphp
                                            @foreach ($inward as $value)
                                                @php
                                                    $i++;
                                                @endphp
                                                <tr>
                                                    <td class="gridjs-td" data-column-id="Inward Date">
                                                        <a href="javascript:void(0);" onclick="productShow('{{ $value->id }}');" id="productShow_{{ $value->id }}">
                                                            <span class="btn btn-sm btn-icon btn-info-light rounded-circle">+</span>
                                                        </a>
                                                        <a href="javascript:void(0);" onclick="productHide('{{ $value->id }}');" style="display:none;" id="productHide_{{ $value->id }}">
                                                            <span class="btn btn-sm btn-icon btn-info-light rounded-circle">-</span>
                                                        </a>
                                                        {{ $value->inward_date }}
                                                    </td>
                                                    <td class="gridjs-td" data-column-id="Reference Bill No">{{ $value->id }}</td>
                                                    <td class="gridjs-td" data-column-id="Supplier Type">{{ $value->supplier_type }}</td>
                                                    <td class="gridjs-td" data-column-id="Company Name">{{ $value->company_name }}</td>
                                                    <td class="gridjs-td" data-column-id="Person Name">{{ $value->person_name }}</td>
                                                    <td class="gridjs-td" data-column-id="City">{{ $value->city }}</td>
                                                    <td class="gridjs-td" data-column-id="Total Item">{{ $value->total_product }}</td>
                                                    <td class="gridjs-td" data-column-id="Total Qty">{{ $value->total_qty }}</td>
                                                    <td class="gridjs-td" data-column-id="Total Amount">{{ $value->total_amount }}</td>
                                                    <td class="gridjs-td" data-column-id="Note">{{ $value->note }}</td>
                                                    <td class="gridjs-td" data-column-id="Action">
                                                        @can('manage-inward-edit')
                                                            <a class="btn btn-sm btn-icon btn-info-light rounded-circle" href="{{Route('manage_inward.edit',$value->id)}}"> <i class="fa fa-pencil" aria-hidden="true"></i> </a>
                                                        @endcan
                                                        @can('manage-inward-delete')
                                                            <a class="btn btn-sm btn-icon btn-secondary-light rounded-circle" onclick="deleteFunction( '{{ $value->id }}')"> <i class="fa fa-trash" aria-hidden="true"></i> </a>
                                                        @endcan
                                                    </td>
                                                </tr>
                                                <tr class="child_row_{{ $value->id }}" style="display: none">
                                                    <th> </th>
                                                    <th class="gridjs-th" data-column-id="Product">Product</th>
                                                    <th class="gridjs-th" data-column-id="Purchase Rate">Purchase Rate</th>
                                                    <th class="gridjs-th" data-column-id="Sale Rate">Sale Rate</th>
                                                    <th class="gridjs-th" data-column-id="Qty">Qty</th>
                                                    <th class="gridjs-th" data-column-id="Amount">Amount</th>
                                                </tr>
                                                @php
                                                    $product = getInwardProductDetails($value->id);
                                                @endphp
                                                @if(isset($product) && $product)
                                                    @foreach ($product as $data)
                                                        <tr class="child_row_{{ $value->id }}" style="display: none">
                                                            <td class="gridjs-td" data-column-id=""></td>
                                                            <td class="gridjs-td" data-column-id="Product">{{ $data->product_name }}</td>
                                                            <td class="gridjs-td" data-column-id="Purchase Rate">{{ $data->rate }}</td>
                                                            <td class="gridjs-td" data-column-id="Sale Rate"></td>
                                                            <td class="gridjs-td" data-column-id="Qty">{{ $data->qty }}</td>
                                                            <td class="gridjs-td" data-column-id="Amount">{{ $data->amount }}</td>
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
        $('#deleteForm').attr('action','{{ url("manage_inward") }}'+ '/'+id);
        $('#deleteModal').modal('show');
    }
    function productShow(id)
    {
        $("#productShow_"+id).hide();
        $('#productHide_'+id).show();
        $('.child_row_'+id).show();
    }
    function productHide(id)
    {
        $('#productShow_'+id).show();
        $('#productHide_'+id).hide();
        $('.child_row_'+id).hide();
    }
</script>
@endsection
