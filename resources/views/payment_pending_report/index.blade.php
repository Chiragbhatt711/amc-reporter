@extends('layouts.adminapp')
@section('content')
<!-- PAGE-HEADER -->
<div class="page-header d-flex align-items-center justify-content-between border-bottom mb-4">
    <h1 class="page-title">Payment Pending Report</h1>
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
                        <table class="table table-bordered dynamic-data-table">
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
                                                <td data-label="No">{{ $i }}</td>
                                                <td data-label="Party Name">{{ $value->party_name }}</td>
                                                <td data-label="Contact Person">{{ $value->contact_person_name }}</td>
                                                <td data-label="City">{{ $value->city }}</td>
                                                <td data-label="Mobile No">{{ $value->mobile_no }}</td>
                                                <td data-label="AMC No">{{ $value->amc_no }}</td>
                                                <td data-label="AMC Type">{{ $value->amc_type }}</td>
                                                <td data-label="Start Date">{{ $value->start_date }}</td>
                                                <td data-label="End Date">{{ $value->end_date }}</td>
                                                <td data-label="Pending Amount">{{ $value->pending_amount }}</td>
                                            </tr>
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
<!-- CONTAINER CLOSED -->
@endsection
