@extends('layouts.adminapp')

@section('content')
@if (count($errors) > 0)

@endif
{!! Form::open(array('route' => 'manage_complaint_template.store','method'=>'POST','enctype'=>'multipart/form-data')) !!}
@csrf
<div class="container">
    <div id="accordion">
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
                <button type="submit" class="btn btn_tile">Submit</button>
            </div>
        </div>
    </div>
</div>
  {!! Form::close() !!}
@endsection

@section('js-script')
<script>

</script>
@endsection
