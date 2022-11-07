@extends('layouts.app')
<style>
body{background: linear-gradient(#141e30, #243b55);}
</style>
@section('content')
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
@endsection
