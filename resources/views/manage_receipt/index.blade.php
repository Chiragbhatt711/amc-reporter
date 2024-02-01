@extends('layouts.adminapp')
@section('content')
<!-- PAGE-HEADER -->
<div class="page-header d-flex align-items-center justify-content-between border-bottom mb-4">
    <h1 class="page-title">Manage Receipt</h1>
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
                        @can('manage-receipt-create')
                            <a class="btn btn-primary btn-block float-end my-2" href="{{ route('manage_receipt.create') }}">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div id="grid-pagination">
                        <table class="table table-bordered dynamic-data-table">
                            <thead  class="">
                                <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Party Name</th>
                                <th scope="col">Contact person name</th>
                                <th scope="col">City</th>
                                <th scope="col">AMC No.</th>
                                <th scope="col">AMC Type</th>
                                <th scope="col">Payment Mode</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Payment date</th>
                                {{-- <th scope="col">Reference No.</th>
                                <th scope="col">Note</th> --}}
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($receipt) && $receipt)
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach ($receipt as $value)
                                        @php
                                            $i++;
                                        @endphp
                                        <tr>
                                            <td data-label="Date">{{ $value->date }}</td>
                                            <td data-label="Party Name">{{ $value->party_name }}</td>
                                            <td data-label="Contact person name">{{ $value->contact_person_name   }}</td>
                                            <td data-label="City">{{ $value->city }}</td>
                                            <td data-label="AMC No.">{{ $value->amc_no }}</td>
                                            <td data-label="AMC Type">{{ $value->amc_type }}</td>
                                            <td data-label="Payment Mode">{{ $value->payment_mode }}</td>
                                            <td data-label="Amount">{{ $value->amount }}</td>
                                            <td data-label="Payment date">{{ $value->payment_date }}</td>
                                            {{-- <td data-label="Reference No.">{{ $value->reference_no }}</td>
                                            <td data-label="Note">{{ $value->note }}</td> --}}
                                            <td data-label="Action">
                                                @can('manage-receipt-edit')
                                                    <a class="btn btn-sm btn-icon btn-info-light rounded-circle" href="{{Route('manage_receipt.edit',$value->id)}}"> <i class="bi bi-pencil-square" aria-hidden="true"></i> </a>
                                                @endcan
                                                @can('manage-receipt-delete')
                                                    <a class="btn btn-sm btn-icon btn-secondary-light rounded-circle" onclick="deleteFunction( '{{ $value->id }}')"> <i class="bi bi-trash" aria-hidden="true"></i> </a>
                                                @endcan
                                                <a class="btn btn-sm btn-icon btn-secondary-light rounded-circle" href="{{Route('manage_receipt.show',$value->id)}}"> <i class="bi bi-printer" aria-hidden="true"></i> </a>
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
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
            {!! Form::open(['method' => 'DELETE','style'=>'display:inline','id'=>'deleteForm']) !!}
                <input type="submit" class="btn btn-primary" value="Delete">
            {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
<!-- CONTAINER CLOSED -->
<script>
    function deleteFunction(id){
        $('#deleteForm').attr('action','{{ url("manage_receipt") }}'+ '/'+id);
        $('#deleteModal').modal('show');
    }
</script>
@endsection
