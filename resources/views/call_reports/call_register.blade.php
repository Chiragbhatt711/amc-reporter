@extends('layouts.adminapp')
@section('content')
<div class="container">
@if ($message = Session::get('success'))
    <div class="alert alert_msg">
        <p>{{ $message }}</p>
    </div>
@endif
<div class="title">
    <h3>Call Register</h3>
</div>
{!! Form::open(array('route' => 'call_register','method'=>'GET')) !!}
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
<table class="table dynamic-data-table">
    <thead  class="">
        <tr>
          <th scope="col">No</th>
          <th scope="col">Call No</th>
          <th scope="col">Call Date/Time</th>
          <th scope="col">Call Type</th>
          <th scope="col">Complaint By</th>
          <th scope="col">Comp.by Contact No</th>
          <th scope="col">Complaint</th>
          <th scope="col">Priority</th>
          <th scope="col">Status</th>
          <th scope="col">AMC No</th>
          <th scope="col">AMC Type</th>
          <th scope="col">Start Date</th>
          <th scope="col">End Date</th>
          <th scope="col">Party Name</th>
          <th scope="col">City</th>
          <th scope="col">Mobile No</th>
          <th scope="col">Handover</th>
          <th scope="col">Handover Date/Time</th>
          <th scope="col">Completed By</th>
          <th scope="col">Date/Time</th>
          <th scope="col">Description</th>
          <th scope="col">Remark</th>
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
                    <td data-label="Call No">{{ $value->id }}</td>
                    <td data-label="Call Date/Time">{{ \Carbon\Carbon::parse($value->service_date)->format('Y-m-d') }}</td>
                    <td data-label="">{{ $value->is_free == 1 ? 'Free' : 'Complaint' }}</td>
                    <td data-label="Complaint By">{{ $value->complait_by }}</td>
                    <td data-label="Comp.by Contact No">{{ $value->mobile }}</td>
                    <td data-label="Complaint">{{ $value->complait_title }}</td>
                    <td data-label="Priority">{{ $value->priority }}</td>
                    <td data-label="Status">
                        @if($value->status)
                            {{ $value->status }}
                        @elseif ($value->handover)
                            Under Process
                        @else
                            Pending
                        @endif
                    </td>
                    <td data-label="AMC No">{{ $value->amc_no }}</td>
                    <td data-label="AMC Type">{{ $value->amc_type }}</td>
                    <td data-label="Start Date">{{ $value->start_date }}</td>
                    <td data-label="End Date">{{ $value->end_date }}</td>
                    <td data-label="Party Name">{{ $value->party_name }}</td>
                    <td data-label="City">{{ $value->city }}</td>
                    <td data-label="Mobile No">{{ $value->mobile_no }}</td>
                    <td data-label="Handover">{{ $value->handover }}</td>
                    <td data-label="Handover Date">{{ $value->handover_date.' '.$value->handover_time }}</td>
                    <td data-label="Completed By">{{ $value->complait_by }}</td>
                    <td data-label="Date/Time">{{ $value->update_date }}</td>
                    <td data-label="Description">{{ $value->description }}</td>
                    <td data-label="Remark">{{ $value->call_remark }}</td>
                </tr>
            @endforeach
        @endif
      </tbody>
  </table>

@endsection

@section('js-script')
<script>

</script>
@endsection
