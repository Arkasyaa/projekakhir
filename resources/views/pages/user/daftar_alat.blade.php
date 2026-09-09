@extends('layouts.app')

@section('title', 'Kelola Alat')

@section('content')
<div class="bg-gray-50">
<div class="max-w-6xl mx-auto py-20">
    <div class="container mx-auto px-4 lg:px-8">

        <!-- Breadcrumb -->
        <nav class="text-sm text-gray-500 mb-6">
            <a href="#" class="hover:text-emerald-700">Beranda</a>
            <span class="mx-2">></span>
            <a href="#" class="hover:text-emerald-700">Katalog</a>
            <span class="mx-2">></span>
            <span class="text-[#B86B4B] font-medium">Detail Katalog</span> 
        </nav>
         <div class="flex items-center gap-3 mb-2">
            <a href="#" class="text-2xl">
                <i class="fa-solid fa-arrow-left"></i> 
            </a>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900">Detail Katalog</h1>
        </div>
        <p class="text-gray-600 mb-8">
            Pilih dan sesuaikan perlengkapan hiking & camping terbaik untuk ekspedisi tangguh Anda.
        </p>
        
       <div class="mb-4 d-flex gap-2 flex-wrap">
        <a href="{{ route('katalog.index') }}" class="btn rounded-pill {{ !request('kategori') ? 'btn-dark' : 'btn-outline-dark' }}">Semua</a>
        @foreach($kategoris as $kat)
            <a href="{{ route('katalog.index', ['kategori' => $kat]) }}" 
               class="btn rounded-pill {{ request('kategori') == $kat ? 'btn-dark' : 'btn-outline-dark' }}">
               {{ $kat }}
            </a>
        @endforeach
    </div>

    <!-- LOOP PER KATEGORI -->
    @forelse($alats as $namaKategori => $listAlat)
        <h4 class="mt-5 mb-3">| {{ $namaKategori }}</h4>
        <div class="row">
            @foreach($listAlat as $alat)
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset('storage/images_alat/'.$alat->foto) }}" 
                             class="card-img-top" 
                             style="height:200px; object-fit:cover;" 
                             alt="{{ $alat->nama_alat }}">
                        
                        <div class="card-body">
                            <h6>{{ $alat->nama_alat }}</h6>
                            <p class="text-danger fw-bold">Rp{{ number_format($alat->harga) }}/hari</p>
                            
                            <div class="d-flex justify-content-between">
                                 <form action="{{ route('keranjang.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="alat_id" value="{{ $alat->id }}">
                                    
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="input-group input-group-sm" style="width: 100px;">
                                            <button type="button" class="btn btn-outline-secondary btn-minus">-</button>
                                            <input type="text" name="jumlah" value="1" class="form-control text-center jumlah" readonly>
                                            <button type="button" class="btn btn-outline-secondary btn-plus">+</button>
                                        </div>
                                        <button type="submit" class="btn btn-sm btn-dark">Masukan Keranjang</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @empty
        <p class="text-center">Belum ada alat di kategori ini</p>
    @endforelse
</div>
</div>
<script>
    document.querySelectorAll('.btn-plus').forEach(button => {
        button.addEventListener('click', function() {
            let input = this.parentElement.querySelector('.jumlah');
            input.value = parseInt(input.value) + 1;
        });
    });

    document.querySelectorAll('.btn-minus').forEach(button => {
        button.addEventListener('click', function() {
            let input = this.parentElement.querySelector('.jumlah');
            if(parseInt(input.value) > 1){
                input.value = parseInt(input.value) - 1;
            }
        });
    });
</script>
@endsection