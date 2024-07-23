@extends('layouts.adminapp')
@section('content')
<!-- PAGE-HEADER -->
<div class="page-header d-flex align-items-center justify-content-between border-bottom mb-4">
    <h1 class="page-title">Stock Dashboard</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Stock Dashboard</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->

<!-- CONTAINER -->
<div class="main-container container-fluid">

    <div class="row">
        <div class="tab-menu-heading tab-menu-heading-boxed">
            <div class="tabs-menu-boxed">
                <!-- Tabs -->
                <ul class="nav panel-tabs d-flex flex-wrap">
                    <li>
                        <a href="{{ route('home') }}" class="d-flex align-items-center">
                            <span class="badge bg-primary-transparent rounded-circle fs-10 me-2">1</span>AMC Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('call_dashboard') }}" class="d-flex align-items-center">
                            <span class="badge bg-secondary-transparent rounded-circle fs-10 me-2">2</span>Call Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('stock_dashboard') }}" class="d-flex align-items-center active">
                            <span class="badge bg-secondary-transparent rounded-circle fs-10 me-2">3</span>Stock Dashboard
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Start:: row-2 -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">
                        Stock Summary
                    </div>
                </div>
                <div class="card-body">
                    <div id="grid-pagination">
                        <table class="table table-bordered dynamic-data-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Product Code</th>
                                    <th>Product Name</th>
                                    <th>Minimum Qty</th>
                                    <th>Stock Qty</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($stockSummary) && $stockSummary)
                                    @php $i=0; @endphp
                                    @foreach ($stockSummary as $value)
                                        @php $i++; @endphp
                                        <tr>
                                            <td data-label="No">{{ $i }}</td>
                                            <td data-label="Product Code">{{ $value->product_code }}</td>
                                            <td data-label="Product Name">{{ $value->product_name }}</td>
                                            <td data-label="Minimum Qty">{{ $value->min_qty }}</td>
                                            <td data-label="Stock Qty">{{ ($value->opening_qty + $value->inward_qty) - $value->outward_qty }}</td>
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
    <!-- End:: row-2 -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">
                        Most Outward Product
                    </div>
                </div>
                <div class="col-lg-12 col-xs-12 mt-1">
                    {!! Form::open(array('route' => 'stock_dashboard','method'=>'GET')) !!}
                        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-3">
                            <div class="form-group">
                                <strong class="lab_space">Days</strong>
                                {!! Form::text('day', $day, array('placeholder' => 'Days' ,'class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 mt-4">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    {!! Form::close() !!}
                </div>
                <div class="card-body">
                    <div id="grid-pagination">
                        <table class = "table table-bordered dynamic-data-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Product Code</th>
                                    <th>Product Name</th>
                                    <th>Outward Qty</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($OutWard) && $OutWard)
                                    @php $i=0; @endphp
                                    @foreach ($OutWard as $value)
                                        @php $i++; @endphp
                                        <tr>
                                            <td data-label="No">{{ $i }}</td>
                                            <td data-label="Product Code">{{ $value->product_code }}</td>
                                            <td data-label="Product Name">{{ $value->product_name }}</td>
                                            <td data-label="Outward Qty">{{ $value->outward_qty }}</td>
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
<!-- CONTAINER CLOSED -->
@endsection
