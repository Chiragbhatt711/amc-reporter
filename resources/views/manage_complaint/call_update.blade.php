@extends('layouts.adminapp')
<style>
.fixTableHead {
    overflow-y: auto;
    height: 150px;
}
.fixTableHead thead th {
    position: sticky;
    top: 0;
}
table {
    border-collapse: collapse;
    width: 100%;
}
th,
td {
    padding: 8px 15px;
    border: 2px solid #529432;
}
th {
    background: #ABDD93;
}
</style>
@section('content')
@if (count($errors) > 0)

@endif
{!! Form::model($data, ['method' => 'PATCH','route' => ['manage_amc.update', $data->id]]) !!}
@csrf
<div class="container">
    <div id="accordion">
        <div class="row mt-1">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                <strong class="lab_space">party name :</strong>
                <span>{{ $data->party_name }}</span>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                <strong class="lab_space">AMC Type :</strong>
                <span>{{ $data->amc_type }}</span>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                <strong class="lab_space">Start Date :</strong>
                <span>{{ $data->start_date }}</span>
            </div>
        </div>
        <div class="row mt-1">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                <strong class="lab_space">End Date :</strong>
                <span>{{ $data->end_date }}</span>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                <strong class="lab_space">Call No :</strong>
                <span>{{ $data->id }}</span>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                <strong class="lab_space">Call Data/Time :</strong>
                <span>{{ $data->created_at }}</span>
            </div>
        </div>
        <hr>
        <div class="row mt-2">
            <div class="col-xs-3 col-sm-3 col-md-3">
                <strong class="lab_space">Date <em class="text-danger">*</em></strong>
                <div class="d-flex">
                    {!! Form::text('date', null, ['class' => 'form-control','placeholder datepicker' =>'date', 'id'=> 'qty' ]) !!}
                </div>
                @error('date')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <strong class="lab_space">Status  <em class="text-danger">*</em></strong>
                <div class="d-flex">
                    {!! Form::select('status', ['Completed'=>'Completed','Not Completed'=>'Not Completed','Major Repaired'=>'Major Repaired'] , null, ['class' => 'form-select','placeholder' =>'Please Select', 'id'=>'status' ]) !!}
                </div>
                @error('status')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <strong class="lab_space">Attend by  <em class="text-danger">*</em></strong>
                <div class="d-flex">
                    {!! Form::select('attend_by', $executive , null, ['class' => 'form-select','placeholder' =>'Please Select', 'id'=>'attend_by' ]) !!}
                </div>
                @error('attend_by')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <strong class="lab_space">Solution <em class="text-danger">*</em></strong>
                <div class="d-flex">
                    {!! Form::select('solution', $soluction , null, ['class' => 'form-select','placeholder' =>'Please Select', 'id'=>'solution' ]) !!}
                </div>
                @error('solution')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-xs-1 col-sm-3 col-md-3">
                <strong class="lab_space">Description <em class="text-danger">*</em></strong>
                <div class="d-flex">
                    {!! Form::textarea('description', null, ['class' => 'form-control','placeholder' =>'Note','id' => 'description' ]) !!}
                </div>
                @error('description')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-xs-1 col-sm-3 col-md-3">
                <strong class="lab_space">Remark</strong>
                <div class="d-flex">
                    {!! Form::textarea('remark', null, ['class' => 'form-control','placeholder' =>'Note','id' => 'remark' ]) !!}
                </div>
                @error('remark')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row my-3">
            <h4 class="form_sub_title">Used Parts Details</h4>
            <div class="col-xs-1 col-sm-3 col-md-3">
                <strong class="lab_space">Item Name</strong>
                <div class="d-flex">
                    {!! Form::text('item_name', null, ['class' => 'form-control','placeholder' =>'Item Name','id' => 'item_name' ]) !!}
                </div>
                @error('item_name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-xs-1 col-sm-3 col-md-3">
                <strong class="lab_space">Used Qty</strong>
                <div class="d-flex">
                    {!! Form::text('used_qty', null, ['class' => 'form-control','placeholder' =>'Used Qty','id' => 'used_qty' ]) !!}
                </div>
                @error('used_qty')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-xs-1 col-sm-3 col-md-3">
                <strong class="lab_space">Rate</strong>
                <div class="d-flex">
                    {!! Form::text('rate', null, ['class' => 'form-control','placeholder' =>'Rate','id' => 'rate' ]) !!}
                </div>
                @error('rate')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-xs-1 col-sm-3 col-md-3">
                <strong class="lab_space">Amount</strong>
                <div class="d-flex">
                    {!! Form::text('amount', null, ['class' => 'form-control','placeholder' =>'Amount','id' => 'amount' ]) !!}
                </div>
                @error('amount')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row my-3">
            <div class="fixTableHead">
                <table class="table">
                    <thead  class="text-uppercase table-light">
                        <tr>
                            <th scope="col">Product Name</th>
                            <th scope="col">Used Qty</th>
                            <th scope="col">Rate</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="product_body">
                        @php
                            $product = getAmcProductDetails(1);
                        @endphp
                        @if(isset($product) && $product)
                            @foreach ($product as $data)
                            @php $uniqId = uniqid(); @endphp
                            <tr id="row_{{ $uniqId }}">
                                <td>{{ $data->product_code }}
                                    <input type="hidden" value="{{ $data->product_code }}" name="product_code_{{ $uniqId }}" id="product_code_{{ $uniqId }}">
                                </td>
                                <td> {{ $data->product_name }}
                                    <input type="hidden" value="{{ $data->product_id }}" name="product_id_{{$uniqId}}" id="product_id_{{$uniqId}}">
                                </td>
                                <td>{{$data->model}}
                                    <input type="hidden" value="{{$data->model_id}}" name="model_id_{{$uniqId}}" id="model_id_{{$uniqId}}">
                                </td>
                                <td>{{$data->brand}}
                                    <input type="hidden" value="{{$data->brand_id}}" name="brand_id_{{$uniqId}}" id="brand_id_{{$uniqId}}">
                                </td>
                                <td>{{$data->qty}}
                                    <input type="hidden" value="{{$data->qty}}" name="qty_{{$uniqId}}" id="qty_{{$uniqId}}">
                                </td>
                                <td>{{$data->note}}
                                    <input type="hidden" value="{{$data->note}}" name="note_{{$uniqId}}" id="note_{{$uniqId}}">
                                </td>

                                <td>
                                    <a href="javascript:void(0)" onclick="productRemove(`{{$uniqId}}`)"> <i class="fa fa-trash" aria-hidden="true"></i> </a>
                                    <input type="hidden" name="get_ids[]" value="{{$uniqId}}">
                                </td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-3">
            <button type="submit" class="btn btn_tile">Submit</button>
        </div>
    </div>
</div>
  {!! Form::close() !!}
@endsection

@section('js-script')
<script>
$(document).ready(function(){
    $('#tax_id').trigger('change');
});
</script>
@endsection
