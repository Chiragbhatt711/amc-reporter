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
    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-3">
        <div class="form-group">
            <strong class="lab_space">Start Date</strong>
            {!! Form::text('start_date', $startDate, array('placeholder' => 'Start Date' ,'class' => 'form-control datepicker')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-3">
        <div class="form-group">
            <strong class="lab_space">End Date</strong>
            {!! Form::text('end_date', $endDate, array('placeholder' => 'End Date' ,'class' => 'form-control datepicker')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 mt-4">
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
                    <td>{{ $i }}</td>
                    <td>{{ $value->party_name }}</td>
                    <td>{{ $value->person_name }}</td>
                    <td>{{ $value->city }}</td>
                    <td>{{ $value->mobile_no }}</td>
                    <td>{{ $value->id }}</td>
                    <td>{{ $value->amc_type }}</td>
                    <td>{{ $value->start_date }}</td>
                    <td>{{ $value->end_date }}</td>
                    <td>
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
