@extends('layouts.adminapp')
@section('content')
<!-- PAGE-HEADER -->
<div class="page-header d-flex align-items-center justify-content-between border-bottom mb-4">
    <h1 class="page-title">AMC Dashboard</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">AMC Dashboard</li>
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
                        <a href="{{ route('home') }}" class="d-flex align-items-center active">
                            <span class="badge bg-primary-transparent rounded-circle fs-10 me-2">1</span>AMC Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('call_dashboard') }}" class="d-flex align-items-center">
                            <span class="badge bg-secondary-transparent rounded-circle fs-10 me-2">2</span>Call Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('stock_dashboard') }}" class="d-flex align-items-center">
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
                        AMC Ticker
                    </div>
                </div>
                <div class="col-lg-12 col-xs-12 mt-1">
                    {!! Form::open(array('route' => 'home','method'=>'GET')) !!}
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
                        <table class="table table-bordered dynamic-data-table">
                            <thead>
                                <tr>
                                    <th>AMC No</th>
                                    <th>Company</th>
                                    <th>Person Name</th>
                                    <th>End Date</th>
                                    <th>Remain Days</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($amcTicker) && $amcTicker)
                                    @foreach ($amcTicker as $value)
                                        @php
                                            $diff = strtotime($value->end_date) - strtotime(date('Y-m-d'));
                                            $remainDay = abs(round($diff / 86400));
                                            $bgcolor = "";
                                            if($remainDay <= 10)
                                            {
                                                $bgcolor = "red";
                                            }
                                        @endphp
                                        <tr style="background-color:{{ $bgcolor }}">
                                            {{-- class="col-lg-4 col-sm-12 col-md-4" --}}
                                            <td data-label="AMC No">{{ $value->id }}</td>
                                            <td data-label="Company">{{ $value->compny }}</td>
                                            <td data-label="Person Name">{{ $value->person_name }}</td>
                                            <td data-label="End Date">{{ $value->end_date }}</td>
                                            <td data-label="Remain Days">{{ $remainDay }}</td>
                                            <td data-label="Action">
                                                @can('contract-type-edit')
                                                    <a href="{{Route('amc_renew',$value->id)}}"> <i class="fas fa-sync"></i> </a>
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
    <!-- End:: row-2 -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">
                        Payment Ticker
                    </div>
                </div>
                <div class="col-lg-12 col-xs-12 mt-1">
                    {!! Form::open(array('route' => 'home','method'=>'GET')) !!}
                        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-3">
                            <div class="form-group">
                                <strong class="lab_space">Days</strong>
                                {!! Form::text('payment_day', $paymentDay, array('placeholder' => 'Days' ,'class' => 'form-control')) !!}
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
                                    <th>AMC No</th>
                                    <th>Company</th>
                                    <th>Person Name</th>
                                    <th>Due Date</th>
                                    <th>Due Amount</th>
                                    <th>Remain Days</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($paymentTicker) && $paymentTicker)
                                    @foreach ($paymentTicker as $value)
                                        <tr>
                                            {{-- class="col-lg-4 col-sm-12 col-md-4" --}}
                                            <td data-label="AMC No">{{ $value->amc_no }}</td>
                                            <td data-label="Company">{{ $value->compny }}</td>
                                            <td data-label="Person Name">{{ $value->person_name }}</td>
                                            <td data-label="Due Date">{{ $value->due_date }}</td>
                                            <td data-label="AMC No">{{ (isset($value->totle_amount) && $value->totle_amount ? $value->totle_amount : 0) - (isset($value->paid_amount) && $value->paid_amount ? $value->paid_amount : 0) }}</td>
                                            <td data-label="Remain Days">
                                                @php
                                                    $diff = strtotime($value->due_date) - strtotime(date('Y-m-d'));
                                                    echo abs(round($diff / 86400));
                                                @endphp
                                            </td>
                                            <td data-label="Action">
                                                @can('manage-receipt-create')
                                                    <a href="{{Route('manage_receipt.create').'?id='.$value->amc_no}}"> <i class="fas fa-sync"></i> </a>
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
<!-- CONTAINER CLOSED -->
@endsection
