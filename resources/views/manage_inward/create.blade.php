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
<!-- PAGE-HEADER -->
<div class="page-header d-flex align-items-center justify-content-between border-bottom mb-4">
    <h1 class="page-title">Manage Inward</h1>
    {{-- <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">AMC Dashboard</li>
        </ol>
    </div> --}}
</div>
<!-- PAGE-HEADER END -->
<!-- CONTAINER -->
<div class="main-container container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">
                        Create
                    </div>
                </div>
                <div class="card-body">
                    {!! Form::open(array('route' => 'manage_inward.store','method'=>'POST','enctype'=>'multipart/form-data')) !!}
                    @csrf
                    <div id="accordion">
                        <div class="row mt-1">
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                                <strong class="lab_space">Inward Date<em class="text-danger">*</em></strong>
                                {!! Form::date('inward_date', date('Y-m-d'), array('placeholder' => 'Inward date','class' => 'form-control','id'=>'inward_date')) !!}
                                @error('inward_date')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                                <strong class="lab_space">Supplier  <em class="text-danger">*</em></strong>
                                <div class="d-flex">
                                    {!! Form::select('supplier_id', $supplier , null, ['class' => 'form-select','placeholder' =>'Please Select','id'=>'supplier_id' ]) !!}
                                    {{-- <i title="Add Party" class="ml-1 btn btn_tile fa fa-plus plus_btn" aria-hidden="true" id="addModel" data-bs-toggle="modal" data-bs-target="#modelModal"></i> --}}
                                </div>
                                @error('supplier_id')
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
                                    {!! Form::text('qty', null, ['class' => 'form-control','placeholder' =>'Qty', 'id'=> 'qty','onkeyup'=>'amountCount()' ]) !!}
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
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 mt-3">
                                <strong class="lab_space"> </strong>
                                <a href="javascript:void(0)"class="btn btn-primary" name="add" value="Add" onclick="add_product();">ADD</a>
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
                            <button type="submit" class="btn btn-primary">SUBMIT</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js-script')
<script>
    function productDetail()
    {
        var product_id = $('#product_id').val();

        $.ajax({
            url: "{{ route('get_product_detail') }}",
            type:'POST',
            data:{
                    '_token' : $('meta[name="csrf-token"]').attr('content'),
                    product_id:product_id,
            },
            success:function(data) {
                data = JSON.parse(data);
                $('#qty').val(data.min_qty);
                $('#rate').val(data.mrp);
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
