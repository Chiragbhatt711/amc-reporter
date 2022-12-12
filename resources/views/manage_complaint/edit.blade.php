@extends('layouts.adminapp')

@section('content')
@if (count($errors) > 0)

@endif
{!! Form::model($data, ['method' => 'PATCH','route' => ['manage_complaint.update', $data->id]]) !!}
@csrf
<div class="container">
    <div id="accordion">
            <div class="row mt-1">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                    <div class="form-group">
                    <strong class="amc_no">Party/AMC<em class="text-danger">*</em></strong>
                    {!! Form::select('amc_no', $amc , null, ['class' => 'form-select','id'=>'amc_no','placeholder'=>'Please Select' ]) !!}
                    @error('amc_no')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                    <div class="form-group">
                    <strong class="product_id">Product<em class="text-danger">*</em></strong>
                    {!! Form::select('product_id', array() , null, ['class' => 'form-select','id'=>'product_id' ]) !!}
                    @error('product_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                    <div class="form-group">
                    <strong class="complaint_by">Complaint By<em class="text-danger">*</em></strong>
                    {!! Form::select('complaint_by', $parties , null, ['class' => 'form-select','id'=>'complaint_by','placeholder'=>'Please Select' ]) !!}
                    @error('complaint_by')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                    <div class="form-group">
                        <strong class="comp_by_mobile_number">Comp.by Contact No<em class="text-danger">*</em></strong>
                        {!! Form::text('comp_by_mobile_number', null, array('placeholder' => 'Comp.by Contact No' ,'class' => 'form-control')) !!}
                        @error('comp_by_mobile_number')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                    <div class="form-group">
                    <strong class="complaint_id">Complaint<em class="text-danger">*</em></strong>
                    {!! Form::select('complaint_id', $complaint , null, ['class' => 'form-select','id'=>'complaint_id','placeholder'=>'Please Select' ]) !!}
                    @error('complaint_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                    <div class="form-group">
                        <strong class="description">Description<em class="text-danger">*</em></strong>
                        {!! Form::textarea('description', null, array('placeholder' => 'Comp.by Contact No' ,'class' => 'form-control')) !!}
                        @error('description')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                    <div class="form-group">
                    <strong class="priority">Priority<em class="text-danger">*</em></strong>
                    {!! Form::select('priority', ['High' => 'High','Medium' => 'Medium','Low' => 'Low'] , null, ['class' => 'form-select','id'=>'priority','placeholder'=>'Please Select' ]) !!}
                    @error('priority')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                    <div class="form-group">
                        <label for="handover">
                            Handover Complaint
                            {!! Form::checkbox('handover',1 , null, ['class' => 'form-check','id'=>'handover' ]) !!}
                        </label>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4" style="display: none" id="handover_to_div">
                    <div class="form-group">
                    <strong class="handover_to">Handover To<em class="text-danger">*</em></strong>
                    {!! Form::select('handover_to', $executive , null, ['class' => 'form-select','id'=>'handover_to','placeholder'=>'Please Select' ]) !!}
                    @error('handover_to')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4" style="display: none" id="handover_date_div">
                    <div class="form-group">
                        <strong class="handover_date">Handover date<em class="text-danger">*</em></strong>
                        {!! Form::text('handover_date', null, array('placeholder' => 'Handover date' ,'class' => 'form-control datepicker')) !!}
                        @error('handover_date')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn_tile">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>
  {!! Form::close() !!}
  @endsection

  @section('js-script')
  <script>
    $(document).ready(function(){
        $('#handover').trigger('change');
        $('#amc_no').trigger('change');
    });
    $('#handover').change(function(){
        if($('#handover').prop('checked')==true)
        {
            $('#handover_to_div').show();
            $('#handover_date_div').show();
        }
        else
        {
            $('#handover_to_div').hide();
            $('#handover_date_div').hide();
        }

    });

    $('#amc_no').change(function(){
        var amc_no = $('#amc_no').val();
        var product_id = "{{ $data->product_id }}";
        $.ajax({
              url:"{{ route('get_amc_party') }}",
              type:'POST',
              data:{ '_token' : '<?php echo csrf_token() ?>',
                      amc_no:amc_no,
              },
              success:function(data) {
                // console.log(data);
                data = JSON.parse(data);
                  let html ="<option value=''>Please select</option>";
                  $.each(data, function(key, value){
                      var selected = "";
                      if(product_id == value.id)
                      {
                        selected = 'selected';
                      }
                      html += "<option value='"+value.id+"' "+selected+" >"+value.product_name+"</option>";
                  })
                  $("#product_id").html(html);
              }
            });
    });
  </script>
  @endsection
