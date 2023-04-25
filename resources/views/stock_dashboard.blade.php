@extends('layouts.adminapp')
@section('content')
<div class="dashboard">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-xs-12">
                <a href="{{ route('home') }}" class="homeBtn btn">AMC Dashboard</a>
            </div>
            <div class="col-lg-2 col-xs-12">
                <a href="{{ route('call_dashboard') }}" class="homeBtn btn">Call Dashboard</a>
            </div>
            <div class="col-lg-2 col-xs-12">
                <a href="{{ route('stock_dashboard') }}" class="btn homeBtn active">Stock Dashboard</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <div class="dash_table">
                    <h2>Stock Dashboard</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <h2 class="sub-header">Stock Summary</h2>
            </div>
            <div class="col-lg-12 col-xs-12">
                <div class="table-responsive">
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
                                        <td data-label="Stock Qty">{{ $value->inward_qty - $value->outward_qty }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-lg-12 col-xs-12">
                <h2 class="sub-header">Most Outward Product</h2>
            </div>
            <div class="row mt-1">
                {!! Form::open(array('route' => 'stock_dashboard','method'=>'GET')) !!}
                    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-3">
                        <div class="form-group">
                            <strong class="lab_space">Days</strong>
                            {!! Form::text('day', $day, array('placeholder' => 'Days' ,'class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 mt-4">
                        <button type="submit" class="btn btn_tile">Search</button>
                    </div>
                {!! Form::close() !!}
            </div>
            <div class="col-lg-12 col-xs-12">
                <div class="table-responsive">
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
@endsection
