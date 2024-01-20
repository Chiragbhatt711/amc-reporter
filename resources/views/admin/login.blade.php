@extends('layouts.app')
<style>
/* body{background: linear-gradient(#141e30, #243b55);} */
</style>
@section('content')
<div class="container-lg">
    <div class="row justify-content-center mt-4 mx-0">
        <div class="col-xl-4 col-lg-6">
            <div class="card shadow-none">
                <div class="card-body p-sm-6">
                    <div class="text-center mb-4">
                        <h4 class="mb-1">Admin Login</h4>
                        {{-- <p>Sign in to your account to continue.</p> --}}
                    </div>
                    <form method="POST" action="{{ route('admin.login_check') }}">
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
                            </div>
                            @if (count($errors) > 0)
                                @foreach ($errors->all() as $error)
                                    <div class="text-danger error">{{ $error }}</div>
                                @endforeach
                            @endif
                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
