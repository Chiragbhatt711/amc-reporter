@extends('layouts.adminapp')
@section('content')
<div class="container">
    @if ($message = Session::get('success'))
        <div class="alert alert_msg">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="title">
        <h3>Manage Complaint</h3>
        <!-- <div class="pull-right"> -->
            @can('manage-complaint-create')
                <a class="btn add_btn" href="{{ Route('manage_complaint.create') }}">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                </a>
            @endcan
        <!-- </div> -->
    </div>
    {!! Form::open(array('route' => 'manage_complaint.index','method'=>'GET')) !!}
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
        </div>
    {!! Form::close() !!}
    <table class="table dynamic-data-table">
        <thead>
            <tr>
                <th>Complaint No</th>
                <th>Complaint Date</th>
                <th>Call Type</th>
                <th>Party Name</th>
                <th>Contract Person Name</th>
                <th>City</th>
                <th>AMC No</th>
                <th>AMC Type</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Complaint By</th>
                <th>Complaint By Contact Number</th>
                <th>Priority</th>
                <th>Status</th>
                <th>Handover TO</th>
                <th>Handover Date</th>
                <th>Action</th>
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
                        <td data-label="Complaint No">{{ $value->id }}</td>
                        <td data-label="Complaint Date">{{ $value->created_at }}</td>
                        <td data-label="Call Type"></td>
                        <td data-label="Party Name">{{ $value->party_name }}</td>
                        <td data-label="Contract Person Name">{{ $value->contact_person_name }}</td>
                        <td data-label="City">{{ $value->city }}</td>
                        <td data-label="AMC No">{{ $value->amc_no }}</td>
                        <td data-label="AMC Type">{{ $value->amc_type }}</td>
                        <td data-label="Start Date">{{ $value->start_date }}</td>
                        <td data-label="End Date">{{ $value->end_date }}</td>
                        <td data-label="Complaint By">{{ $value->complait_by }}</td>
                        <td data-label="Complaint By Contact Number">{{ $value->mobile }}</td>
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
                        <td data-label="Handover To">{{ $value->handover }}</td>
                        <td data-label="Handover Date">{{ $value->handover_date.' '.$value->handover_time }}</td>
                        <td data-label="Action">
                            @can('manage-complaint-edit')
                                <a href="{{Route('manage_complaint.edit',$value->id)}}"> <i class="fa fa-pencil" aria-hidden="true"></i> </a>
                            @endcan
                            @can('manage-complaint-delete')
                                <a onclick="deleteFunction( '{{ $value->id }}')"> <i class="fa fa-trash" aria-hidden="true"></i> </a>
                            @endcan
                            @can('manage-complaint-edit')
                                <a href="{{Route('call_update',$value->id)}}"> <i class="fa-solid fa-clipboard-check"></i> </a>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
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
                <button type="button" class="btn btn_tile" data-dismiss="modal">Cancel</button>
                {!! Form::open(['method' => 'DELETE','style'=>'display:inline','id'=>'deleteForm']) !!}
                    <input type="submit" class="btn btn_tile" value="Delete">
                {!! Form::close() !!}
            </div>
          </div>
        </div>
    </div>
</div>
@endsection
@section('js-script')
<script>
function deleteFunction(id){
    $('#deleteForm').attr('action','{{ url("manage_complaint") }}'+ '/'+id);
    $('#deleteModal').modal('show');
}
</script>
@endsection
