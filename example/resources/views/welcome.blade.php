<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول عبر Google</title>
</head>
<body>
    <h1>مرحبا بك في موقعنا</h1>

    @if(Auth::check())
        <p>مرحبا، {{ Auth::user()->name }}</p>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">تسجيل الخروج</button>
        </form>
    @else
        <a href="{{ url('login/google') }}">تسجيل الدخول باستخدام Google</a>
    @endif
</body>
</html>
