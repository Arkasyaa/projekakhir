<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
</head>
<body>
    <h1>Register</h1>

<<<<<<< HEAD
<h1>Register</h1>
<form action="{{ route('register') }}" method="POST">
    @csrf
    <input type="text" name="name" placeholder="Nama"><br>
    <input type="email" name="email" placeholder="Email"><br>
    <input type="password" name="password" placeholder="Password"><br>
    <button>buat akun</button>
</form>
=======
    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <form method="POST" action="{{ route('register.post') }}">
        @csrf

        <div>
            <label for="name">Nama</label><br>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required>
            @error('name')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email">Email</label><br>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password">Password</label><br>
            <input type="password" id="password" name="password" required>
            @error('password')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <button type="submit">Buat Akun</button>
    </form>
</body>
</html>


{{-- <h1>Zans Outdoor.</h1>
<form action="{{ route('register') }}" method="POST">
@csrf
<input type="text" name="name" placeholder="Nama">
<input type="email" name="email" placeholder="Email">
<input type="password" name="password" placeholder="Password">
<button>buat akun</button> --}}


>>>>>>> 3d7ad5e5ae32ed8ea3711bb1500a395067167db4
