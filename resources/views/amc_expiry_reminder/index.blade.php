@extends('layouts.adminapp')
@section('content')
<div class="container">
@if ($message = Session::get('success'))
    <div class="alert alert_msg">
        <p>{{ $message }}</p>
    </div>
@endif
<div class="title">
    <h3>AMC Expiry Reminder Report</h3>
</div>
{!! Form::open(array('route' => 'amc_expiry_reminder','method'=>'GET')) !!}
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
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3 mt-4">
        <button type="submit" class="btn btn_tile">Search</button>
    </div>
    {!! Form::close() !!}
</div>
<table class="table table-bordered dynamic-data-table">
    <thead  class="">
        <tr>
          <th scope="col">No</th>
          <th scope="col">Party Name</th>
          <th scope="col">Contact Person Name</th>
          <th scope="col">City</th>
          <th scope="col">Mobile No</th>
          <th scope="col">AMC No</th>
          <th scope="col">AMC Type</th>
          <th scope="col">Start Date</th>
          <th scope="col">End Date</th>
          <th scope="col">Action</th>
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
                    <td data-label="Contact Person Name">{{ $value->person_name }}</td>
                    <td data-label="City">{{ $value->city }}</td>
                    <td data-label="Mobile No">{{ $value->mobile_no }}</td>
                    <td data-label="AMC No">{{ $value->id }}</td>
                    <td data-label="AMC Type">{{ $value->amc_type }}</td>
                    <td data-label="Start Date">{{ $value->start_date }}</td>
                    <td data-label="End Date">{{ $value->end_date }}</td>
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

@endsection

@section('js-script')
<script>

</script>
@endsection
