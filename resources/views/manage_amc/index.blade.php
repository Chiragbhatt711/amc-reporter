@extends('layouts.adminapp')
@section('content')
<div class="container">
    @if ($message = Session::get('success'))
        <div class="alert alert_msg">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="title">
        <h3>Manage AMC</h3>
            @can('manage-amc-create')
                <a class="btn add_btn" href="{{ route('manage_amc.create') }}">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                </a>
            @endcan
    </div>
    <table class="table table-bordered dynamic-data-table">
        <thead  class="">
            <tr>
              <th scope="col">No</th>
              <th scope="col">Party Name</th>
              <th scope="col">Person Name</th>
              <th scope="col">City</th>
              <th scope="col">Mobile No</th>
              <th scope="col">AMC Type</th>
              <th scope="col">AMC Start Date</th>
              <th scope="col">AMC End Date</th>
              <th scope="col">Contract Amount</th>
              <th scope="col">Taxt</th>
              <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($manageAmc) && $manageAmc)
                @php
                    $i = 0;
                @endphp
                @foreach ($manageAmc as $value)
                    @php
                        $i++;
                    @endphp
                    <tr>
                        <td data-label="No">
                            <a href="javascript:void(0);" onclick="productDitailsShow('{{ $value->id }}');" id="productShow_{{ $value->id }}">
                                <img src="{{ asset('assets/image/plus.png') }}" style="max-width: 43%;height: auto;width: 21px;">
                            </a>
                            <a href="javascript:void(0);" onclick="productDitailsHide('{{ $value->id }}');" style="display:none;" id="productHide_{{ $value->id }}">
                                <img src="{{ asset('assets/image/minus.png') }}" style="max-width: 43%;height: auto;width: 21px;">
                            </a>
                            {{ $i }}
                        </td>
                        <td data-label="Party Name">{{ $value->party_name }}</td>
                        <td data-label="Person Name">{{ $value->person_name }}</td>
                        <td data-label="City">{{ $value->city }}</td>
                        <td data-label="Mobile No">{{ $value->mobile_no }}</td>
                        <td data-label="AMC Type">{{ $value->amc_type }}</td>
                        <td data-label="AMC Start Date">{{ $value->start_date }}</td>
                        <td data-label="AMC End Date">{{ $value->end_date }}</td>
                        <td data-label="Contract Amount">{{ $value->contract_amount }}</td>
                        <td data-label="Taxt">{{ $value->tax }}</td>
                        <td data-label="Action">
                            @can('manage-amc-edit')
                                <a href="{{Route('manage_amc.edit',$value->id)}}"> <i class="fa fa-pencil" aria-hidden="true"></i> </a>
                            @endcan
                            @can('manage-amc-delete')
                                <a onclick="deleteFunction( '{{ $value->id }}')"> <i class="fa fa-trash" aria-hidden="true"></i> </a>
                            @endcan
                        </td>
                    </tr>
                    <tr class="child_row_{{ $value->id }}" style="display: none">
                        <th> </th>
                        <th scope="col">Product Code</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Model</th>
                        <th scope="col">Brand</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Note</th>
                    </tr>
                    @php
                        $product = getAmcProductDetails($value->id);
                    @endphp
                    @if(isset($product) && $product)
                        @foreach ($product as $data)
                            <tr class="child_row_{{ $value->id }}" style="display: none">
                                <td></td>
                                <td data-label="Product Code">{{ $data->product_code }}</td>
                                <td data-label="Product Name">{{ $data->product_name }}</td>
                                <td data-label="Model">{{ $data->model }}</td>
                                <td data-label="Brand">{{ $data->brand }}</td>
                                <td data-label="Qty">{{ $data->qty }}</td>
                                <td data-label="Note">{{ $data->note }}</td>
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
    $('#deleteForm').attr('action','{{ url("manage_amc") }}'+ '/'+id);
    $('#deleteModal').modal('show');
}
</script>
@endsection
