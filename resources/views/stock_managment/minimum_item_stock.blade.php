@extends('layouts.adminapp')
@section('content')
<div class="container">
    @if ($message = Session::get('success'))
        <div class="alert alert_msg">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="title">
        <h3>Minimum Item Stock Report</h3>
    </div>
    <table class="table table-bordered dynamic-data-table">
        <thead  class="">
            <tr>
            <th scope="col">Group Name</th>
            <th scope="col">Brand</th>
            <th scope="col">Model</th>
            <th scope="col">Product Code</th>
            <th scope="col">Product Name</th>
            <th scope="col">Minimum Stock</th>
            <th scope="col">Stock Qty</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($mainData) && $mainData)
                @php
                    $i = 0;
                @endphp
                @foreach ($mainData as $value)
                    @php
                        $i++;
                    @endphp
                    <tr>
                        <td data-label="Group Name">{{ $value->group }}</td>
                        <td data-label="Brand">{{ $value->brand }}</td>
                        <td data-label="Model">{{ $value->model }}</td>
                        <td data-label="Product Code">{{ $value->product_code }}</td>
                        <td data-label="Product Name">{{ $value->product_name }}</td>
                        <td data-label="Minimum Stock">{{ $value->min_qty }}</td>
                        <td data-label="Stock Qty">{{ $value->inward_qty - $value->outward_qty }}</td>
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
    $('#deleteForm').attr('action','{{ url("manage_tax") }}'+ '/'+id);
    $('#deleteModal').modal('show');
}
</script>
@endsection
