@extends('layouts.adminapp')
@section('content')
<!-- PAGE-HEADER -->
<div class="page-header d-flex align-items-center justify-content-between border-bottom mb-4">
    <h1 class="page-title">Manage Tax</h1>
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
                    {!! Form::open(array('route' => 'manage_tax.store','method'=>'POST','enctype'=>'multipart/form-data')) !!}
                    @csrf
                    <div class="row mt-1">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <strong class="lab_space">Profile Name <em class="text-danger">*</em></strong>
                                {!! Form::text('profile_name', null, array('placeholder' => 'Profile name' ,'class' => 'form-control')) !!}
                                @error('profile_name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <strong class="lab_space">Tax Lable Name <em class="text-danger">*</em></strong>
                                {!! Form::text('tax_lable_name', null, array('placeholder' => 'Tax Lable name' ,'class' => 'form-control')) !!}
                                @error('tax_lable_name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <strong class="lab_space">Tax Caption 1 <em class="text-danger">*</em></strong>
                                {!! Form::text('tax_caption_1', null, array('placeholder' => 'Tax Caption 1' ,'class' => 'form-control')) !!}
                                @error('tax_caption_1')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <strong class="lab_space">Tax Percentage 1 <em class="text-danger">*</em></strong>
                                {!! Form::text('tax_percentage_1', 0.00, array('placeholder' => 'Tax Percentage 1' ,'class' => 'form-control')) !!}
                                @error('tax_percentage_1')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <strong class="lab_space">Tax Caption 2</strong>
                                {!! Form::text('tax_caption_2', null, array('placeholder' => 'Tax Caption 2' ,'class' => 'form-control')) !!}
                                @error('tax_caption_2')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <strong class="lab_space">Tax Percentage 2</strong>
                                {!! Form::text('tax_percentage_2', 0.00, array('placeholder' => 'Tax Percentage 2' ,'class' => 'form-control')) !!}
                                @error('tax_percentage_2')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <strong class="lab_space">Tax Caption 3</strong>
                                {!! Form::text('tax_caption_3', null, array('placeholder' => 'Tax Caption 3' ,'class' => 'form-control')) !!}
                                @error('tax_caption_3')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <strong class="lab_space">Tax Percentage 3</strong>
                                {!! Form::text('tax_percentage_3', 0.00, array('placeholder' => 'Tax Percentage 3' ,'class' => 'form-control')) !!}
                                @error('tax_percentage_3')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <strong class="lab_space">Tax Caption 4</strong>
                                {!! Form::text('tax_caption_4', null, array('placeholder' => 'Tax Caption 4' ,'class' => 'form-control')) !!}
                                @error('tax_caption_4')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <strong class="lab_space">Tax Percentage 4</strong>
                                {!! Form::text('tax_percentage_4', 0.00, array('placeholder' => 'Tax Percentage 4' ,'class' => 'form-control')) !!}
                                @error('tax_percentage_4')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <strong class="lab_space">Tax Caption 5</strong>
                                {!! Form::text('tax_caption_5', null, array('placeholder' => 'Tax Caption 5' ,'class' => 'form-control')) !!}
                                @error('tax_caption_5')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <strong class="lab_space">Tax Percentage 5</strong>
                                {!! Form::text('tax_percentage_5', 0.00, array('placeholder' => 'Tax Percentage 5' ,'class' => 'form-control')) !!}
                                @error('tax_percentage_5')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
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
                $('#due_amount').val(data);
                $('#total_amount').val(data);
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
