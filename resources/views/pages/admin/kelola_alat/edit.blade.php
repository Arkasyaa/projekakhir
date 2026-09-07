@extends('layouts.app')

@section('title', 'Edit Alat')

@section('content')
<div class="max-w-6xl mx-auto px-4 lg:px-10 py-20">
    <h1 class="mb-4">Edit Alat</h1>
    
    <form action="{{ route('admin.alat.update', $alat->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Alat</label>
            <input type="text" name="nama_alat" class="form-control" value="{{ old('nama_alat', $alat->nama_alat) }}" required>
            @error('nama_alat') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Foto Sekarang</label><br>
            @if($alat->foto)
                <img src="{{ asset('storage/images_alat/' . $alat->foto) }}" alt="{{ $alat->nama_alat }}" class="img-thumbnail mb-2" style="width: 150px; height: 150px; object-fit: cover;">
            @else
                <p class="text-muted">Belum ada foto</p>
            @endif
        </div>
        <div class="mb-3">
            <label>Ganti Foto</label>
            <input type="file" name="foto" class="form-control">
            @error('foto') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Kategori</label>
            <input type="text" name="kategori" class="form-control" value="{{ old('kategori', $alat->kategori) }}" required>
            @error('kategori') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" value="{{ old('harga', $alat->harga) }}" required>
            @error('harga') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Stok</label>
            <input type="number" name="stok" class="form-control" value="{{ old('stok', $alat->stok) }}" required>
            @error('stok') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="tersedia" {{ old('status', $alat->status) == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                <option value="habis" {{ old('status', $alat->status) == 'habis' ? 'selected' : '' }}>Habis</option>
                <option value="rusak" {{ old('status', $alat->status) == 'rusak' ? 'selected' : '' }}>Rusak</option>
            </select>
            @error('status') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('admin.alat.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection