@extends('layouts.adminapp')

@section('content')
@if (count($errors) > 0)

@endif
{!! Form::open(array('route' => 'manage_executive.store','method'=>'POST','enctype'=>'multipart/form-data')) !!}
@csrf
<div class="container">
    <div id="accordion">
            <div class="row mt-1">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                    <div class="form-group">
                        <strong class="first_name">First Name<em class="text-danger">*</em></strong>
                        {!! Form::text('first_name', null, array('placeholder' => 'First Name' ,'class' => 'form-control')) !!}
                        @error('first_name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                    <div class="form-group">
                        <strong class="last_name">Last Name<em class="text-danger">*</em></strong>
                        {!! Form::text('last_name', null, array('placeholder' => 'Last Name' ,'class' => 'form-control')) !!}
                        @error('last_name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                    <div class="form-group">
                        <strong class="email">Email<em class="text-danger">*</em></strong>
                        {!! Form::text('email', null, array('placeholder' => 'Email' ,'class' => 'form-control')) !!}
                        @error('email')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                    <div class="form-group">
                        <strong class="mobile_number">Mobile No<em class="text-danger">*</em></strong>
                        {!! Form::text('mobile_number', null, array('placeholder' => 'Mobile No' ,'class' => 'form-control')) !!}
                        @error('mobile_number')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                    <div class="form-group">
                    <strong class="role_id">Role<em class="text-danger">*</em></strong>
                    {!! Form::select('role_id', $roles , null, ['class' => 'form-select','id'=>'role_id','readonly' ]) !!}
                    @error('role_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                    <div class="form-group">
                        <strong class="password">Password<em class="text-danger">*</em></strong>
                        {!! Form::text('password', null, array('placeholder' => 'Password' ,'class' => 'form-control')) !!}
                        @error('password')
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

  </script>
  @endsection
