@extends('layouts.adminapp')
@section('content')
<div class="container">
    @if ($message = Session::get('success'))
        <div class="alert alert_msg">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="title">
        <h3>Manage Receipt</h3>
        <!-- <div class="pull-right"> -->
            <a class="btn add_btn" href="{{ route('manage_receipt.create') }}">
                <i class="fa fa-plus" aria-hidden="true"></i>
            </a>
        <!-- </div> -->
    </div>
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
            <th scope="col">Reference No.</th>
            <th scope="col">Note</th>
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
                        <td data-label="Reference No.">{{ $value->reference_no }}</td>
                        <td data-label="Note">{{ $value->note }}</td>
                        <td data-label="Action">
                            @can('user-edit')
                                <a href="{{Route('manage_receipt.edit',$value->id)}}"> <i class="fa fa-pencil" aria-hidden="true"></i> </a>
                            @endcan
                            @can('user-delete')
                                <a onclick="deleteFunction( '{{ $value->id }}')"> <i class="fa fa-trash" aria-hidden="true"></i> </a>
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
                <div class="`modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>`
                <div class="modal-body">
                    <p>Are sure want to delete</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn " data-dismiss="modal">Cancel</button>
                    {!! Form::open(['method' => 'DELETE','style'=>'display:inline','id'=>'deleteForm']) !!}
                        <input type="submit" class="btn " value="Delete">
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
    $('#deleteForm').attr('action','{{ url("manage_receipt") }}'+ '/'+id);
    $('#deleteModal').modal('show');
}
</script>
@endsection
