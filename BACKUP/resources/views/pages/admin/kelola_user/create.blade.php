@extends('layouts.app')

@section('title', 'Tambah User Baru')

@section('content')
<div class="max-w-6xl mx-auto px-4 lg:px-10 py-20">
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

        <div class="mb-3">
            <label for="name">Nama</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="no_hp">Nomor HP</label>
            <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp') }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="alamat">Alamat</label>
            <textarea name="alamat" id="alamat" class="form-control" required>{{ old('alamat') }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.kelola_user.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
