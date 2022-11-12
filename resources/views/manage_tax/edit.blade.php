@extends('layouts.adminapp')

@section('content')
@if (count($errors) > 0)

@endif
{!! Form::model($manageTax, ['method' => 'PATCH','route' => ['manage_tax.update', $manageTax->id]]) !!}
@csrf
<div class="container">
    <div id="accordion">
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
                    {!! Form::text('tax_percentage_1', null, array('placeholder' => 'Tax Percentage 1' ,'class' => 'form-control')) !!}
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
                    {!! Form::text('tax_percentage_2', null, array('placeholder' => 'Tax Percentage 2' ,'class' => 'form-control')) !!}
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
                    {!! Form::text('tax_percentage_3', null, array('placeholder' => 'Tax Percentage 3' ,'class' => 'form-control')) !!}
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
                    {!! Form::text('tax_percentage_4', null, array('placeholder' => 'Tax Percentage 4' ,'class' => 'form-control')) !!}
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
                    {!! Form::text('tax_percentage_5', null, array('placeholder' => 'Tax Percentage 5' ,'class' => 'form-control')) !!}
                    @error('tax_percentage_5')
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
  {!! Form::close() !!}
@endsection

@section('js-script')
<script>

</script>
@endsection
