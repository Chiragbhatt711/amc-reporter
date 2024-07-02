@extends('layouts.adminapp')
@section('content')
<!-- PAGE-HEADER -->
<div class="page-header d-flex align-items-center justify-content-between border-bottom mb-4">
    <h1 class="page-title">Manage Product</h1>
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
                    {!! Form::model($product, ['method' => 'PATCH','route' => ['manage_product.update', $product->id]]) !!}
                    @csrf
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
                                <strong class="lab_space">Brand</strong>
                                {!! Form::text('brand', null, array('placeholder' => 'Brand' ,'class' => 'form-control')) !!}
                                @error('brand')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <strong class="lab_space">Model</strong>
                                {!! Form::text('model', null, array('placeholder' => 'Model' ,'class' => 'form-control')) !!}
                                @error('model')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <strong class="lab_space">Product Code</strong>
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
                                <strong class="lab_space">Minimum Qty </strong>
                                {!! Form::text('min_qty', null, array('placeholder' => 'Minimum Qty' ,'class' => 'form-control')) !!}
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
                                {!! Form::text('opening_qty', null, array('placeholder' => 'Opening Qty' ,'class' => 'form-control')) !!}
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
