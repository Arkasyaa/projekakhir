@extends('layouts.app')

@section('title', 'Kelola Alat')

@section('content')
<div class="bg-[#FCFBF6]>
<div class="max-w-6xl mx-auto px-4 lg:px-10 py-20">
        <div class="flex items-center justify-between">       
            <h1 class="font-['Outfit'] text-[30px] font-bold py-[40px] ">Kelola Alat</h1>
            <a href="{{ route('admin.alat.create') }}" 
            class="flex items-center gap-1.5 px-4 py-2 bg-[#C75A3A] hover:bg-[#B34E31] text-white text-sm font-semibold rounded-lg shadow-sm transition">
                <i class="fa-solid fa-plus"></i>
                <span>TAMBAH ALAT BARU</span>
            </a>
        </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table overflow-x-auto w-full table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Foto</th>
                <th>Nama Alat</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($alats as $alat)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    @if($alat->foto)
                        <img src="{{ asset('storage/images_alat/'.$alat->foto) }}" width="60">
                    @endif
                </td>
                <td>{{ $alat->nama_alat }}</td>
                <td>{{ $alat->kategori }}</td>
                <td>Rp{{ number_format($alat->harga) }}</td>
                <td>{{ $alat->stok }}</td>
                <td>{{ $alat->status }}</td>
                <td>
                    <a href="#" class="btn btn-warning btn-sm">Edit</a>
                    <a href="#" class="btn btn-danger btn-sm">Hapus</a>
                </td>
            </tr>
            @empty
            <tr><td colspan="8" class="text-center">Belum ada data alat</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
</div>
@endsection
