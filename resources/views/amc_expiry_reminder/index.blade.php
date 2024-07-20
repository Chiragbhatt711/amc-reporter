@extends('layouts.adminapp')
@section('content')
<!-- PAGE-HEADER -->
<div class="page-header d-flex align-items-center justify-content-between border-bottom mb-4">
    <h1 class="page-title">AMC Expiry Reminder Report</h1>
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
                    {!! Form::open(array('route' => 'amc_expiry_reminder','method'=>'GET')) !!}
                        <div class="row mt-1">
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-5">
                                <div class="form-group">
                                    <strong class="lab_space">Start Date</strong>
                                    {!! Form::date('start_date', $startDate, array('placeholder' => 'Start Date' ,'class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-5">
                                <div class="form-group">
                                    <strong class="lab_space">End Date</strong>
                                    {!! Form::date('end_date', $endDate, array('placeholder' => 'End Date' ,'class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
                                <button type="submit" class="btn btn-primary btn-block float-end my-2">Search</button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
                <div class="card-body">
                    <div id="grid-pagination">
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
                                        <td data-label="AMC No">{{ $value->amc_no }}</td>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- CONTAINER CLOSED -->
<script>
    function deleteFunction(id){
        $('#deleteForm').attr('action','{{ url("manage_party") }}'+ '/'+id);
        $('#deleteModal').modal('show');
    }
</script>
@endsection
