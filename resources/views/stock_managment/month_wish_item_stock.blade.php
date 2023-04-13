@extends('layouts.adminapp')
@section('content')
<div class="container">
    @if ($message = Session::get('success'))
        <div class="alert alert_msg">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="title">
        <h3>Month Wise Item Stock</h3>
    </div>
    {!! Form::open(array('route' => 'month_wise_item_stock','method'=>'GET')) !!}
        <div class="row mt-1">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
                <div class="form-group">
                    <strong class="lab_space">Month</strong>
                    {!! Form::text('month', isset($_GET['month']) && $_GET['month'] ? $_GET['month'] : null, array('placeholder' => 'Month' ,'class' => 'form-control monthpicker')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3 mt-4">
                <button type="submit" class="btn btn_tile">Search</button>
            </div>
        </div>
    {!! Form::close() !!}
    <table class="table table-bordered dynamic-data-table">
        <thead  class="">
            <tr>
            <th scope="col">Group Name</th>
            <th scope="col">Brand</th>
            <th scope="col">Model</th>
            <th scope="col">Product Code</th>
            <th scope="col">Product Name</th>
            <th scope="col">Opening Stock</th>
            <th scope="col">Inward Qty</th>
            <th scope="col">Outward Qty</th>
            <th scope="col">Balance Qty</th>
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
                        <td data-label="Opening Stock">{{ $value->opening_qty }}</td>
                        <td data-label="Inward Qty">{{ $value->inward_qty }}</td>
                        <td data-label="Outward Qty">{{ $value->outward_qty }}</td>
                        <td data-label="Balance Qty">{{ $value->inward_qty - $value->outward_qty }}</td>
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
