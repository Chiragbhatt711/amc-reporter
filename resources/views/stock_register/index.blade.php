@extends('layouts.adminapp')
@section('content')
<!-- PAGE-HEADER -->
<div class="page-header d-flex align-items-center justify-content-between border-bottom mb-4">
    <h1 class="page-title">Stock Register</h1>
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
                    </div>
                </div>
                <div class="card-body">
                    <div id="grid-pagination">
                        <div role="complementary" class="gridjs gridjs-container" style="width: 100%;">
                            <div class="gridjs-wrapper" style="height: auto;">
                                <table role="grid" class="gridjs-table" style="height: auto;">
                                    <thead  class="gridjs-thead">
                                        <tr>
                                            <th class="gridjs-th" data-column-id="Group Name">Group Name</th>
                                            <th class="gridjs-th" data-column-id="Brand">Brand</th>
                                            <th class="gridjs-th" data-column-id="Model">Model</th>
                                            <th class="gridjs-th" data-column-id="Product Code">Product Code</th>
                                            <th class="gridjs-th" data-column-id="Product Name">Product Name</th>
                                            <th class="gridjs-th" data-column-id="Opening Stock">Opening Stock</th>
                                            <th class="gridjs-th" data-column-id="Inward Qty">Inward Qty</th>
                                            <th class="gridjs-th" data-column-id="Outward Qty">Outward Qty</th>
                                            <th class="gridjs-th" data-column-id="Balance Qty">Balance Qty</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($mainData) && $mainData)
                                            @php
                                                $i = 0;
                                            @endphp
                                            @foreach ($mainData as $value)
                                                @php
                                                    $i++;
                                                @endphp
                                                <tr>
                                                    <td class="gridjs-td" data-column-id="Group Name">{{ $value->group }}</td>
                                                    <td class="gridjs-td" data-column-id="Brand">{{ $value->brand }}</td>
                                                    <td class="gridjs-td" data-column-id="Model">{{ $value->model }}</td>
                                                    <td class="gridjs-td" data-column-id="Product Code">{{ $value->product_code }}</td>
                                                    <td class="gridjs-td" data-column-id="Product Name">{{ $value->product_name }}</td>
                                                    <td class="gridjs-td" data-column-id="Opening Stock">{{ $value->opening_qty }}</td>
                                                    <td class="gridjs-td" data-column-id="Inward Qty">{{ $value->inward_qty }}</td>
                                                    <td class="gridjs-td" data-column-id="Outward Qty">{{ $value->outward_qty }}</td>
                                                    <td class="gridjs-td" data-column-id="Balance Qty">{{ $value->inward_qty - $value->outward_qty }}</td>
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
<!-- CONTAINER CLOSED -->
@endsection
