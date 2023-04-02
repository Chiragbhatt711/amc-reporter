@extends('layouts.adminapp')
@section('content')
<div class="container">
@if ($message = Session::get('success'))
    <div class="alert alert_msg">
        <p>{{ $message }}</p>
    </div>
@endif
<div class="title">
    <h3>Complaint Summary</h3>
</div>
{!! Form::open(array('route' => 'complaint_summary','method'=>'GET')) !!}
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
    <thead  class="">
        <tr>
          <th scope="col">No</th>
          <th scope="col">Complaint Title</th>
          <th scope="col">No of Times</th>
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
                    <td data-lael="No">{{ $i }}</td>
                    <td data-lael="Complaint Title">{{ $value->complait_title }}</td>
                    <td data-lael="No Of Times">{{ $value->total }}</td>
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
