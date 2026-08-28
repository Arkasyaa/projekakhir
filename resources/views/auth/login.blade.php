<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
    <section class="hero">
    <div class="absolute inset-0">
    
    <h1>Login</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @if ($errors->any())
        <p>{{ $errors->first() }}</p>
    @endif

    <form method="POST" action="{{ route('login.post') }}">
        @csrf

        <div>
            <label for="email">Email</label><br>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
        </div>

        <div>
            <label for="password">Password</label><br>
            <input type="password" id="password" name="password" required>
        </div>

        <div>
            <label>
                <input type="checkbox" name="remember">
                Ingat saya
            </label>
        </div>
    </section>
        <button type="submit">Login</button>
    </form>
    
</body>

</html>

{{-- <h1>login</h1>
<form action="{{ route('login') }}" method="POST">
    @csrf
    <input t ype="email" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="Password">
    <button>login</button>
</form> --}}
