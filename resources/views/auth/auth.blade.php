<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Login')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(180deg, #ff7f00, #000001);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        /* background stars */
        body::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url('https://www.transparenttextures.com/patterns/stardust.png');
            opacity: .25;
        }

        .login-glass {
            position: relative;
            width: 420px;
            padding: 40px;
            border-radius: 18px;
            background: rgba(255,255,255,.15);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border: 1px solid rgba(255,255,255,.25);
            box-shadow: 0 25px 50px rgba(0,0,0,.35);
            animation: fadeUp .7s ease;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(25px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .login-title {
            color: #fff;
            text-align: center;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 25px;
        }

        .input-group {
            position: relative;
            margin-bottom: 18px;
        }

        .input-group input {
            width: 100%;
            padding: 14px 45px 14px 15px;
            border-radius: 30px;
            border: none;
            outline: none;
            background: rgba(255,255,255,.25);
            color: #fff;
            font-size: 15px;
        }

        .input-group input::placeholder {
            color: rgba(255,255,255,.7);
        }

        .input-group i {
            position: absolute;
            right: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #fff;
            font-size: 18px;
        }

        .remember {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            color: #fff;
            margin-bottom: 22px;
        }

        .remember a {
            color: #fff;
            text-decoration: none;
            opacity: .85;
        }

        .remember a:hover {
            text-decoration: underline;
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            border-radius: 30px;
            border: none;
            background: #fff;
            color: #ff7f00;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: .3s;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255,255,255,.35);
        }

        .error-text {
            color: #ffb3b3;
            text-align: center;
            font-size: 14px;
            margin-bottom: 12px;
        }
    </style>
</head>
<body>

    @yield('content')

    {{-- JS --}}
    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('eye');

            if (input.type === "password") {
                input.type = "text";
                icon.classList.replace('bi-lock', 'bi-unlock');
            } else {
                input.type = "password";
                icon.classList.replace('bi-unlock', 'bi-lock');
            }
        }
    </script>

</body>
</html>
