@extends('layouts.adminapp')
@section('content')
<!-- PAGE-HEADER -->
<div class="page-header d-flex align-items-center justify-content-between border-bottom mb-4">
    <h1 class="page-title">Call Register</h1>
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
    <div class="row mt-1">
        {!! Form::open(array('route' => 'call_register','method'=>'GET')) !!}
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
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
        {!! Form::close() !!}
    </div>
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
                                        <tr class="gridjs-tr">
                                          <th data-column-id="No" class="gridjs-th"><div class="gridjs-th-content">No</div></th>
                                          <th data-column-id="Call No" class="gridjs-th"><div class="gridjs-th-content">Call No</div></th>
                                          <th data-column-id="Call Date/Time" class="gridjs-th"><div class="gridjs-th-content">Call Date/Time</div></th>
                                          <th data-column-id="Call Type" class="gridjs-th"><div class="gridjs-th-content">Call Type</div></th>
                                          <th data-column-id="Complaint By" class="gridjs-th"><div class="gridjs-th-content">Complaint By</div></th>
                                          <th data-column-id="Comp.by Contact No" class="gridjs-th"><div class="gridjs-th-content">Comp.by Contact No</div></th>
                                          <th data-column-id="Complaint" class="gridjs-th"><div class="gridjs-th-content">Complaint</div></th>
                                          <th data-column-id="Priority" class="gridjs-th"><div class="gridjs-th-content">Priority</div></th>
                                          <th data-column-id="Status" class="gridjs-th"><div class="gridjs-th-content">Status</div></th>
                                          <th data-column-id="AMC No" class="gridjs-th"><div class="gridjs-th-content">AMC No</div></th>
                                          <th data-column-id="AMC Type" class="gridjs-th"><div class="gridjs-th-content">AMC Type</div></th>
                                          <th data-column-id="Start Date" class="gridjs-th"><div class="gridjs-th-content">Start Date</div></th>
                                          <th data-column-id="End Date" class="gridjs-th"><div class="gridjs-th-content">End Date</div></th>
                                          <th data-column-id="Party Name" class="gridjs-th"><div class="gridjs-th-content">Party Name</div></th>
                                          <th data-column-id="City" class="gridjs-th"><div class="gridjs-th-content">City</div></th>
                                          <th data-column-id="Mobile No" class="gridjs-th"><div class="gridjs-th-content">Mobile No</div></th>
                                          <th data-column-id="Handover" class="gridjs-th"><div class="gridjs-th-content">Handover</div></th>
                                          <th data-column-id="Handover Date/Time" class="gridjs-th"><div class="gridjs-th-content">Handover Date/Time</div></th>
                                          <th data-column-id="Completed By" class="gridjs-th"><div class="gridjs-th-content">Completed By</div></th>
                                          <th data-column-id="Date/Time" class="gridjs-th"><div class="gridjs-th-content">Date/Time</div></th>
                                          <th data-column-id="Description" class="gridjs-th"><div class="gridjs-th-content">Description</div></th>
                                          <th data-column-id="Remark" class="gridjs-th"><div class="gridjs-th-content">Remark</div></th>
                                        </tr>
                                    </thead>
                                    <tbody class="gridjs-tbody">
                                    @if(isset($data) && $data)
                                        @php
                                            $i = 0;
                                        @endphp
                                        @foreach ($data as $value)
                                            @php
                                                $i++;
                                            @endphp
                                            <tr class="gridjs-tr">
                                                <td class="gridjs-td" data-column-id="No">{{ $i }}</td>
                                                <td class="gridjs-td" data-column-id="Call No">{{ $value->id }}</td>
                                                <td class="gridjs-td" data-column-id="Call Date/Time">{{ \Carbon\Carbon::parse($value->service_date)->format('Y-m-d') }}</td>
                                                <td class="gridjs-td" data-column-id="">{{ $value->is_free == 1 ? 'Free' : 'Complaint' }}</td>
                                                <td class="gridjs-td" data-column-id="Complaint By">{{ $value->complait_by }}</td>
                                                <td class="gridjs-td" data-column-id="Comp.by Contact No">{{ $value->mobile }}</td>
                                                <td class="gridjs-td" data-column-id="Complaint">{{ $value->complait_title }}</td>
                                                <td class="gridjs-td" data-column-id="Priority">{{ $value->priority }}</td>
                                                <td class="gridjs-td" data-column-id="Status">
                                                    @if($value->status)
                                                        {{ $value->status }}
                                                    @elseif ($value->handover)
                                                        Under Process
                                                    @else
                                                        Pending
                                                    @endif
                                                </td>
                                                <td class="gridjs-td" data-column-id="AMC No">{{ $value->amc_no }}</td>
                                                <td class="gridjs-td" data-column-id="AMC Type">{{ $value->amc_type }}</td>
                                                <td class="gridjs-td" data-column-id="Start Date">{{ $value->start_date }}</td>
                                                <td class="gridjs-td" data-column-id="End Date">{{ $value->end_date }}</td>
                                                <td class="gridjs-td" data-column-id="Party Name">{{ $value->party_name }}</td>
                                                <td class="gridjs-td" data-column-id="City">{{ $value->city }}</td>
                                                <td class="gridjs-td" data-column-id="Mobile No">{{ $value->mobile_no }}</td>
                                                <td class="gridjs-td" data-column-id="Handover">{{ $value->handover }}</td>
                                                <td class="gridjs-td" data-column-id="Handover Date">{{ $value->handover_date.' '.$value->handover_time }}</td>
                                                <td class="gridjs-td" data-column-id="Completed By">{{ $value->complait_by }}</td>
                                                <td class="gridjs-td" data-column-id="Date/Time">{{ $value->update_date }}</td>
                                                <td class="gridjs-td" data-column-id="Description">{{ $value->description }}</td>
                                                <td class="gridjs-td" data-column-id="Remark">{{ $value->call_remark }}</td>
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

@section('js-script')
<script>

</script>
@endsection
