@extends('layouts.adminapp')
@section('content')
<div class="container">
    @if ($message = Session::get('success'))
        <div class="alert alert_msg">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="title">
        <h3>Service Tax Report</h3>
    </div>
    {!! Form::open(array('route' => 'service_tax_report.index','method'=>'GET')) !!}
    <div class="row mt-1">
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div class="form-group">
                <strong class="lab_space">Start Date</strong>
                {!! Form::text('start_date', $startDate, array('placeholder' => 'Start Date' ,'class' => 'form-control datepicker')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div class="form-group">
                <strong class="lab_space">End Date</strong>
                {!! Form::text('end_date', $endDate, array('placeholder' => 'End Date' ,'class' => 'form-control datepicker')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 mt-4">
            <button type="submit" class="btn btn_tile">Search</button>
        </div>
        {!! Form::close() !!}
    </div>
    <table class="table table-bordered dynamic-data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Party Name</th>
                <th>Contract Person Name</th>
                <th>City</th>
                <th>AMC NO</th>
                <th>AMC Type</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Basic Amount</th>
                <th>Tax (%)</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($data) && $data)
                @php
                    $i = 0;
                @endphp
                @foreach ($data as $value)
                    @php $i++;  @endphp
                    <tr>
                        <td data-label="No">{{ $i }}</td>
                        <td data-label="Party Name">{{ $value->party_name }}</td>
                        <td data-label="Contract Person Name">{{ $value->contact_person }}</td>
                        <td data-label="City">{{ $value->city }}</td>
                        <td data-label="AMC No">{{ $value->id }}</td>
                        <td data-label="AMC Type">{{ $value->amc_type }}</td>
                        <td data-label="Start Date">{{ $value->start_date }}</td>
                        <td data-label="End Date">{{ $value->end_date }}</td>
                        <td data-label="Basic Amount">{{ $value->basic_amount }}</td>
                        <td data-label="Tax(%)">{{ $value->tax }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
@endsection
