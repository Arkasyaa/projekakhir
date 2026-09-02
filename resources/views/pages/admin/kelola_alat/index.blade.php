@extends('layouts.app')

@section('title', 'Kelola Alat')

@section('content')
    <div class="max-w-6xl mx-auto px-4 lg:px-10 py-20">
    <div class="flex items-center justify-between">       
        <h1 class="text-xl md:text-2xl font-bold text-gray-900">Kelola Alat</h1>
        <a href="#" 
           class="flex items-center gap-1.5 px-4 py-2 bg-[#C75A3A] hover:bg-[#B34E31] text-white text-sm font-semibold rounded-lg shadow-sm transition">
            <i class="fa-solid fa-plus"></i>
            <span>TAMBAH ALAT BARU</span>
        </a>
    </div>
</div>
@endsection