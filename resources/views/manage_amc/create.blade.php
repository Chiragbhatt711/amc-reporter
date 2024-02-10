@extends('layouts.adminapp')
<style>
.fixTableHead {
    overflow-y: auto;
    height: 250px;
}
.fixTableHead thead th {
    position: sticky;
    top: 0;
    background: #f3f6f9!important;
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
    <h1 class="page-title">Manage AMC</h1>
    {{-- <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">AMC Dashboard</li>
        </ol>
    </div> --}}
</div>
<!-- PAGE-HEADER END -->
<!-- CONTAINER -->
<input type="hidden" id="product_add" value="{{ route('product_add') }}">
<input type="hidden" id="get_tex" value="{{ route('get_tex') }}">
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
                    {!! Form::open(array('route' => 'manage_amc.store','method'=>'POST','enctype'=>'multipart/form-data')) !!}
                    @csrf
                    <div class="row mt-1">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                            <strong class="lab_space">party name  <em class="text-danger">*</em></strong>
                            <div class="d-flex">
                                {!! Form::select('party_id', $partyName , null, ['class' => 'form-select','placeholder' =>'Please Select','id'=>'party_id' ]) !!}
                                {{-- <i title="Add Party" class="ml-1 btn btn_tile fa fa-plus plus_btn" aria-hidden="true" id="addModel" data-bs-toggle="modal" data-bs-target="#modelModal"></i> --}}
                            </div>
                            @error('party_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                            <strong class="lab_space">AMC Type<em class="text-danger">*</em></strong>
                                {!! Form::select('amc_type', array('New'=>'New','AMC'=>'AMC','No AMC'=>'No AMC','CMC'=>'CMC','Warranty'=>'Warranty','Free'=>'Free') , null, ['class' => 'form-select','placeholder' =>'Please Select','id'=>'amc_type' ]) !!}
                            @error('amc_type')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                            <strong class="lab_space">Start Date<em class="text-danger">*</em></strong>
                            {!! Form::date('start_date', \Carbon\Carbon::now()->format('Y-m-d'), array('placeholder' => 'Start date','class' => 'form-control ','id'=>'start_date','format' => 'dd-MM-yyyy')) !!}
                            @error('start_date')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                            <strong class="lab_space">End Date<em class="text-danger">*</em></strong>
                            {!! Form::date('end_date',\Carbon\Carbon::now()->addYear()->format('Y-m-d'), array('placeholder' => 'End date','class' => 'form-control','id'=>'end_date')) !!}
                            @error('end_date')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <h4 class="form_sub_title">AMC Product detail</h4>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                            <strong class="lab_space">Product  <em class="text-danger">*</em></strong>
                            <div class="d-flex">
                                {!! Form::select('product_id', $products , null, ['class' => 'form-select','placeholder' =>'Please Select', 'id'=>'product_id' ]) !!}
                                {{-- <i title="Add Product" class="ml-1 btn btn_tile fa fa-plus plus_btn" aria-hidden="true" id="addModel" data-bs-toggle="modal" data-bs-target="#modelModal"></i> --}}
                            </div>
                            @error('product_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                            <strong class="lab_space">Qty  <em class="text-danger">*</em></strong>
                            <div class="d-flex">
                                {!! Form::text('qty', null, ['class' => 'form-control','placeholder' =>'Qty', 'id'=> 'qty' ]) !!}
                            </div>
                            @error('qty')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                            <strong class="lab_space">Note</strong>
                            <div class="d-flex">
                                {!! Form::textarea('note', null, ['class' => 'form-control','placeholder' =>'Note','id' => 'note' ]) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 mt-4">
                            <strong class="lab_space"> </strong>
                            <a href="javascript:void(0)"class="btn btn-primary" name="add" value="Add" onclick="product_add();">ADD</a>
                            <!-- <input type="" class="btn btn-primary" name="add" value="Add" onclick="product_add();"> -->
                        </div>
                    </div>
                    <div class="row my-3">
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
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                                <h4 class="form_sub_title">Schedule Service Detail</h4>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                        <strong class="lab_space">Service Day</strong>
                                        {!! Form::select('service_day', $day , null, ['class' => 'form-select','id'=>'service_day' ]) !!}
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                        <strong class="lab_space">No Of Service <em class="text-danger">*</em></strong>
                                        {!! Form::text('no_of_service', null, ['class' => 'form-control','placeholder' =>'No Of Service', 'id'=> 'no_of_service' ]) !!}
                                        <span id="serviceE" class="text-danger"></span>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                            <a href="javascript:void(0)" class="btn btn-primary mt-3" name="set_service" value="Set Service" onclick="setService();">Set Service</a>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                            <a href="javascript:void(0)" class="btn btn-primary mt-3" name="cleare_service" value="Clear All" onclick="cleareService();">Clear All</a>
                                        </div>
                                    <div class="fixTableHead mt-3">
                                        <table class="table">
                                            <thead  class="text-uppercase table-light">
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Service Date</th>
                                                    <th scope="col">Note</th>
                                                </tr>
                                            </thead>
                                            <tbody id="service_body">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                                <h4 class="form_sub_title">Schedule Payment Detail</h4>
                                <div class="row ">
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                        <strong class="lab_space">Contract Amount <em class="text-danger">*</em></strong>
                                        {!! Form::text('contract_amount', null, ['class' => 'form-control','placeholder' =>'Contract Amount', 'id'=> 'contract_amount','onkeyup'=>'amcTotalPrice();' ]) !!}
                                        <span id="contract_amountE" class="text-danger"></span>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                        <strong class="lab_space">Tax profile <em class="text-danger">*</em></strong>
                                        {!! Form::select('tax_id', $tax , null, ['class' => 'form-select','placeholder' =>'Please Select', 'id'=>'tax_id','onchange'=>'amcTotalPrice();' ]) !!}
                                        <span id="tax_idE" class="text-danger"></span>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                        <strong class="lab_space">No.of Installment <em class="text-danger">*</em></strong>
                                        {!! Form::text('no_of_installment', 1, ['class' => 'form-control','placeholder' =>'No. of Installment', 'id'=> 'no_of_installment' ]) !!}
                                        <span id="no_of_installmentE" class="text-danger"></span>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                        <strong class="lab_space">Tax (%)</strong>
                                        {!! Form::text('tax', 0, ['class' => 'form-control','placeholder' =>'Tax (%)', 'id'=> 'tax','disabled' ]) !!}
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                        <strong class="lab_space">Tax Amount</strong>
                                        {!! Form::text('tax_amount', 0, ['class' => 'form-control','placeholder' =>'Tax Amount', 'id'=> 'tax_amount','disabled' ]) !!}
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                        <strong class="lab_space">Total Amount</strong>
                                        {!! Form::text('total', 0, ['class' => 'form-control','placeholder' =>'Total Amount', 'id'=> 'total','disabled' ]) !!}
                                        {{ Form::hidden('total_amount', null, array('id' => 'total_amount')) }}
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mt-2">
                                        <a href="javascript:void(0)" class="btn btn-primary" name="set" value="Set" onclick="setSchedulePayment();">Set</a>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mt-2">
                                        <a href="javascript:void(0)" class="btn btn-primary" name="schedule_payment" value="Clear All" onclick="cleareSchedulePayment();">Clear All</a>
                                    </div>
                                    <div class="fixTableHead mt-3">
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
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-4">
                        <button type="submit" class="btn btn-primary">SUBMIT</button>
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
        $('#product_id').change(function(){
            var product_id = $('#product_id').val();
            $.ajax({
                url: "{{ route('amc_product_detail') }}",
                type:'POST',
                data:{
                        '_token' : $('meta[name="csrf-token"]').attr('content'),
                        product_id:product_id,
                },
                success:function(data) {
                    // data = JSON.parse(data);
                    $('#note').val(data.product_description);
                }
            });
        });
    </script>
@endsection
