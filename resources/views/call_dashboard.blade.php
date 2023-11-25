@extends('layouts.adminapp')
@section('content')
<!-- PAGE-HEADER -->
<div class="page-header d-flex align-items-center justify-content-between border-bottom mb-4">
    <h1 class="page-title">Call Dashboard</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Call Dashboard</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->

<!-- CONTAINER -->
<div class="main-container container-fluid">

    <div class="row">
        <div class="tab-menu-heading tab-menu-heading-boxed">
            <div class="tabs-menu-boxed">
                <!-- Tabs -->
                <ul class="nav panel-tabs d-flex flex-wrap">
                    <li>
                        <a href="{{ route('home') }}" class="d-flex align-items-center">
                            <span class="badge bg-primary-transparent rounded-circle fs-10 me-2">1</span>AMC Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('call_dashboard') }}" class="d-flex align-items-center active">
                            <span class="badge bg-secondary-transparent rounded-circle fs-10 me-2">2</span>Call Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('stock_dashboard') }}" class="d-flex align-items-center">
                            <span class="badge bg-secondary-transparent rounded-circle fs-10 me-2">3</span>Stock Dashboard
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Start:: row-2 -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">
                        Service/Call Reminder
                    </div>
                </div>
                <div class="col-lg-12 col-xs-12 mt-1">
                    {!! Form::open(array('route' => 'call_dashboard','method'=>'GET')) !!}
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
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    {!! Form::close() !!}
                </div>
                <div class="card-body">
                    <div id="grid-pagination">
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
    </div>
    <!-- End:: row-2 -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">
                        Complaint Summary
                    </div>
                </div>
                <div class="col-lg-12 col-xs-12 mt-1">
                    {!! Form::open(array('route' => 'call_dashboard','method'=>'GET')) !!}
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
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    {!! Form::close() !!}
                </div>
                <div class="card-body">
                    <div id="grid-pagination">
                        {{-- <div id="complaint_summary" style="width: 100%; height: 500px;"></div> --}}
                        <canvas id="chartjs-bar" class="chartjs-chart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- CONTAINER CLOSED -->
<script src="{{ asset('dist/assets/libs/chart.js/chart.min.js') }}"></script>
<script>
    const labels1 = [
        'Pending',
        'Complete',
    ];
    const data1 = {
        labels: labels1,
        datasets: [{
            label: '',
            data: [{{ $pendingComplaint }},{{ $completeComplaint }}],
            backgroundColor: [
                'rgba(132, 90, 223, 0.2)',
                'rgba(35, 183, 229, 0.2)'
            ],
            borderColor: [
                'rgb(0, 165, 162)',
                'rgb(35, 183, 229)'
            ],
            borderWidth: 1
        }]
    };
    const config1 = {
        type: 'bar',
        data: data1,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        },
    };
    const myChart1 = new Chart(
        document.getElementById('chartjs-bar'),
        config1
    );
</script>
@endsection
