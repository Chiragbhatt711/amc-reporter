@extends('layouts.adminapp')
@section('content')
<!-- PAGE-HEADER -->
<div class="page-header d-flex align-items-center justify-content-between border-bottom mb-4">
    <h1 class="page-title">Manage Complaint</h1>
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
        {!! Form::open(array('route' => 'manage_complaint.index','method'=>'GET')) !!}
            <div class="row mt-1">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <strong class="lab_space">Start Date</strong>
                        {!! Form::select('type', array('all'=>'All','free'=>'Free','complaint'=>'Complaint'),isset($_GET['type']) ? $_GET['type'] : null, array('class' => 'form-select','onchange'=>'this.form.submit()')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <strong class="lab_space">Start Date</strong>
                        {!! Form::date('start_date', $startDate, array('placeholder' => 'Start Date' ,'class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <strong class="lab_space">End Date</strong>
                        {!! Form::date('end_date', $endDate, array('placeholder' => 'End Date' ,'class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 mt-3">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        {!! Form::close() !!}
    <!-- Start:: row-2 -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">
                        @can('manage-complaint-create')
                            <a class="btn btn-primary btn-block float-end my-2" href="{{ Route('manage_complaint.create') }}">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div id="grid-pagination">
                        <div role="complementary" class="gridjs gridjs-container" style="width: 100%;">
                            <div class="gridjs-wrapper" style="height: auto;">
                                <table role="grid" class="gridjs-table" style="height: auto;">
                                    <thead  class="gridjs-thead">
                                        <tr>
                                            <th  class="gridjs-th" data-column-id="Complaint No">Complaint No</th>
                                            <th  class="gridjs-th" data-column-id="Complaint Date">Complaint Date</th>
                                            <th  class="gridjs-th" data-column-id="Call Type">Call Type</th>
                                            {{-- <th  class="gridjs-th" data-column-id="">Party Name</th> --}}
                                            <th  class="gridjs-th" data-column-id="Contract Person Name">Contract Person Name</th>
                                            <th  class="gridjs-th" data-column-id="City">City</th>
                                            <th  class="gridjs-th" data-column-id="AMC No">AMC No</th>
                                            <th  class="gridjs-th" data-column-id="AMC Type">AMC Type</th>
                                            {{-- <th  class="gridjs-th" data-column-id="Start Date">Start Date</th>
                                            <th  class="gridjs-th" data-column-id="End Date">End Date</th> --}}
                                            <th  class="gridjs-th" data-column-id="Complaint By">Complaint By</th>
                                            {{-- <th  class="gridjs-th" data-column-id="Complaint By Contact Number">Complaint By Contact Number</th> --}}
                                            <th  class="gridjs-th" data-column-id="Priority">Priority</th>
                                            <th  class="gridjs-th" data-column-id="Status">Status</th>
                                            <th  class="gridjs-th" data-column-id="Handover TO">Handover TO</th>
                                            <th  class="gridjs-th" data-column-id="Handover Date">Handover Date</th>
                                            <th  class="gridjs-th" data-column-id="Action">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($data) && $data)
                                            @php
                                                $i = 0;
                                            @endphp
                                            @foreach ($data as $value)
                                                @php $i++;  @endphp
                                                <tr>
                                                    <td class="gridjs-td" data-column-id="Complaint No">{{ $value->id }}</td>
                                                    <td class="gridjs-td" data-column-id="Complaint Date">{{ \Carbon\Carbon::parse($value->service_date)->format('Y-m-d') }}</td>
                                                    <td class="gridjs-td" data-column-id="Call Type">{{ $value->is_free == 1 ? 'Free' : 'Complaint' }}</td>
                                                    {{-- <td class="gridjs-td" data-column-id="Party Name">{{ $value->party_name }}</td> --}}
                                                    <td class="gridjs-td" data-column-id="Contract Person Name">{{ $value->contact_person_name }}</td>
                                                    <td class="gridjs-td" data-column-id="City">{{ $value->city }}</td>
                                                    <td class="gridjs-td" data-column-id="AMC No">{{ $value->amc_no }}</td>
                                                    <td class="gridjs-td" data-column-id="AMC Type">{{ $value->amc_type }}</td>
                                                    {{-- <td class="gridjs-td" data-column-id="Start Date">{{ $value->start_date }}</td>
                                                    <td class="gridjs-td" data-column-id="End Date">{{ $value->end_date }}</td> --}}
                                                    <td class="gridjs-td" data-column-id="Complaint By">{{ $value->complait_by }}</td>
                                                    {{-- <td class="gridjs-td" data-column-id="Complaint By Contact Number">{{ $value->mobile }}</td> --}}
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
                                                    <td class="gridjs-td" data-column-id="Handover To">{{ $value->handover }}</td>
                                                    <td class="gridjs-td" data-column-id="Handover Date">{{ $value->handover_date.' '.$value->handover_time }}</td>
                                                    <td class="gridjs-td" data-column-id="Action">
                                                        @can('manage-complaint-edit')
                                                            <a class="btn btn-sm btn-icon btn-info-light rounded-circle" href="{{Route('manage_complaint.edit',$value->id)}}"> <i class="fa fa-pencil" aria-hidden="true"></i> </a>
                                                        @endcan
                                                        @can('manage-complaint-delete')
                                                            <a class="btn btn-sm btn-icon btn-secondary-light rounded-circle" onclick="deleteFunction( '{{ $value->id }}')"> <i class="fa fa-trash" aria-hidden="true"></i> </a>
                                                        @endcan
                                                        @can('manage-complaint-edit')
                                                            <a class="btn btn-sm btn-icon btn-info-light rounded-circle" href="{{Route('call_update',$value->id)}}"> <i class="fa-solid fa-clipboard-check"></i> </a>
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
    </div>
</div>

<div class="modal" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are sure want to delete</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_tile" data-bs-dismiss="modal">Cancel</button>
                {!! Form::open(['method' => 'DELETE','style'=>'display:inline','id'=>'deleteForm']) !!}
                    <input type="submit" class="btn btn-primary" value="Delete">
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<!-- CONTAINER CLOSED -->
@endsection

@section('js-script')
<script>
    function deleteFunction(id){
        $('#deleteForm').attr('action','{{ url("manage_complaint") }}'+ '/'+id);
        $('#deleteModal').modal('show');
    }
</script>
@endsection
