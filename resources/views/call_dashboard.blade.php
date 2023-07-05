@extends('layouts.adminapp')
@section('content')
<div class="dashboard">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <div class="button_Box">
                    <a href="{{ route('home') }}" class="homeBtn btn">AMC Dashboard</a>
                    <a href="{{ route('call_dashboard') }}" class="homeBtn btn active">Call Dashboard</a>
                    <a href="{{ route('stock_dashboard') }}" class="btn homeBtn">Stock Dashboard</a>
                </div>
            </div>
            <div class="col-lg-4 col-xs-12">
            </div>
            <div class="col-lg-4 col-xs-12">
            </div>
        </div>
        <!-- <div class="row">
            <div class="col-lg-12 col-xs-12">
                <div class="dash_table">
                    <h2>AMC Dashboard</h2>
                </div>
            </div>
        </div> -->
        <div class="row">
            <div class="col-lg-6">
                <div class="box1">
                    <div class="col-lg-12 col-xs-12">
                        <h2 class="sub-header">Service/Call Reminder</h2>
                    </div>
                    <div class="col-lg-12 col-xs-12 mt-1">
                        {!! Form::open(array('route' => 'home','method'=>'GET')) !!}
                            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-3">
                                <div class="form-group">
                                    <strong class="lab_space">Type</strong>
                                    {!! Form::select('type',array('Free Service','Complaint'),isset($type) && $type ? $type : null, array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-3">
                                <div class="form-group">
                                    <strong class="lab_space">Days</strong>
                                    {!! Form::text('day',isset($day) && $day ? $day : null, array('placeholder' => 'Days' ,'class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 mt-4">
                                <button type="submit" class="btn btn_tile">Search</button>
                            </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="col-lg-12 col-xs-12">
                        <div class="table-responsive">
                            <table class="table table-bordered dynamic-data-table">
                                <thead>
                                    <tr>
                                        <th>AMC No</th>
                                        <th>Company</th>
                                        <th>Person Name</th>
                                        <th>City</th>
                                        {{-- <th>Complaint No</th> --}}
                                        <th>Complaint Date</th>
                                        <th>Remain Hours</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($data) && $data)
                                        @foreach ($data as $value)
                                            @php
                                                $diff = strtotime($value->date) - strtotime(date('Y-m-d'));
                                                $remainDay = abs(round($diff / 86400));
                                                $bgcolor = "";
                                                if($remainDay <= 10)
                                                {
                                                    $bgcolor = "red";
                                                }
                                            @endphp
                                            <tr style="background-color:{{ $bgcolor }}">
                                                {{-- class="col-lg-4 col-sm-12 col-md-4" --}}
                                                <td data-label="AMC No">{{ $value->amc_id }}</td>
                                                <td data-label="Company">{{ $value->company_name }}</td>
                                                <td data-label="Person Name">{{ $value->person_name }}</td>
                                                <td data-label="City">{{ $value->city }}</td>
                                                {{-- <td data-label="Complaint No">{{ $remainDay }}</td> --}}
                                                <td data-label="Complaint Date">{{ $value->date }}</td>
                                                <td data-label="Remain Hour">{{ $remainDay }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="box1">
                    <div class="col-lg-12 col-xs-12">
                        <h2 class="sub-header">Complaint Summary</h2>
                    </div>
                    <div class="col-lg-12 col-xs-12 mt-1">
                        {!! Form::open(array('route' => 'home','method'=>'GET')) !!}
                            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-3">
                                <div class="form-group">
                                    <strong class="lab_space">From Date</strong>
                                    {!! Form::text('from_date', null, array('placeholder' => 'From Date' ,'class' => 'form-control datepicker')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-3">
                                <div class="form-group">
                                    <strong class="lab_space">To Date</strong>
                                    {!! Form::text('to_date', null, array('placeholder' => 'To Date' ,'class' => 'form-control datepicker')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 mt-4">
                                <button type="submit" class="btn btn_tile">Search</button>
                            </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="col-lg-12 col-xs-12">
                        <div id="complaint_summary" style="width: 100%; height: 500px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js-script')
<script>
google.charts.load('current', {'packages':['bar']});
google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Complaint'],
          ['Pending', {{ $pendingComplaint }}],
          ['Complete', {{ $completeComplaint }}]
        ]);

        var options = {
          chart: {
            title: 'Complaint Summary',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('complaint_summary'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
</script>
@endsection
