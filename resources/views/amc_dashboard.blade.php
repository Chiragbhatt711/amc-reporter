@extends('layouts.adminapp')
@section('content')
<div class="dashboard">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-xs-12">
                <a href="{{ route('home') }}" class="homeBtn btn active">AMC Dashboard</a>
            </div>
            <div class="col-lg-2 col-xs-12">
                <a href="{{ route('call_dashboard') }}" class="homeBtn btn">Call Dashboard</a>
            </div>
            <div class="col-lg-2 col-xs-12">
                <a href="{{ route('stock_dashboard') }}" class="btn homeBtn">Stock Dashboard</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <div class="dash_table">
                    <h2>AMC Dashboard</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <h2 class="sub-header">AMC Ticker</h2>
            </div>
            <div class="row mt-1">
                {!! Form::open(array('route' => 'home','method'=>'GET')) !!}
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
                    <table class="table table-bordered dynamic-data-table">
                        <thead>
                            <tr>
                                <th>AMC No</th>
                                <th>Company</th>
                                <th>Person Name</th>
                                <th>End Date</th>
                                <th>Remain Days</th>
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
                <h2 class="sub-header">Payment Ticker</h2>
            </div>
            <div class="row mt-1">
                {!! Form::open(array('route' => 'home','method'=>'GET')) !!}
                    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-3">
                        <div class="form-group">
                            <strong class="lab_space">Days</strong>
                            {!! Form::text('payment_day', $paymentDay, array('placeholder' => 'Days' ,'class' => 'form-control')) !!}
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
                                <th>AMC No</th>
                                <th>Company</th>
                                <th>Person Name</th>
                                <th>Due Date</th>
                                <th>Due Amount</th>
                                <th>Remain Days</th>
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
