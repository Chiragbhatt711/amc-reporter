@extends('layouts.adminapp')
@section('content')
<!-- PAGE-HEADER -->
<div class="page-header d-flex align-items-center justify-content-between border-bottom mb-4">
    <h1 class="page-title">Manage Complaint Template</h1>
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
                        Edit
                    </div>
                </div>
                <div class="card-body">
                    {!! Form::model($complaintTemplate, ['method' => 'PATCH','route' => ['manage_complaint_template.update', $complaintTemplate->id]]) !!}
                    @csrf
                        <div class="row mt-1">
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                                <div class="form-group">
                                    <strong class="lab_space">Title  <em class="text-danger">*</em></strong>
                                    {!! Form::text('title', null, array('placeholder' => 'Title' ,'class' => 'form-control')) !!}
                                    @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                                <div class="form-group">
                                    <strong class="lab_space">Description </strong>
                                    {!! Form::textarea('description', null, array('placeholder' => 'DescriptionTitle' ,'class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                                <strong class="lab_space">Priority<em class="text-danger">*</em></strong>
                                {!! Form::select('priority', array('High'=>'High','Medium'=>'Medium','Low'=>'Low') , null, ['class' => 'form-select','placeholder' =>'Please Select','id'=>'priority' ]) !!}
                                @error('priority')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
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
