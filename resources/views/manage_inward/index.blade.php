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
            @can('manage-inward-create')
                <a class="btn add_btn" href="{{ route('manage_inward.create') }}">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                </a>
            @endcan
    </div>
    <table class="table table-bordered dynamic-data-table ">
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
            @if(isset($inward) && $inward)
                @php
                    $i = 0;
                @endphp
                @foreach ($inward as $value)
                    @php
                        $i++;
                    @endphp
                    <tr>
                        <td>
                            <a href="javascript:void(0);" onclick="productShow('{{ $value->id }}');" id="productShow_{{ $value->id }}">
                                <img src="{{ asset('assets/image/plus.png') }}" style="max-width: 43%;height: auto;width: 21px;">
                            </a>
                            <a href="javascript:void(0);" onclick="productHide('{{ $value->id }}');" style="display:none;" id="productHide_{{ $value->id }}">
                                <img src="{{ asset('assets/image/minus.png') }}" style="max-width: 43%;height: auto;width: 21px;">
                            </a>
                            {{ $value->inward_date }}
                        </td>
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->supplier_type }}</td>
                        <td>{{ $value->company_name }}</td>
                        <td>{{ $value->person_name }}</td>
                        <td>{{ $value->city }}</td>
                        <td>{{ $value->total_product }}</td>
                        <td>{{ $value->total_qty }}</td>
                        <td>{{ $value->total_amount }}</td>
                        <td>{{ $value->note }}</td>
                        <td>
                            @can('manage-inward-edit')
                                <a href="{{Route('manage_inward.edit',$value->id)}}"> <i class="fa fa-pencil" aria-hidden="true"></i> </a>
                            @endcan
                            @can('manage-inward-delete')
                                <a onclick="deleteFunction( '{{ $value->id }}')"> <i class="fa fa-trash" aria-hidden="true"></i> </a>
                            @endcan
                        </td>
                    </tr>
                    <tr class="child_row_{{ $value->id }}" style="display: none">
                        <th> </th>
                        <th scope="col">Product</th>
                        <th scope="col">Purchase Rate</th>
                        <th scope="col">Sale Rate</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Amount</th>
                    </tr>
                    @php
                        $product = getInwardProductDetails($value->id);
                    @endphp
                    @if(isset($product) && $product)
                        @foreach ($product as $data)
                            <tr class="child_row_{{ $value->id }}" style="display: none">
                                <td></td>
                                <td>{{ $data->product_name }}</td>
                                <td>{{ $data->rate }}</td>
                                <td></td>
                                <td>{{ $data->qty }}</td>
                                <td>{{ $data->amount }}</td>
                            </tr>
                        @endforeach
                    @endif
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
function productShow(id)
{
    $("#productShow_"+id).hide();
    $('#productHide_'+id).show();
    $('.child_row_'+id).show();
}
function productHide(id)
{
    $('#productShow_'+id).show();
    $('#productHide_'+id).hide();
    $('.child_row_'+id).hide();
}
</script>
@endsection
