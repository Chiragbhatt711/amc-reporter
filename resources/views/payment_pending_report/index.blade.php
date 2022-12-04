@extends('layouts.adminapp')
@section('content')
<div class="container">
    @if ($message = Session::get('success'))
        <div class="alert alert_msg">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="title">
        <h3>Payment Pending Report</h3>
        <!-- <div class="pull-right"> -->
            {{-- <a class="btn add_btn" href="{{ route('manage_tax.create') }}">
                <i class="fa fa-plus" aria-hidden="true"></i>
            </a> --}}
        <!-- </div> -->
    </div>
    <table class="table  dynamic-data-table">
        <thead  class="">
            <tr>
            <th scope="col">No</th>
            <th scope="col">Party Name</th>
            <th scope="col">Contract Person Name</th>
            <th scope="col">City</th>
            <th scope="col">Mobile No</th>
            <th scope="col">AMC No</th>
            <th scope="col">AMC Type</th>
            <th scope="col">Start Date</th>
            <th scope="col">End Date</th>
            <th scope="col">Pending Amount</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($report) && $report)
                @php
                    $i = 0;
                @endphp
                @foreach ($report as $value)
                    @if($value->pending_amount != 0)
                        @php
                            $i++;
                        @endphp
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $value->party_name }}</td>
                            <td>{{ $value->contact_person_name }}</td>
                            <td>{{ $value->city }}</td>
                            <td>{{ $value->mobile_no }}</td>
                            <td>{{ $value->amc_no }}</td>
                            <td>{{ $value->amc_type }}</td>
                            <td>{{ $value->start_date }}</td>
                            <td>{{ $value->end_date }}</td>
                            <td>{{ $value->pending_amount }}</td>
                        </tr>
                    @endif
                @endforeach
            @endif
        </tbody>
    </table>
@endsection
