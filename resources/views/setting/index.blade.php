@extends('layouts.adminapp')
@section('content')
<!-- PAGE-HEADER -->
<div class="page-header d-flex align-items-center justify-content-between border-bottom mb-4">
    <h1 class="page-title">General Settings</h1>
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
                        {{-- Create --}}
                    </div>
                </div>
                <div class="card-body">
                    @if (isset($setting) && $setting)
                        {!! Form::model($setting, ['method' => 'PATCH','route' => ['setting.update', $setting->id],'enctype'=>'multipart/form-data']) !!}
                    @else
                        {!! Form::open(array('route' => 'setting.store','method'=>'POST','enctype'=>'multipart/form-data')) !!}
                    @endif
                    @csrf
                        <div class="row mt-1">
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                                <div class="form-group">
                                    <strong class="lab_space">Upload Logo <em class="text-danger">*</em></strong>
                                    <input type="file" class="form-control" name="logo" id="">
                                    @error('logo')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    @if (isset($setting) && $setting->logo && File::exists(str_replace('\\', '/', base_path('public\logo_img/' . $setting->logo))))
                                        <div class="mt-3">
                                            <img style="height: 90px;" src="{{ asset('logo_img/' . $setting->logo) }}" alt="Logo">
                                        </div>
                                    @endif
                                </div>
                            </div>
                            {{-- <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                                <div class="form-group">
                                    <strong class="lab_space">License Key <em class="text-danger">*</em></strong>
                                    {!! Form::text('license_key', null, array('placeholder' => 'License Key' ,'class' => 'form-control')) !!}
                                    @error('license_key')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div> --}}
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
