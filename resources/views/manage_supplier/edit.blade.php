@extends('layouts.adminapp')

@section('content')
@if (count($errors) > 0)

@endif
{!! Form::model($supplier, ['method' => 'PATCH','route' => ['manage_supplier.update', $supplier->id]]) !!}
@csrf
<div class="container">
    <div id="accordion">
        <div class="row mt-1">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                <div class="form-group">
                    <strong class="lab_space">Company Name <em class="text-danger">*</em></strong>
                    {!! Form::text('company_name', null, array('placeholder' => 'Company Name' ,'class' => 'form-control')) !!}
                    @error('company_name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                <div class="form-group">
                    <strong class="lab_space">Person Name <em class="text-danger">*</em></strong>
                    {!! Form::text('person_name', null, array('placeholder' => 'Person Name' ,'class' => 'form-control')) !!}
                    @error('person_name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                <div class="form-group">
                    <strong class="lab_space">Supplier Type <em class="text-danger">*</em></strong>
                    {!! Form::text('supplier_type', null, array('placeholder' => 'Supplier Type' ,'class' => 'form-control')) !!}
                    @error('supplier_type')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                <div class="form-group">
                    <strong class="lab_space">Address <em class="text-danger">*</em></strong>
                    {!! Form::textarea('address',null, array('placeholder' => 'Address' ,'class' => 'form-control')) !!}
                    @error('address')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                <div class="form-group">
                    <strong class="lab_space">City <em class="text-danger">*</em></strong>
                    {!! Form::text('city', null, array('placeholder' => 'City' ,'class' => 'form-control')) !!}
                    @error('city')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                <div class="form-group">
                    <strong class="lab_space">State <em class="text-danger">*</em></strong>
                    {!! Form::text('state',null, array('placeholder' => 'State' ,'class' => 'form-control')) !!}
                    @error('state')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                <div class="form-group">
                    <strong class="lab_space">Country <em class="text-danger">*</em></strong>
                    {!! Form::text('country', null, array('placeholder' => 'Country' ,'class' => 'form-control')) !!}
                    @error('country')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                <div class="form-group">
                    <strong class="lab_space">Pincode <em class="text-danger">*</em></strong>
                    {!! Form::text('pincode', null, array('placeholder' => 'Pincode' ,'class' => 'form-control')) !!}
                    @error('pincode')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                <div class="form-group">
                    <strong class="lab_space">Phone No <em class="text-danger">*</em></strong>
                    {!! Form::text('phone_no', null, array('placeholder' => 'Phone No' ,'class' => 'form-control')) !!}
                    @error('phone_no')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                <div class="form-group">
                    <strong class="lab_space">E-mail <em class="text-danger">*</em></strong>
                    {!! Form::text('e_mail', null, array('placeholder' => 'E-mail' ,'class' => 'form-control')) !!}
                    @error('e_mail')
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
