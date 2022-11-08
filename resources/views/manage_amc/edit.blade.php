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
{!! Form::model($manageAmc, ['method' => 'PATCH','route' => ['manage_amc.update', $manageAmc->id]]) !!}
@csrf
<div class="container">
    <div id="accordion">
        <div class="row mt-1">
            <div class="col-xs-3 col-sm-3 col-md-3">
                <strong class="lab_space">party name  <em class="text-danger">*</em></strong>
                <div class="d-flex">
                    {!! Form::select('party_id', $partyName , null, ['class' => 'form-select','placeholder' =>'Please Select','id'=>'party_id' ]) !!}
                    {{-- <i title="Add Party" class="ml-1 btn btn_tile fa fa-plus plus_btn" aria-hidden="true" id="addModel" data-bs-toggle="modal" data-bs-target="#modelModal"></i> --}}
                </div>
                @error('party_id')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <strong class="lab_space">AMC Type<em class="text-danger">*</em></strong>
                    {!! Form::select('amc_type', array('New'=>'New','AMC'=>'AMC','No AMC'=>'No AMC','CMC'=>'CMC','Warranty'=>'Warranty','Free'=>'Free') , null, ['class' => 'form-select','placeholder' =>'Please Select','id'=>'amc_type' ]) !!}
                @error('amc_type')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <strong class="lab_space">Start Date<em class="text-danger">*</em></strong>
                {!! Form::text('start_date', null, array('placeholder' => 'Start date','class' => 'form-control datepicker')) !!}
                @error('start_date')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <strong class="lab_space">End Date<em class="text-danger">*</em></strong>
                {!! Form::text('end_date', null, array('placeholder' => 'End date','class' => 'form-control datepicker')) !!}
                @error('end_date')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <hr>
        <div class="row mt-2 ">
            <div class="col-xs-12 col-sm-12 col-md-12 px-md-5">
                <strong class="lab_space">AMC Product detail</strong>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <strong class="lab_space">Product  <em class="text-danger">*</em></strong>
                <div class="d-flex">
                    {!! Form::select('product_id', $products , null, ['class' => 'form-select','placeholder' =>'Please Select', 'id'=>'product_id' ]) !!}
                    {{-- <i title="Add Product" class="ml-1 btn btn_tile fa fa-plus plus_btn" aria-hidden="true" id="addModel" data-bs-toggle="modal" data-bs-target="#modelModal"></i> --}}
                </div>
                @error('product_id')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <strong class="lab_space">Qty  <em class="text-danger">*</em></strong>
                <div class="d-flex">
                    {!! Form::text('qty', null, ['class' => 'form-control','placeholder' =>'Qty', 'id'=> 'qty' ]) !!}
                </div>
                @error('qty')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-xs-1 col-sm-3 col-md-3">
                <strong class="lab_space">Note</strong>
                <div class="d-flex">
                    {!! Form::textarea('note', null, ['class' => 'form-control','placeholder' =>'Note','id' => 'note' ]) !!}
                </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="d-flex">
                    <input type="button" class="" name="add" value="Add" onclick="product_add();" style="position:relative; top:27px;">
                </div>
            </div>
        </div>
        <hr>
        <div class="row mt-2 ">
            <div class="fixTableHead">
                <table class="table">
                    <thead  class="text-uppercase table-light">
                        <tr>
                            <th scope="col">Product Code</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Model</th>
                            <th scope="col">Brand</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Note</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="product_body">
                        @php
                            $product = getAmcProductDetails($manageAmc->id);
                        @endphp
                        @if(isset($product) && $product)
                            @foreach ($product as $data)
                            @php $uniqId = uniqid(); @endphp
                            <tr id="row_{{ $uniqId }}">
                                <td>{{ $data->product_code }}
                                    <input type="hidden" value="{{ $data->product_code }}" name="product_code_{{ $uniqId }}" id="product_code_{{ $uniqId }}">
                                </td>
                                <td> {{ $data->product_name }}
                                    <input type="hidden" value="{{ $data->id }}" name="product_id_{{$uniqId}}" id="product_id_{{$uniqId}}">
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
        <hr>
        <div class="row mt-2 ">
            <div class="col-xs-5 col-sm-5 col-md-5">
                    <strong class="lab_space">Schedule Service Detail</strong>
                    <hr>
                    <div class="row ">
                        <div class="col-xs-3 col-sm-3 col-md-3">
                            <strong class="lab_space">Service Day</strong>
                            {!! Form::select('service_day', $day , null, ['class' => 'form-select', 'id'=>'service_day' ]) !!}
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <strong class="lab_space">No Of Service <em class="text-danger">*</em></strong>
                            {!! Form::text('no_of_service', null, ['class' => 'form-control','placeholder' =>'No Of Service', 'id'=> 'no_of_service' ]) !!}
                            <span id="serviceE" class="text-danger"></span>
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4">
                                <input type="button" class="" name="set_service" value="Set Service" onclick="setService();">
                                <input type="button" class="mt-1" name="cleare_service" value="Cleare All" onclick="cleareService();">
                        </div>
                        <div class="fixTableHead mt-2">
                            <table class="table">
                                <thead  class="text-uppercase table-light">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Service Date</th>
                                        <th scope="col">Note</th>
                                    </tr>
                                </thead>
                                <tbody id="service_body">
                                    @if (isset($service) && $service)
                                        @php $count = 0; @endphp
                                        @foreach ($service as $data)
                                        @php $count++; @endphp
                                            <tr>
                                                <td>
                                                    {{$count}}
                                                </td>
                                                <td>
                                                    {{ $data->service_date }}
                                                    <input type="hidden" name="service_{{$count}}" value="{{ $data->service_date }}">
                                                </td>
                                                <td>
                                                    {{$count.' Free Service'}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
            </div>
            <div class="col-xs-7 col-sm-7 col-md-7">
                    <strong class="lab_space">Schedule Payment Detail</strong>
                    <hr>
                    <div class="row ">
                        <div class="col-xs-3 col-sm-3 col-md-3">
                            <strong class="lab_space">Contract Amount <em class="text-danger">*</em></strong>
                            {!! Form::text('contract_amount', null, ['class' => 'form-control','placeholder' =>'Contract Amount', 'id'=> 'contract_amount','onkeyup'=>'amcTotalPrice();' ]) !!}
                            <span id="contract_amountE" class="text-danger"></span>
                        </div>
                        <div class="col-xs-3 col-sm-3 col-md-3">
                            <strong class="lab_space">Tax profile <em class="text-danger">*</em></strong>
                            {!! Form::select('tax_id', $tax , null, ['class' => 'form-select','placeholder' =>'Please Select', 'id'=>'tax_id','onchange'=>'amcTotalPrice();' ]) !!}
                            <span id="tax_idE" class="text-danger"></span>
                        </div>
                        <div class="col-xs-3 col-sm-3 col-md-3">
                            <strong class="lab_space">No.of Installment <em class="text-danger">*</em></strong>
                            {!! Form::text('no_of_installment', 1, ['class' => 'form-control','placeholder' =>'No. of Installment', 'id'=> 'no_of_installment' ]) !!}
                            <span id="no_of_installmentE" class="text-danger"></span>
                        </div>
                        <div class="col-xs-3 col-sm-3 col-md-3 mt-4">
                                <input type="button" class="" name="set_service" value="Set Service" onclick="setSchedulePayment();">
                        </div>
                        <div class="col-xs-3 col-sm-3 col-md-3">
                            <strong class="lab_space">Tax (%)</strong>
                            {!! Form::text('tax', 0, ['class' => 'form-control','placeholder' =>'Tax (%)', 'id'=> 'tax','disabled' ]) !!}
                        </div>
                        <div class="col-xs-3 col-sm-3 col-md-3">
                            <strong class="lab_space">Tax Amount</strong>
                            {!! Form::text('tax_amount', 0, ['class' => 'form-control','placeholder' =>'Tax Amount', 'id'=> 'tax_amount','disabled' ]) !!}
                        </div>
                        <div class="col-xs-3 col-sm-3 col-md-3">
                            <strong class="lab_space">Total Amount</strong>
                            {!! Form::text('total', 0, ['class' => 'form-control','placeholder' =>'Total Amount', 'id'=> 'total','disabled' ]) !!}
                            {{ Form::hidden('total_amount', 'secret', array('id' => 'total_amount')) }}
                        </div>
                        <div class="col-xs-3 col-sm-3 col-md-3">
                            <input type="button" class="mt-1" name="schedule_payment" value="Cleare All" onclick="cleareSchedulePayment();">
                        </div>
                        <div class="fixTableHead mt-2">
                            <table class="table">
                                <thead  class="text-uppercase table-light">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Installment Date</th>
                                        <th scope="col">Installment Amount</th>
                                        <th scope="col">Note</th>
                                    </tr>
                                </thead>
                                <tbody id="schedule_payment_body">
                                    @if (isset($payment) && $payment)
                                        @php $count = 0; @endphp
                                        @foreach ($payment as $data)
                                        @php $count++; @endphp
                                            <tr>
                                                <td>
                                                    {{$count}}
                                                </td>
                                                <td>
                                                    {{ $data->installment_date }}
                                                    <input type="hidden" name="installmetn_{{$count}}" value="{{ $data->installment_date }}">
                                                </td>
                                                <td>
                                                    {{ $data->installment_amount }}
                                                    <input type="hidden" name="amount_{{$count}}" value="{{ $data->installment_amount }}">
                                                </td>
                                                <td>
                                                    {{$count.' Installment'}}
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


            <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-3">
                <button type="submit" class="btn btn_tile">Submit</button>
            </div>
    </div>
</div>
  {!! Form::close() !!}
@endsection

@section('js-script')
<script>

</script>
@endsection
