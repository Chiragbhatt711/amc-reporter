@extends('layouts.adminapp')
@section('content')
<!-- PAGE-HEADER -->
<div class="page-header d-flex align-items-center justify-content-between border-bottom mb-4">
    <h1 class="page-title">Party ledger summary</h1>
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
                    {!! Form::open(array('route' => 'party_ledger_summary','method'=>'GET')) !!}
                        <div class="row mt-1">
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <strong class="lab_space">Start Date</strong>
                                    {!! Form::text('start_date', $startDate, array('placeholder' => 'Start Date' ,'class' => 'form-control datepicker')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <strong class="lab_space">End Date</strong>
                                    {!! Form::text('end_date', $endDate, array('placeholder' => 'End Date' ,'class' => 'form-control datepicker')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3 mt-2">
                                <button type="submit" class="btn btn-primary btn-block float-end my-2">Search</button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
                <div class="card-body">
                    <div id="grid-pagination">
                        <table class="table  table-bordered dynamic-data-table">
                            <thead  class="">
                                <tr>
                                  <th scope="col">No</th>
                                  <th scope="col">Party Name</th>
                                  <th scope="col">Contact Person Name</th>
                                  <th scope="col">City</th>
                                  <th scope="col">AMC No</th>
                                  <th scope="col">Opening Balance</th>
                                  <th scope="col">Debit</th>
                                  <th scope="col">Credit</th>
                                  <th scope="col">Balance</th>
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
                                            <td data-label="No">{{ $i }}</td>
                                            <td data-label="Party Name">{{ $value->party_name }}</td>
                                            <td data-label="Contact Person Name">{{ $value->contact_person_name }}</td>
                                            <td data-label="City">{{ $value->city }}</td>
                                            <td data-label="AMC No">{{ $value->id }}</td>
                                            <td data-label="Opening Balance">{{ $value->opening_balance }}</td>
                                            <td data-label="Debit">{{ $value->total_amount }}</td>
                                            <td data-label="Credit">{{ $value->amount_recieve }}</td>
                                            <td data-label="Balance">{{ $value->total_amount - $value->amount_recieve  }}</td>
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
