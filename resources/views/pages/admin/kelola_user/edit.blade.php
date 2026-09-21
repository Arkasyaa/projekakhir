@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="max-w-6xl mx-auto px-4 lg:px-10 py-20">
    <h1 class="mb-4">Edit User</h1>

    <form action="{{ route('admin.kelola_user.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name">Nama</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="no_hp">Nomor HP</label>
            <input type="text" name="no_hp" id="no_hp" class="form-control" value="{{ old('no_hp', $user->no_hp) }}">
            @error('no_hp') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="alamat">Alamat</label>
            <textarea name="alamat" id="alamat" class="form-control">{{ old('alamat', $user->alamat) }}</textarea>
            @error('alamat') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('admin.kelola_user.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
