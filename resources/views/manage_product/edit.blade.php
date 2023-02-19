@extends('layouts.adminapp')

@section('content')
@if (count($errors) > 0)

@endif
{!! Form::model($product, ['method' => 'PATCH','route' => ['manage_product.update', $product->id]]) !!}
@csrf
<div class="container">
    <div id="accordion">
        <div class="row mt-1">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                <div class="form-group">
                    <strong class="lab_space">Group <em class="text-danger">*</em></strong>
                    {!! Form::select('group_id', $group , null, ['class' => 'form-select','placeholder'=>'Please Select' ]) !!}
                    @error('group_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                <div class="form-group">
                    <strong class="lab_space">Brand <em class="text-danger">*</em></strong>
                    {!! Form::text('brand', null, array('placeholder' => 'Brand' ,'class' => 'form-control')) !!}
                    @error('brand')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                <div class="form-group">
                    <strong class="lab_space">Model <em class="text-danger">*</em></strong>
                    {!! Form::text('model', null, array('placeholder' => 'Model' ,'class' => 'form-control')) !!}
                    @error('model')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                <div class="form-group">
                    <strong class="lab_space">Product Code <em class="text-danger">*</em></strong>
                    {!! Form::text('product_code', null, array('placeholder' => 'Model' ,'class' => 'form-control')) !!}
                    @error('product_code')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                <div class="form-group">
                    <strong class="lab_space">Product Name <em class="text-danger">*</em></strong>
                    {!! Form::text('product_name', null, array('placeholder' => 'Product Name' ,'class' => 'form-control')) !!}
                    @error('product_name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                <div class="form-group">
                    <strong class="lab_space">MRP </strong>
                    {!! Form::text('mrp', 0, array('placeholder' => 'MRP' ,'class' => 'form-control')) !!}
                    @error('mrp')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                <div class="form-group">
                    <strong class="lab_space">Minimum Qty <em class="text-danger">*</em></strong>
                    {!! Form::text('min_qty', 1, array('placeholder' => 'Minimum Qty' ,'class' => 'form-control')) !!}
                    @error('min_qty')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                <div class="form-group">
                    <strong class="lab_space">Unit <em class="text-danger">*</em></strong>
                    {!! Form::select('unit', $unit , null, ['class' => 'form-select','placeholder'=>'Please Select' ]) !!}
                    @error('unit')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                <div class="form-group">
                    <strong class="lab_space">Opening Qty <em class="text-danger">*</em></strong>
                    {!! Form::text('opening_qty', 0, array('placeholder' => 'Opening Qty' ,'class' => 'form-control')) !!}
                    @error('opening_qty')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                <div class="form-group">
                    <strong class="lab_space">Product Description </strong>
                    {!! Form::textarea('description', null, array('placeholder' => 'Product Description' ,'class' => 'form-control','rows'=>'5','maxlength' => "400")) !!}
                    @error('description')
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
