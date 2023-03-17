@extends('layouts.adminapp')
@section('content')
<div class="container">
    @if ($message = Session::get('success'))
        <div class="alert alert_msg">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="title">
        <h3>Manage Inward</h3>
        <!-- <div class="pull-right"> -->
            <a class="btn add_btn" href="{{ route('manage_inward.create') }}">
                <i class="fa fa-plus" aria-hidden="true"></i>
            </a>
        <!-- </div> -->
    </div>
    <table class="table dynamic-data-table">
        <thead  class="">
            <tr>
                <th scope="col">Inward Date</th>
                <th scope="col">Reference Bill No</th>
                <th scope="col">Supplier Type</th>
                <th scope="col">Company Name</th>
                <th scope="col">Person Name</th>
                <th scope="col">City</th>
                <th scope="col">Total Item</th>
                <th scope="col">Total Qty</th>
                <th scope="col">Total Amount</th>
                <th scope="col">Note</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($manageParty) && $manageParty)
                @php
                    $i = 0;
                @endphp
                @foreach ($manageParty as $value)
                    @php
                        $i++;
                    @endphp
                    <tr>
                        <td>{{ $value->party_name }}</td>
                        <td>{{ $value->contact_person_name }}</td>
                        <td>{{ $value->address }}</td>
                        <td>{{ $value->city }}</td>
                        <td>{{ $value->state }}</td>
                        <td>{{ $value->country }}</td>
                        <td>{{ $value->mobile_no }}</td>
                        <td>{{ $value->phone_no }}</td>
                        <td>{{ $value->pincode }}</td>
                        <td>{{ $value->email }}</td>
                        <td>{{ $value->extf_1 }}</td>
                        <td>{{ $value->extf_2 }}</td>
                        <td>{{ $value->extf_3 }}</td>
                        <td>{{ $value->extf_4 }}</td>
                        <td>{{ $value->extf_5 }}</td>
                        <td>
                            @can('user-edit')
                                <a href="{{Route('manage_inward.edit',$value->id)}}"> <i class="fa fa-pencil" aria-hidden="true"></i> </a>
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
    $('#deleteForm').attr('action','{{ url("manage_inward") }}'+ '/'+id);
    $('#deleteModal').modal('show');
}
</script>
@endsection
