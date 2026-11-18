@extends('layouts.app')

@section('title', 'Detail Katalog')

@section('content')
<div class="bg-gray-50 min-h-screen font-['Instrument_Sans']">
    <div class="max-w-6xl mx-auto px-6 pt-28 pb-20">

        {{-- Breadcrumb --}}
        <nav class="text-sm text-gray-500 mb-6" aria-label="Breadcrumb">
            <a href="{{ route('home') }}#home" class="hover:text-[#285A4D] transition-colors">Beranda</a>
            <span class="mx-2">/</span>
            <a href="{{ route('home') }}#katalog" class="hover:text-[#285A4D] transition-colors">Katalog</a>
            <span class="mx-2">/</span>
            <span class="text-[#B86B4B] font-medium">Detail Katalog</span>
        </nav>

        {{-- Judul --}}
        <div class="flex items-start gap-4 mb-10">
            <a href="{{ route('home') }}#katalog"
               class="mt-1 flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-white text-[#285A4D] shadow-sm ring-1 ring-black/5 hover:bg-[#285A4D] hover:text-white transition-colors"
               aria-label="Kembali ke katalog">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <div>
                <h1 class="font-['DM_Serif_Display'] text-3xl md:text-4xl text-[#285A4D] tracking-tight">Detail Katalog</h1>
                <p class="mt-2 text-gray-600">
                    Pilih dan sesuaikan perlengkapan hiking &amp; camping terbaik untuk ekspedisi tangguh Anda.
                </p>
            </div>
        </div>

        {{-- Notifikasi --}}
        @if(session('success'))
            <div class="mb-6 flex items-center gap-3 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                <i class="fa-solid fa-circle-check"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 flex items-center gap-3 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                <i class="fa-solid fa-circle-exclamation"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        {{-- Filter kategori --}}
        <div class="mb-10 flex flex-wrap gap-2">
            <a href="{{ route('katalog.index') }}"
               class="rounded-full px-5 py-2 text-sm font-medium transition-colors
                      {{ !request('kategori') ? 'bg-[#285A4D] text-white shadow-sm' : 'bg-white text-gray-700 ring-1 ring-black/10 hover:bg-gray-100' }}">
                Semua
            </a>
            @foreach($kategoris as $kat)
                <a href="{{ route('katalog.index', ['kategori' => $kat]) }}"
                   class="rounded-full px-5 py-2 text-sm font-medium transition-colors
                          {{ request('kategori') == $kat ? 'bg-[#285A4D] text-white shadow-sm' : 'bg-white text-gray-700 ring-1 ring-black/10 hover:bg-gray-100' }}">
                    {{ $kat }}
                </a>
            @endforeach
        </div>

        {{-- Daftar alat per kategori --}}
        @forelse($alats as $namaKategori => $listAlat)
            <section class="mb-12">
                <h2 class="mb-6 border-l-4 border-[#E67E22] pl-3 text-xl font-semibold text-zinc-900">
                    {{ $namaKategori }}
                </h2>

                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($listAlat as $alat)
                        <article class="flex h-full flex-col overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-black/5 transition-shadow hover:shadow-md">

                            {{-- Foto --}}
                            <div class="relative aspect-[4/3] bg-gray-100">
                                @if($alat->foto)
                                    <img src="{{ asset('storage/images_alat/'.$alat->foto) }}"
                                         alt="{{ $alat->nama_alat }}"
                                         class="h-full w-full object-cover"
                                         loading="lazy">
                                @else
                                    <div class="flex h-full w-full items-center justify-center text-4xl text-gray-300">
                                        <i class="fa-solid fa-mountain-sun"></i>
                                    </div>
                                @endif

                                <span class="absolute left-3 top-3 rounded-full px-3 py-1 text-xs font-semibold shadow-sm
                                             {{ $alat->stok <= 3 ? 'bg-[#E67E22] text-white' : 'bg-white/90 text-[#285A4D]' }}">
                                    {{ $alat->stok <= 3 ? 'Sisa '.$alat->stok : 'Stok '.$alat->stok }}
                                </span>
                            </div>

                            {{-- Isi kartu --}}
                            <div class="flex flex-1 flex-col p-5">
                                <h3 class="text-base font-semibold text-zinc-900">{{ $alat->nama_alat }}</h3>
                                <p class="mt-1 text-lg font-bold text-[#B86B4B]">
                                    Rp{{ number_format($alat->harga, 0, ',', '.') }}
                                    <span class="text-sm font-normal text-gray-500">/hari</span>
                                </p>

                                <div class="mt-auto pt-5">
                                    @auth
                                        <form action="{{ route('keranjang.store') }}" method="POST" class="space-y-3">
                                            @csrf
                                            <input type="hidden" name="alat_id" value="{{ $alat->id }}">

                                            <div class="flex items-center justify-between gap-3">
                                                <div class="qty inline-flex items-center overflow-hidden rounded-full ring-1 ring-black/10">
                                                    <button type="button" data-action="minus"
                                                            class="h-9 w-9 text-gray-600 hover:bg-gray-100" aria-label="Kurangi">
                                                        <i class="fa-solid fa-minus text-xs"></i>
                                                    </button>
                                                    <input type="text" name="jumlah" value="1"
                                                           data-stok="{{ $alat->stok }}"
                                                           class="jumlah h-9 w-10 border-0 bg-transparent p-0 text-center text-sm font-medium focus:ring-0"
                                                           readonly>
                                                    <button type="button" data-action="plus"
                                                            class="h-9 w-9 text-gray-600 hover:bg-gray-100" aria-label="Tambah">
                                                        <i class="fa-solid fa-plus text-xs"></i>
                                                    </button>
                                                </div>

                                                <button type="submit"
                                                        class="inline-flex items-center gap-2 rounded-full bg-[#285A4D] px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-[#1f473d]">
                                                    <i class="fa-solid fa-cart-shopping text-xs"></i>
                                                    Masukkan Keranjang
                                                </button>
                                            </div>

                                            <p class="qty-msg hidden text-xs text-red-600"></p>
                                        </form>
                                    @else
                                        <a href="{{ route('login') }}"
                                           class="flex w-full items-center justify-center gap-2 rounded-full bg-[#285A4D] px-4 py-2.5 text-sm font-medium text-white transition-colors hover:bg-[#1f473d]">
                                            <i class="fa-solid fa-right-to-bracket text-xs"></i>
                                            Masuk untuk menyewa
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>
        @empty
            <div class="rounded-2xl bg-white px-6 py-16 text-center text-gray-500 shadow-sm ring-1 ring-black/5">
                <i class="fa-solid fa-box-open mb-3 text-3xl text-gray-300"></i>
                <p>Belum ada alat di kategori ini.</p>
            </div>
        @endforelse
    </div>
</div>

<script>
    // Tombol + dan - pada jumlah. Maksimal sesuai stok (data-stok).
    document.querySelectorAll('.qty').forEach(function (box) {
        const input = box.querySelector('.jumlah');
        const msg   = box.closest('form').querySelector('.qty-msg');
        const stok  = parseInt(input.dataset.stok, 10);

        function tampilkanPesan(teks) {
            msg.textContent = teks;
            msg.classList.toggle('hidden', teks === '');
        }

        box.querySelector('[data-action="plus"]').addEventListener('click', function () {
            const jumlah = parseInt(input.value, 10);
            if (jumlah < stok) {
                input.value = jumlah + 1;
                tampilkanPesan('');
            } else {
                tampilkanPesan('Jumlah tidak boleh melebihi stok (' + stok + ').');
            }
        });

        box.querySelector('[data-action="minus"]').addEventListener('click', function () {
            const jumlah = parseInt(input.value, 10);
            if (jumlah > 1) {
                input.value = jumlah - 1;
            }
            tampilkanPesan('');
        });
    });
</script>
@endsection
