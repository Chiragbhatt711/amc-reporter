@extends('layouts.adminapp')
@section('content')
<!-- PAGE-HEADER -->
<div class="page-header d-flex align-items-center justify-content-between border-bottom mb-4">
    <h1 class="page-title">Service Tax Report</h1>
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
                    {!! Form::open(array('route' => 'service_tax_report.index','method'=>'GET')) !!}
                        <div class="row mt-1">
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <strong class="lab_space">Start Date</strong>
                                    {!! Form::date('start_date', $startDate, array('placeholder' => 'Start Date' ,'class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <strong class="lab_space">End Date</strong>
                                    {!! Form::date('end_date', $endDate, array('placeholder' => 'End Date' ,'class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 mt-3">
                                <button type="submit" class="btn btn-primary btn-block float-end my-2">Search</button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
                <div class="card-body">
                    <div id="grid-pagination">
                        <div role="complementary" class="gridjs gridjs-container" style="width: 100%;">
                            <div class="gridjs-wrapper" style="height: auto;">
                                <table role="grid" class="gridjs-table" style="height: auto;">
                                    <thead  class="gridjs-thead">
                                        <tr>
                                            <th class="gridjs-th" data-column-id="No">No</th>
                                            <th class="gridjs-th" data-column-id="Party Name">Party Name</th>
                                            <th class="gridjs-th" data-column-id="Contract Person Name">Contract Person Name</th>
                                            <th class="gridjs-th" data-column-id="City">City</th>
                                            <th class="gridjs-th" data-column-id="AMC NO">AMC NO</th>
                                            <th class="gridjs-th" data-column-id="AMC Type">AMC Type</th>
                                            <th class="gridjs-th" data-column-id="Start Date">Start Date</th>
                                            <th class="gridjs-th" data-column-id="End Date">End Date</th>
                                            <th class="gridjs-th" data-column-id="Basic Amount">Basic Amount</th>
                                            <th class="gridjs-th" data-column-id="Tax (%)">Tax (%)</th>
                                            <th class="gridjs-th" data-column-id="Tax Amount">Tax Amount</th>
                                            <th class="gridjs-th" data-column-id="Total Amount">Total Amount</th>
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
                                                    <td class="gridjs-td" data-column-id="No">{{ $i }}</td>
                                                    <td class="gridjs-td" data-column-id="Party Name">{{ $value->party_name }}</td>
                                                    <td class="gridjs-td" data-column-id="Contract Person Name">{{ $value->contact_person }}</td>
                                                    <td class="gridjs-td" data-column-id="City">{{ $value->city }}</td>
                                                    <td class="gridjs-td" data-column-id="AMC No">{{ $value->amc_no }}</td>
                                                    <td class="gridjs-td" data-column-id="AMC Type">{{ $value->amc_type }}</td>
                                                    <td class="gridjs-td" data-column-id="Start Date">{{ $value->start_date }}</td>
                                                    <td class="gridjs-td" data-column-id="End Date">{{ $value->end_date }}</td>
                                                    <td class="gridjs-td" data-column-id="Basic Amount">{{ $value->basic_amount }}</td>
                                                    <td class="gridjs-td" data-column-id="Tax(%)">{{ $value->tax }}</td>
                                                    <td class="gridjs-td" data-column-id="Tax Amount">{{ $value->total_amount - $value->basic_amount }}</td>
                                                    <td class="gridjs-td" data-column-id="Total Amount">{{ $value->total_amount }}</td>
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
