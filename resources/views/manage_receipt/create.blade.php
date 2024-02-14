@extends('layouts.adminapp')
@section('content')
<!-- PAGE-HEADER -->
<div class="page-header d-flex align-items-center justify-content-between border-bottom mb-4">
    <h1 class="page-title">Manage Receipt</h1>
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
                    {!! Form::open(array('route' => 'manage_receipt.store','method'=>'POST','enctype'=>'multipart/form-data')) !!}
                    @csrf
                    <div class="row mt-1">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <strong class="lab_space">party name  <em class="text-danger">*</em></strong>
                                <div class="d-flex">
                                {!! Form::select('party_id', $partyName , $selectedParty, ['class' => 'form-select','placeholder' =>'Please Select', 'id'=>'party_id' ]) !!}
                            </div>
                                @error('party_id')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <strong class="lab_space">AMC No <em class="text-danger">*</em></strong>
                                <div class="d-flex">
                                {!! Form::select('amc_id', array() , null, ['class' => 'form-select','placeholder' =>'Please Select', 'id'=>'amc_no','onchange' => 'dueAmount()' ]) !!}
                            </div>
                                @error('amc_id')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <strong class="lab_space">Date <em class="text-danger">*</em></strong>
                                {!! Form::text('date', date('Y-m-d'), array('placeholder' => 'Date' ,'class' => 'form-control datepicker','id' => 'date')) !!}
                                @error('date')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <strong class="lab_space">Mode of payment <em class="text-danger">*</em></strong>
                                <div class="d-flex">
                                {!! Form::select('payment_mode', $paymentMode , null, ['class' => 'form-select','placeholder' =>'Please Select', 'id'=>'mode_of_payment' ]) !!}
                            </div>
                                @error('payment_mode')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <strong class="lab_space">Due Amount <em class="text-danger">*</em></strong>
                                {!! Form::text('due_amount', null, array('placeholder' => 'Due Amount' ,'class' => 'form-control','id' => 'due_amount','readonly')) !!}
                                {!! Form::hidden('total_amount', null, array('id' => 'total_amount')) !!}
                                <span id="total_amount_text"></span>
                                @error('due_amount')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <strong class="lab_space">Amount <em class="text-danger">*</em></strong>
                                {!! Form::text('amount', null, array('placeholder' => 'Amount' ,'class' => 'form-control','id' => 'amount')) !!}
                                @error('amount')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <strong class="lab_space">Payment Date <em class="text-danger">*</em></strong>
                                {!! Form::text('payment_date', date('Y-m-d'), array('placeholder' => 'Payment Date' ,'class' => 'form-control datepicker')) !!}
                                @error('payment_date')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <strong class="lab_space">Reference No</strong>
                                {!! Form::text('reference_no', null, array('placeholder' => 'Reference No' ,'class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                            <strong class="lab_space">Note</strong>
                            <div class="d-flex">
                                {!! Form::textarea('note', null, ['class' => 'form-control','placeholder' =>'Note','id' => 'note' ]) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
                            <div class="d-flex flex-row checkboxes">
                                <div class="check d-flex flex-row align-items-center gap-2">
                                    {{ Form::checkbox('print', 1, false, ['class' => 'print',]) }}
                                    Print Receipt
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
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
    $(document).ready(function(){
        $('#party_id').trigger('change');
    })

$('#party_id').change(function(){
    var party_id = $('#party_id').val();
    var amc_id = '{{ isset($selectedAmcId) && $selectedAmcId ? $selectedAmcId : '' }}';
    $.ajax({
        url:'{{ route('get_amc_number') }}',
        type:'POST',
        data:{
            '_token' : $('meta[name="csrf-token"]').attr('content'),
            party_id:party_id,
        },
        success:function(data) {
            data = JSON.parse(data);
            var html = "<option value=''>Please select</option>";
            $.each(data, function (key, value) {
                var select = "";
                if(key == amc_id)
                {
                    select = "selected";
                }
                html += "<option value='"+key+"' "+select+">"+value+"</option>";
            });
            $('#amc_no').html(html);
            $('#amc_no').trigger('change');
        }
    });

});

function dueAmount()
{
    let amc_no = $('#amc_no').val();
    $('#due_amount').val(0.00);
    $('#total_amount').val(0.00);
    if(amc_no)
    {
        $.ajax({
            url:"{{ route('get_due_amount') }}",
            type:'POST',
            data:{
                    '_token' : $('meta[name="csrf-token"]').attr('content'),
                    amc_no:amc_no,
            },
            success:function(data) {
                $('#due_amount').val(data.due_amount);
                $('#total_amount').val(data.due_amount);
                $('#total_amount_text').html('Total amount:-'+data.total_amount);
                $('#date').val(data.installment_date);
            }
        });
    }
}

$('#amount').keyup(function(){
    let total_amount = $('#total_amount').val();
    let amount = $('#amount').val();
    $('#due_amount').val(total_amount - amount);

});


</script>

@endsection
