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
{!! Form::model($data, ['method' => 'PATCH','route' => ['call_update_post', $data->id]]) !!}
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
                    {!! Form::text('update_date', date('Y-m-d'), ['class' => 'form-control datepicker','placeholder' =>'date', 'id'=> 'qty' ]) !!}
                </div>
                @error('update_date')
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
                    {!! Form::select('solution_id', $soluction , null, ['class' => 'form-select','placeholder' =>'Please Select', 'id'=>'solution' ]) !!}
                </div>
                @error('solution_id')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-xs-1 col-sm-3 col-md-3">
                <strong class="lab_space">Description <em class="text-danger">*</em></strong>
                <div class="d-flex">
                    {!! Form::textarea('call_description', null, ['class' => 'form-control','placeholder' =>'Note','id' => 'description' ]) !!}
                </div>
                @error('call_description')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-xs-1 col-sm-3 col-md-3">
                <strong class="lab_space">Remark</strong>
                <div class="d-flex">
                    {!! Form::textarea('call_remark', null, ['class' => 'form-control','placeholder' =>'Note','id' => 'remark' ]) !!}
                </div>
            </div>
        </div>
        <div class="row my-3">
            <h4 class="form_sub_title">Used Parts Details</h4>
            <div class="col-xs-1 col-sm-3 col-md-3">
                <strong class="lab_space">Item Name<em class="text-danger">*</em></strong>
                <div class="d-flex">
                    {!! Form::text('item_name', null, ['class' => 'form-control','placeholder' =>'Item Name','id' => 'item_name' ]) !!}
                </div>
                <div class="text-danger" id="item_name_e"></div>
            </div>
            <div class="col-xs-1 col-sm-3 col-md-2">
                <strong class="lab_space">Used Qty<em class="text-danger">*</em></strong>
                <div class="d-flex">
                    {!! Form::text('used_qty', null, ['class' => 'form-control','placeholder' =>'Used Qty','id' => 'used_qty','onkeyup'=>'totalAmount();' ]) !!}
                </div>
                <div class="text-danger" id="used_qty_e"></div>
            </div>
            <div class="col-xs-1 col-sm-3 col-md-2">
                <strong class="lab_space">Rate<em class="text-danger">*</em></strong>
                <div class="d-flex">
                    {!! Form::text('rate', null, ['class' => 'form-control','placeholder' =>'Rate','id' => 'rate','onkeyup'=>'totalAmount();' ]) !!}
                </div>
                <div class="text-danger" id="rate_e"></div>
            </div>
            <div class="col-xs-1 col-sm-3 col-md-2">
                <strong class="lab_space">Amount<em class="text-danger">*</em></strong>
                <div class="d-flex">
                    {!! Form::text('amount', null, ['class' => 'form-control','placeholder' =>'Amount','id' => 'amount','readonly' ]) !!}
                </div>
                <div class="text-danger" id="amount_e"></div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <a href="javascript:void(0)" class="form_btn" name="add" value="Add" onclick="item_add();">Add</a>
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
                    <tbody id="item_body">
                        @php
                            $items = callUpdateItems($data->id);
                        @endphp
                        @if(isset($items) && $items)
                            @foreach ($items as $data)
                            @php $uniqId = uniqid(); @endphp
                            <tr id="row_{{ $uniqId }}">
                                <td>{{ $data->item_name }}
                                    <input type="hidden" value="{{ $data->item_name }}" name="item_name_{{ $uniqId }}" id="item_name_{{ $uniqId }}">
                                </td>
                                <td>{{ $data->used_qty }}
                                    <input type="hidden" value="{{ $data->used_qty }}" name="used_qty_{{ $uniqId }}" id="used_qty_{{ $uniqId }}">
                                </td>
                                <td>{{ $data->rate }}
                                    <input type="hidden" value="{{ $data->rate }}" name="rate_{{ $uniqId }}" id="rate_{{ $uniqId }}">
                                </td>
                                <td>{{ $data->amount }}
                                    <input type="hidden" value="{{ $data->amount }}" name="amount_{{ $uniqId }}" id="amount_{{ $uniqId }}">
                                </td>

                                <td>
                                    <a href="javascript:void(0)" onclick="productRemove(`{{ $uniqId }}`)"> <i class="fa fa-trash" aria-hidden="true"></i> </a>
                                    <input type="hidden" name="get_ids[]" value="{{ $uniqId }}">
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

function totalAmount()
{
    let used_qty = $('#used_qty').val();
    let rate = $('#rate').val();

    let total = used_qty * rate ;
    $('#amount').val(total);
}

function item_add()
{
    let item_name = $('#item_name').val();
    let used_qty = $('#used_qty').val();
    let rate = $('#rate').val();
    let amount = $('#amount').val();
    let error = 0;
    $('#item_name_e').html('');
    $('#used_qty_e').html('');
    $('#rate_e').html('');
    $('#amount_e').html('');
    if(item_name == '')
    {
        $('#item_name_e').html('please enter item name');
        error = 1;
    }
    if(used_qty == '')
    {
        $('#used_qty_e').html('please enter item name');
        error = 1;
    }
    if(rate == '')
    {
        $('#rate_e').html('please enter item name');
        error = 1;
    }
    if(amount == '')
    {
        $('#amount_e').html('please enter item name');
        error = 1;
    }

    if(error != 0)
    {
        return false;
    }
    else
    {
        $.ajax({
            url:"{{ route('item_add') }}",
            type:'POST',
            data:{
                    '_token' : '{{ csrf_token() }}',
                    item_name:item_name,
                    used_qty:used_qty,
                    rate:rate,
                    amount:amount,
            },
            success:function(data) {
                data = $.parseJSON(data)
                $('#item_body').append(data.html);
            }
        });
    }
}
</script>
@endsection
