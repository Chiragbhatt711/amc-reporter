@extends('layouts.app')
<style>
    body{background: linear-gradient(#141e30, #243b55);}
</style>
@section('content')
<div class="login-box">
    <h2>Register</h2>
    <form method="POST" action="{{ route('register_post') }}">
        @csrf
        <div class="user-box">
          <input type="text" name="first_name">
          <label>First Name</label>
        </div>
        <div class="user-box">
            <input type="text" name="last_name">
            <label>Last Name</label>
        </div>
        <div class="user-box">
            <input type="text" name="email">
            <label>Email</label>
        </div>
        <div class="user-box">
            <input type="tel" name="mobile_number">
            <label>Mobile Number</label>
        </div>
        <div class="user-box">
          <input type="password" name="password">
          <label>Password</label>
        </div>
        <div class="user-box">
          <input type="password" name="confirm_password">
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
@endsection
