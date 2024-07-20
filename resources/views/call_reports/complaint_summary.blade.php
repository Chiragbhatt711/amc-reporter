@extends('layouts.adminapp')
@section('content')
<!-- PAGE-HEADER -->
<div class="page-header d-flex align-items-center justify-content-between border-bottom mb-4">
    <h1 class="page-title">Complaint Summary</h1>
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
                    {!! Form::open(array('route' => 'complaint_summary','method'=>'GET')) !!}
                        <div class="row mt-1">
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <strong class="lab_space">Start Date</strong>
                                    {!! Form::date('start_date', $startDate, array('placeholder' => 'Start Date' ,'class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <strong class="lab_space">End Date</strong>
                                    {!! Form::date('start_date', $endDate, array('placeholder' => 'End Date' ,'class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 mt-4">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
                <div class="card-body">
                    <div id="grid-pagination">
                        <div role="complementary" class="gridjs gridjs-container" style="width: 100%;">
                            <div class="gridjs-wrapper" style="height: auto;">
                                <table role="grid" class="gridjs-table" style="height: auto;">
                                    <thead  class="gridjs-thead">
                                        <tr class="gridjs-tr">
                                          <th class="gridjs-th" data-column-id="No"><div class="gridjs-th-content">No</div></th>
                                          <th class="gridjs-th" data-column-id="Complaint Title"><div class="gridjs-th-content">Complaint Title</div></th>
                                          <th class="gridjs-th" data-column-id="No of Times"><div class="gridjs-th-content">No of Times</div></th>
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
                                                <td class="gridjs-td" data-column-id="Complaint Title">{{ $value->complait_title }}</td>
                                                <td class="gridjs-td" data-column-id="No Of Times">{{ $value->total }}</td>
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
