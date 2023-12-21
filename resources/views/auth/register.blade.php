@extends('layouts.app')
<style>
    /* body{background: linear-gradient(#141e30, #243b55);} */
</style>
@section('content')
{{-- <div class="box">
  <div class="login-box">
      <h2>Register</h2>
      <form method="POST" action="{{ route('register_post') }}">
          @csrf
          <div class="user-box">
            {!! Form::text('first_name', null, []) !!}
            @error('first_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <label>First Name</label>
          </div>
          <div class="user-box">
            {!! Form::text('last_name', null, []) !!}
            @error('last_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
              <label>Last Name</label>
          </div>
          <div class="user-box">
                {!! Form::text('email', null, []) !!}
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
              <label>Email</label>
          </div>
          <div class="user-box">
                {!! Form::text('mobile_number', null, []) !!}
                @error('mobile_number')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
              <label>Mobile Number</label>
          </div>
          <div class="user-box">
            <input type="password" name="password">
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <label>Password</label>
          </div>
          <div class="user-box">
            <input type="password" name="confirm_password">
            @error('confirm_password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <label>Confirm Password</label>
          </div>
          <input type="submit" class="submit_btn" value="Register">
      </form>
  </div>
</div> --}}

<div class="container-lg">
    <div class="row mt-4 justify-content-center mx-0">
        <div class="col-xl-4 col-lg-6">
            <div class="card shadow-none">
                <div class="card-body p-sm-6">
                    <div class="text-center mb-4">
                        <h4 class="mb-1">Sign Up</h4>
                        <p>Sign up to your account to continue.</p>
                    </div>
                    <form method="POST" action="{{ route('register_post') }}">
                    @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <label class="mb-2 fw-500">First Name<span class="text-danger ms-1">*</span></label>
                                    {!! Form::text('first_name', null, ["class"=>"form-control ms-0","placeholder"=>"Enter First Name"]) !!}
                                    @error('first_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <label class="mb-2 fw-500">Last Name<span class="text-danger ms-1">*</span></label>
                                    {!! Form::text('last_name', null, ["class"=>"form-control ms-0","placeholder"=>"Enter Last Name"]) !!}
                                    @error('last_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <label class="mb-2 fw-500">Email<span class="text-danger ms-1">*</span></label>
                                    <input class="form-control ms-0" value="{{ old('email') }}" name="email" type="email" placeholder="Enter your Email">
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <label class="mb-2 fw-500">Mobile Number<span class="text-danger ms-1">*</span></label>
                                    {!! Form::text('mobile_number', null, ["class"=>"form-control ms-0","placeholder"=>"Enter Mobile Number"]) !!}
                                    @error('mobile_number')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <label class="mb-2 fw-500">Create a Password<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group has-validation">
                                        <input type="password" class="form-control ms-0 border-end-0" placeholder="Create a Password"  id="signup-password"
                                            required>
                                        <button class="btn btn-light" onclick="createpassword('signup-password',this)" type="button" id="button-addon2"><i class="ri-eye-off-line align-middle"></i></button>
                                        <div class="invalid-feedback">
                                            Please choose a username.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-sm-12">
                                <div class="mb-3">
                                    <label class="mb-2 fw-500">Confirm Password<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group has-validation">
                                        <input type="password" class="form-control ms-0 border-end-0" placeholder="Confirm your Password" id="signup-confirmpassword"
                                            required>
                                            <button class="btn btn-light" onclick="createpassword('signup-confirmpassword',this)" type="button" id="button-addon21"><i class="ri-eye-off-line align-middle"></i></button>
                                        <div class="invalid-feedback">
                                            Please choose a username.
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="col-xl-12">
                                {{-- <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                                    <label class="form-check-label tx-15" for="flexCheckChecked">
                                        Remember me
                                    </label>
                                    </div> --}}
                                <div class="d-grid mb-3">
                                    {{-- <a href="index.html" class="btn btn-primary"> Create an Account</a> --}}
                                    <button type="submit" class="btn btn-primary"> Create an Account</button>
                                </div>
                                <div class="text-center">
                                    <p class="mb-0 tx-14">Already have an account ?
                                        <a href="{{ route('login') }}" class="tx-primary ms-1 text-decoration-underline">Login</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </form>
                    {{-- <p class="text-center mt-3 mb-2">Signup with</p>
                    <div class="d-flex justify-content-center">
                        <div class="btn-list">
                            <button class="btn btn-icon bg-primary-transparent rounded-pill border-0" type="button">
                                <span class="btn-inner--icon"><i class="fa fa-facebook-f"></i></span>
                            </button>
                            <button class="btn btn-icon bg-primary-transparent rounded-pill border-0" type="button">
                                    <span class="btn-inner--icon"><i class="fa fa-google"></i></span>
                                </button>
                            <button class="btn btn-icon bg-primary-transparent rounded-pill border-0" type="button">
                                    <span class="btn-inner--icon"><i class="fa fa-twitter"></i></span>
                                </button>
                            <button class="btn btn-icon bg-primary-transparent rounded-pill border-0" type="button">
                                    <span class="btn-inner--icon"><i class="fa fa-linkedin"></i></span>
                            </button>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="col-xl-9 d-none"></div>
    </div>
</div>
@endsection
