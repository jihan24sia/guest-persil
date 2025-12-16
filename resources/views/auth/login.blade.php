@extends('auth.auth')

@section('title', 'Login')

@section('content')
<div class="login-glass">

    <div class="login-title">Login</div>

    @if ($errors->any())
        <div class="error-text">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="input-group">
            <input type="email" name="email" placeholder="Email" required>
            <i class="bi bi-person"></i>
        </div>

        <div class="input-group">
            <input type="password" name="password" id="password"
                   placeholder="Password" required>
            <i class="bi bi-lock" id="eye" onclick="togglePassword()"
               style="cursor:pointer"></i>
        </div>

        <div class="remember">
            <label>
                <input type="checkbox"> Remember me
            </label>
            <a href="#">Forgot password?</a>
        </div>

        <button class="btn-login">Login</button>
    </form>

</div>
@endsection
