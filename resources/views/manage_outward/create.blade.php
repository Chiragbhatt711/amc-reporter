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
<input type="hidden" id="product_add" value="{{ route('product_add') }}">
<input type="hidden" id="get_tex" value="{{ route('get_tex') }}">

{!! Form::open(array('route' => 'manage_inward.store','method'=>'POST','enctype'=>'multipart/form-data')) !!}
@csrf
<div class="container">
    <div id="accordion">
        <div class="row mt-1">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                <strong class="lab_space">Inward Date<em class="text-danger">*</em></strong>
                {!! Form::text('inward_date', date('Y-m-d'), array('placeholder' => 'Inward date','class' => 'form-control datepicker','id'=>'inward_date')) !!}
                @error('inward_date')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                <strong class="lab_space">Outward Type <em class="text-danger">*</em></strong>
                <div class="d-flex">
                    {!! Form::select('outward_type', $type , null, ['class' => 'form-select','placeholder' =>'Please Select','id'=>'supplier_id' ]) !!}
                    {{-- <i title="Add Party" class="ml-1 btn btn_tile fa fa-plus plus_btn" aria-hidden="true" id="addModel" data-bs-toggle="modal" data-bs-target="#modelModal"></i> --}}
                </div>
                @error('outward_type')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <h4 class="form_sub_title">Product detail</h4>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                <strong class="lab_space">Product  <em class="text-danger">*</em></strong>
                <div class="d-flex">
                    {!! Form::select('product_id', $products , null, ['class' => 'form-select','placeholder' =>'Please Select', 'id'=>'product_id','onchange'=>'productDetail()' ]) !!}
                    {{-- <i title="Add Product" class="ml-1 btn btn_tile fa fa-plus plus_btn" aria-hidden="true" id="addModel" data-bs-toggle="modal" data-bs-target="#modelModal"></i> --}}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                <strong class="lab_space">Qty  <em class="text-danger">*</em></strong>
                <div class="d-flex">
                    {!! Form::text('qty', 1, ['class' => 'form-control','placeholder' =>'Qty', 'id'=> 'qty','onkeyup'=>'amountCount()' ]) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                <strong class="lab_space">Rate  <em class="text-danger">*</em></strong>
                <div class="d-flex">
                    {!! Form::text('rate', 0, ['class' => 'form-control','placeholder' =>'Rate', 'id'=> 'rate','onkeyup'=>'amountCount()' ]) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                <strong class="lab_space">Amount  <em class="text-danger">*</em></strong>
                <div class="d-flex">
                    {!! Form::text('amount', 0, ['class' => 'form-control','placeholder' =>'Amount', 'id'=> 'amount','readonly' ]) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                <strong class="lab_space"> </strong>
                <a href="javascript:void(0)"class="form_btn" name="add" value="Add" onclick="add_product();">ADD</a>
            </div>
        </div>
        <div class="row my-3">
            <div class="fixTableHead">
                <table class="table">
                    <thead  class="text-uppercase table-light">
                        <tr>
                            <th scope="col">Group</th>
                            <th scope="col">Product Code</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Rate</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="product_body">
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <h4 class="form_sub_title"></h4>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <strong class="lab_space">Note</strong>
                        {!! Form::textarea('note', null, ['class' => 'form-control','placeholder' =>'Note', 'id'=> 'note' ]) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-4">
            <button type="submit" class="btn btn_tile">SUBMIT</button>
        </div>
    </div>
</div>
  {!! Form::close() !!}
@endsection

@section('js-script')
<script>
    function productDetail()
    {
        var product_id = $('#product_id').val();

        $.ajax({
            url: "{{ route('get_product_detail_outward') }}",
            type:'POST',
            data:{
                    '_token' : $('meta[name="csrf-token"]').attr('content'),
                    product_id:product_id,
            },
            success:function(data) {
                data = JSON.parse(data);
                if(data.product)
                {
                    $('#rate').val(data.product.mrp);
                }
                if(data.qty)
                {
                    $('#qty').val(data.qty);
                }
                amountCount();
            }
        });
    }

    function amountCount()
    {
        var qty = $('#qty').val();
        var rate = $('#rate').val();
        var amount = qty * rate;
        $('#amount').val(amount);
    }

    function add_product()
    {
        var product_id = $('#product_id').val();
        var qty = $('#qty').val();
        var rate = $('#rate').val();

        $.ajax({
            url: "{{ route('add_product') }}",
            type:'POST',
            data:{
                    '_token' : $('meta[name="csrf-token"]').attr('content'),
                    product_id:product_id,
                    qty:qty,
                    rate:rate
            },
            success:function(data) {
                data = JSON.parse(data);
                $('#product_body').append(data);
            }
        });
    }

    function removeProduct(id)
    {
        $('#row_'+id).remove();
    }
</script>
@endsection
