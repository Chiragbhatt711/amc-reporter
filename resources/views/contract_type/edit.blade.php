@extends('layouts.adminapp')

@section('content')
@if (count($errors) > 0)

@endif
<input type="hidden" id="brand_url" value="{{ route('add_brand') }}">
<input type="hidden" id="model_url" value="{{ route('add_model') }}">
<input type="hidden" id="group_url" value="{{ route('add_group') }}">
{!! Form::model($contractType, ['method' => 'PATCH','route' => ['contract_type.update', $contractType->id]]) !!}
@csrf
<div class="container">
    <div id="accordion">
        <div class="row mt-1">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                <div class="form-group">
                    <strong class="lab_space">Group<em class="text-danger">*</em></strong>
                    <div class="d-flex">
                        {!! Form::select('group', $group , null, ['class' => 'form-select','placeholder' =>'Please Select','id'=>'group' ]) !!}
                        <span class="form_sub_btn">
                          <i title="add group" class="fa fa-plus" aria-hidden="true" id="addGroup" data-bs-toggle="modal" data-bs-target="#groupModal"></i>
                        </span>
                    </div>
                    @error('group')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                <div class="form-group">
                    <strong class="lab_space">Brand</strong>
                    <div class="d-flex">
                        {!! Form::select('brand', $brand , null, ['class' => 'form-select','placeholder' =>'Please Select','id'=>'brand' ]) !!}
                        <span class="form_sub_btn">
                          <i title="add brand" class="fa fa-plus" aria-hidden="true" id="addBrand" data-bs-toggle="modal" data-bs-target="#brandModal"></i>
                        </span>
                    </div>
                    @error('brand')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                <div class="form-group">
                    <strong class="lab_space">Model</strong>
                    <div class="d-flex">
                        {!! Form::select('model', $model , null, ['class' => 'form-select','placeholder' =>'Please Select','id'=>'model' ]) !!}
                        <span class="form_sub_btn">
                          <i title="add model" class="fa fa-plus" aria-hidden="true" id="addModel" data-bs-toggle="modal" data-bs-target="#modelModal"></i>
                        </span>
                    </div>
                    @error('model')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                <div class="form-group">
                    <strong class="lab_space">Product Code  <em class="text-danger">*</em></strong>
                    {!! Form::text('product_code', null, array('placeholder' => 'Product Code' ,'class' => 'form-control')) !!}
                    @error('product_code')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                <div class="form-group">
                    <strong class="lab_space">Product Name  <em class="text-danger">*</em></strong>
                    {!! Form::text('product_name', null, array('placeholder' => 'Product Name' ,'class' => 'form-control')) !!}
                    @error('product_name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                <div class="form-group">
                    <strong class="lab_space">Product Description <em class="text-danger">*</em></strong>
                    {!! Form::textarea('product_description', null, array('placeholder' => 'Product Description' ,'class' => 'form-control','rows'=>'5','maxlength' => "400")) !!}
                    @error('product_description')
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

  {{-- Group Modal --}}
  <div class="modal fade" id="groupModal" tabindex="-1" aria-labelledby="groupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="groupModalLabel">Add Group</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label class="lab_space"> Group </label>
                <input class="form-control" type="text" name="group" id="add_group">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="add_group();">Submit</button>
        </div>
      </div>
    </div>
  </div>

  {{-- Brand Modal --}}
  <div class="modal fade" id="brandModal" tabindex="-1" aria-labelledby="brandModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="brandModalLabel">Add Brand</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label class="lab_space"> Brand </label>
                <input class="form-control" type="text" name="brand" id="add_brand">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="add_brand();">Submit</button>
        </div>
      </div>
    </div>
  </div>

  {{-- Model Modal --}}
  <div class="modal fade" id="modelModal" tabindex="-1" aria-labelledby="modelModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modelModalLabel">Add Model</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label class="lab_space"> Model </label>
                <input class="form-control" type="text" name="model" id="add_model">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="add_model();">Submit</button>
        </div>
      </div>
    </div>
  </div>
  @endsection

  @section('js-script')
  <script>

  </script>
  @endsection
