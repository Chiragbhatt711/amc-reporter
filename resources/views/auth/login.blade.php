@extends('layouts.app')
<style>
/* body{background: linear-gradient(#141e30, #243b55);} */
</style>
@section('content')
{{-- <div class="box">
  <div class="login-box">
      <h2>Login</h2>
      <form method="POST" action="{{ route('login') }}">
          @csrf
          <div class="user-box">
            <input type="text" name="email">
            <label>Email</label>
          </div>
          <div class="user-box">
            <input type="password" name="password">
            <label>Password</label>
          </div>
          <input type="submit" class="submit_btn" value="Login">
      </form>
      @if (count($errors) > 0)
          @foreach ($errors->all() as $error)
              <div class="text-danger error">{{ $error }}</div>
          @endforeach
      @endif
  </div>
</div> --}}

<div class="container-lg">
    <div class="row justify-content-center mt-4 mx-0">
        <div class="col-xl-4 col-lg-6">
            <div class="card shadow-none">
                <div class="card-body p-sm-6">
                    <div class="text-center mb-4">
                        <h4 class="mb-1">Sign In</h4>
                        <p>Sign in to your account to continue.</p>
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label class="mb-2 fw-500">Email<span class="text-danger ms-1">*</span></label>
                                <input class="form-control ms-0" name="email" type="email" placeholder="Enter your Email">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label class="mb-2 fw-500">Password<span class="text-danger ms-1">*</span></label>
                                <div >
                                    <input type="password" name="password" class="form-control" id="input-password" placeholder="Password">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <div class="d-flex mb-3">
                                {{-- <div class="form-check d-flex align-items-center">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label tx-15" for="flexCheckDefault">
                                        Remember me
                                    </label>
                                </div>
                                <div class="ms-auto">
                                    <a href="forgot-password.html" class="tx-primary ms-1 tx-13">Forgot Password?</a>
                                </div> --}}
                            </div>
                            @if (count($errors) > 0)
                                @foreach ($errors->all() as $error)
                                    <div class="text-danger error">{{ $error }}</div>
                                @endforeach
                            @endif
                            <div class="d-grid mb-3">
                                {{-- <a href="index.html" class="btn btn-primary"> Login</a> --}}
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                            <div class="text-center">
                                <p class="mb-0 tx-14">Don't have an account yet?
                                    <a href="{{ route('register') }}" class="tx-primary ms-1 text-decoration-underline">Sign Up</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    </form>
                    {{-- <p class="text-center mt-3 mb-2">Signin with</p>
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
    </div>
</div>






{{-- <div class="container-lg">
    <div class="row justify-content-center mt-4 mx-0">
        <div class="col-xl-4 col-lg-6">
            <div class="card shadow-none">
                <div class="card-body p-sm-6">
                    <div class="text-center mb-4">
                        <h4 class="mb-1">Sign In</h4>
                        <p>Sign in to your account to continue.</p>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label class="mb-2 fw-500">Email<span class="text-danger ms-1">*</span></label>
                                <input class="form-control ms-0" type="email" placeholder="Enter your Email">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label class="mb-2 fw-500">Password<span class="text-danger ms-1">*</span></label>
                                <div >
                                    <input type="password" class="form-control" id="input-password" placeholder="Password">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <div class="d-flex mb-3">
                                <div class="form-check d-flex align-items-center">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label tx-15" for="flexCheckDefault">
                                        Remember me
                                    </label>
                                </div>
                                <div class="ms-auto">
                                    <a href="forgot-password.html" class="tx-primary ms-1 tx-13">Forgot Password?</a>
                                </div>
                            </div>
                            <div class="d-grid mb-3">
                                <a href="index.html" class="btn btn-primary"> Login</a>
                            </div>
                            <div class="text-center">
                                <p class="mb-0 tx-14">Don't have an account yet?
                                    <a href="register.html" class="tx-primary ms-1 text-decoration-underline">Sign Up</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <p class="text-center mt-3 mb-2">Signin with</p>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
