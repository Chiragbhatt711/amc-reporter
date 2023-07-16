@extends('layouts.app')
<style>
    body{background: linear-gradient(#141e30, #243b55);}
</style>
@section('content')
<div class="box">
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
          {{-- <a href="#">
            <span></span>
            <span></span>
            <span></span>
            <span></span>


          </a> --}}
          <input type="submit" class="submit_btn" value="Register">
      </form>
  </div>
</div>
@endsection
