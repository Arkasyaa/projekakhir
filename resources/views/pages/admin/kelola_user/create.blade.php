@extends('layouts.app')

@section('title', 'Tambah User Baru')

@section('content')

    <h1>Tambah User Baru</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.kelola_user.store') }}" method="POST">
        @csrf

        <div>
            <label for="name">Nama</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}">
        </div>

        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}">
        </div>

        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
        </div>

        <div>
            <label for="no_hp">Nomor HP</label>
            <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp') }}">
        </div>

        <div>
            <label for="alamat">Alamat</label>
            <textarea name="alamat" id="alamat">{{ old('alamat') }}</textarea>
        </div>

        <div>
            <button type="submit">Simpan</button>
            <a href="{{ route('admin.kelola_user.index') }}">Batal</a>
        </div>
    </form>
@endsection
