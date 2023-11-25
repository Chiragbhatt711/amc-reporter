@extends('layouts.adminapp')
@section('content')
<!-- PAGE-HEADER -->
<div class="page-header d-flex align-items-center justify-content-between border-bottom mb-4">
    <h1 class="page-title">Manage Party</h1>
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
                    {!! Form::open(array('route' => 'manage_party.store','method'=>'POST','enctype'=>'multipart/form-data')) !!}
                    @csrf
                    <div class="row mt-1">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <strong class="lab_space">party name  <em class="text-danger">*</em></strong>
                                {!! Form::text('party_name', null, array('placeholder' => 'Party name' ,'class' => 'form-control')) !!}
                                @error('party_name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <strong class="lab_space">Contact person name  <em class="text-danger">*</em></strong>
                                {!! Form::text('contact_person_name', null, array('placeholder' => 'Contact person name' ,'class' => 'form-control')) !!}
                                @error('contact_person_name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <strong class="lab_space">Address  <em class="text-danger">*</em></strong>
                                {!! Form::textarea('address', null, array('placeholder' => 'Address' ,'class' => 'form-control','rows'=>'5','maxlength' => "400")) !!}
                                @error('address')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <strong class="lab_space">City  <em class="text-danger">*</em></strong>
                                {!! Form::text('city', null, array('placeholder' => 'City' ,'class' => 'form-control')) !!}
                                @error('city')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <strong class="lab_space">State  <em class="text-danger">*</em></strong>
                                {!! Form::text('state', null, array('placeholder' => 'State' ,'class' => 'form-control')) !!}
                                @error('state')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <strong class="lab_space">Country  <em class="text-danger">*</em></strong>
                                {!! Form::text('country', null, array('placeholder' => 'Country' ,'class' => 'form-control')) !!}
                                @error('country')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <strong class="lab_space">Pincode  <em class="text-danger">*</em></strong>
                                {!! Form::text('pincode', null, array('placeholder' => 'Pincode' ,'class' => 'form-control')) !!}
                                @error('pincode')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <strong class="lab_space">Mobile no  <em class="text-danger">*</em></strong>
                                {!! Form::text('mobile_no', null, array('placeholder' => 'Mobile no' ,'class' => 'form-control')) !!}
                                @error('mobile_no')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <strong class="lab_space">Phone no </strong>
                                {!! Form::text('phone_no', null, array('placeholder' => 'Phone no' ,'class' => 'form-control')) !!}
                                @error('phone_no')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <strong class="lab_space">E-mail  <em class="text-danger">*</em></strong>
                                {!! Form::text('email', null, array('placeholder' => 'E-mail' ,'class' => 'form-control')) !!}
                                @error('email')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <strong class="lab_space">Opening Balance</strong>
                                {!! Form::text('opening_balance', null, array('placeholder' => 'Opening Balance' ,'class' => 'form-control')) !!}
                                @error('opening_balance')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <strong class="lab_space">extf1</strong>
                                {!! Form::text('extf_1', null, array('placeholder' => 'extf1' ,'class' => 'form-control')) !!}
                                @error('extf_1')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <strong class="lab_space">extf2</strong>
                                {!! Form::text('extf_2', null, array('placeholder' => 'extf2' ,'class' => 'form-control')) !!}
                                @error('extf_2')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <strong class="lab_space">extf3</strong>
                                {!! Form::text('extf_3', null, array('placeholder' => 'extf3' ,'class' => 'form-control')) !!}
                                @error('extf_3')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <strong class="lab_space">extf4</strong>
                                {!! Form::text('extf_4', null, array('placeholder' => 'extf4' ,'class' => 'form-control')) !!}
                                @error('extf_4')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <strong class="lab_space">extf5</strong>
                                {!! Form::text('extf_5', null, array('placeholder' => 'extf5' ,'class' => 'form-control')) !!}
                                @error('extf_5')
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
