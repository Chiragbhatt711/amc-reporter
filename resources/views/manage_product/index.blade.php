@extends('layouts.adminapp')
@section('content')
<div class="container">
    @if ($message = Session::get('success'))
        <div class="alert alert_msg">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="title">
        <h3>Manage Product</h3>
        <!-- <div class="pull-right"> -->
            <a class="btn add_btn" href="{{ route('manage_product.create') }}">
                <i class="fa fa-plus" aria-hidden="true"></i>
            </a>
        <!-- </div> -->
    </div>
    <table class="table  dynamic-data-table">
        <thead  class="">
            <tr>
            <th scope="col">Group</th>
            <th scope="col">Brand</th>
            <th scope="col">Model</th>
            <th scope="col">Product Code</th>
            <th scope="col">Product Name</th>
            <th scope="col">Unit</th>
            <th scope="col">MRP</th>
            <th scope="col">Opening Qty</th>
            <th scope="col">Minimum Qty</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($products) && $products)
                @php
                    $i = 0;
                @endphp
                @foreach ($products as $value)
                    @php
                        $i++;
                    @endphp
                    <tr>
                        <td data-label="Group">{{ $value->group }}</td>
                        <td data-label="Brand">{{ $value->brand }}</td>
                        <td data-label="Model">{{ $value->model }}</td>
                        <td data-label="Product Code">{{ $value->product_code }}</td>
                        <td data-label="Product Name">{{ $value->product_name }}</td>
                        <td data-label="Unit">{{ $value->unit }}</td>
                        <td data-label="MRP">{{ $value->mrp }}</td>
                        <td data-label="Opening Qty">{{ $value->opening_qty }}</td>
                        <td data-label="Minimum Qty">{{ $value->min_qty }}</td>
                        <td data-label="Action">
                            <a href="{{Route('manage_product.edit',$value->id)}}"> <i class="fa fa-pencil" aria-hidden="true"></i> </a>
                            <a onclick="deleteFunction( '{{ $value->id }}')"> <i class="fa fa-trash" aria-hidden="true"></i> </a>
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
    $('#deleteForm').attr('action','{{ url("manage_product") }}'+ '/'+id);
    $('#deleteModal').modal('show');
}
</script>
@endsection
