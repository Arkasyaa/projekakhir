@extends('layouts.app')

@section('title', 'Edit User')

@section('content')

    <h1>Edit User</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.kelola_user.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="name">Nama</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}">
        </div>

        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}">
        </div>

        <div>
            <label for="no_hp">Nomor HP</label>
            <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp', $user->no_hp) }}">
        </div>

        <div>
            <label for="alamat">Alamat</label>
            <textarea name="alamat" id="alamat">{{ old('alamat', $user->alamat) }}</textarea>
        </div>

        <div>
            <button type="submit">Simpan Perubahan</button>
            <a href="{{ route('admin.kelola_user.index') }}">Batal</a>
        </div>
    </form>

@endsection
