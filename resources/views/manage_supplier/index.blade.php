@extends('layouts.adminapp')
@section('content')
<div class="container">
    @if ($message = Session::get('success'))
        <div class="alert alert_msg">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="title">
        <h3>Manage Supplier</h3>
        <!-- <div class="pull-right"> -->
            <a class="btn add_btn" href="{{ route('manage_supplier.create') }}">
                <i class="fa fa-plus" aria-hidden="true"></i>
            </a>
        <!-- </div> -->
    </div>
    <table class="table table-bordered dynamic-data-table">
        <thead  class="">
            <tr>
            <th scope="col">Company Name</th>
            <th scope="col">Person Name</th>
            <th scope="col">Supplier Type</th>
            <th scope="col">Address</th>
            <th scope="col">City</th>
            <th scope="col">State</th>
            <th scope="col">Country</th>
            <th scope="col">Pincode</th>
            <th scope="col">Phone no.</th>
            <th scope="col">E-mail</th>
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
                        <td data-label="Company Name">{{ $value->company_name }}</td>
                        <td data-label="Person Name">{{ $value->person_name }}</td>
                        <td data-label="Supplier Type">{{ $value->supplier_type }}</td>
                        <td data-label="Address">{{ $value->address }}</td>
                        <td data-label="City">{{ $value->city }}</td>
                        <td data-label="State">{{ $value->state }}</td>
                        <td data-label="Country">{{ $value->country }}</td>
                        <td data-label="Pincode">{{ $value->pincode }}</td>
                        <td data-label="Phone No.">{{ $value->phone_no }}</td>
                        <td data-label="E-mail">{{ $value->e_mail }}</td>
                        <td data-label="Action">
                            @can('user-edit')
                                <a href="{{Route('manage_supplier.edit',$value->id)}}"> <i class="fa fa-pencil" aria-hidden="true"></i> </a>
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
    $('#deleteForm').attr('action','{{ url("manage_supplier") }}'+ '/'+id);
    $('#deleteModal').modal('show');
}
</script>
@endsection
