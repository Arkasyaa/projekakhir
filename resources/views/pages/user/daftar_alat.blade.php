@extends('layouts.app')

@section('title', 'Detail Katalog')

@section('content')
<div class="min-h-screen bg-[#FCFAF6]">
    <div class="mx-auto max-w-6xl px-6 pb-16 pt-28">
        <nav class="mb-8 flex items-center gap-2 text-sm text-[#7C827D]" aria-label="Breadcrumb">
            <a href="{{ route('home') }}#home" class="transition hover:text-[#285A4D]">Beranda</a>
            <i class="fa-solid fa-chevron-right text-[10px]"></i>
            <a href="{{ route('home') }}#katalog" class="transition hover:text-[#285A4D]">Katalog</a>
            <i class="fa-solid fa-chevron-right text-[10px]"></i>
            <span class="font-medium text-[#285A4D]" aria-current="page">Detail alat</span>
        </nav>

        <header class="mb-8">
            <p class="mb-3 inline-flex rounded-full bg-[#D96B27]/10 px-4 py-1.5 text-xs font-semibold tracking-wide text-[#D96B27]">
                KOLEKSI ZANS OUTDOOR
            </p>
            <h1 class="font-['Outfit'] text-3xl font-extrabold tracking-tight text-[#285A4D] md:text-4xl">
                Temukan perlengkapan terbaik
            </h1>
            <p class="mt-3 max-w-2xl text-sm leading-6 text-[#68716B] md:text-base">
                Pilih perlengkapan hiking dan camping yang Anda butuhkan. Jumlah yang bisa ditambahkan mengikuti stok tersedia.
            </p>
        </header>

        @if(session('success'))
            <div class="mb-6 flex items-start gap-3 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800" role="status">
                <i class="fa-solid fa-circle-check mt-0.5"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif
        @if(session('error'))
            <div class="mb-6 flex items-start gap-3 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800" role="alert">
                <i class="fa-solid fa-circle-exclamation mt-0.5"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <div class="mb-10 rounded-2xl border border-[#E9E5DC] bg-white p-4 shadow-sm">
            <p class="mb-3 text-xs font-semibold uppercase tracking-wider text-[#7C827D]">Pilih kategori</p>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('katalog.index') }}"
                    @class([
                        'rounded-full px-4 py-2 text-sm font-medium transition',
                        'bg-[#285A4D] text-white shadow-sm' => !request('kategori'),
                        'bg-[#F4F1EA] text-[#536159] hover:bg-[#E9E5DC]' => request('kategori'),
                    ])>
                    Semua alat
                </a>
                @foreach($kategoris as $kat)
                    <a href="{{ route('katalog.index', ['kategori' => $kat]) }}"
                        @class([
                            'rounded-full px-4 py-2 text-sm font-medium transition',
                            'bg-[#285A4D] text-white shadow-sm' => request('kategori') == $kat,
                            'bg-[#F4F1EA] text-[#536159] hover:bg-[#E9E5DC]' => request('kategori') != $kat,
                        ])>
                        {{ $kat }}
                    </a>
                @endforeach
            </div>
        </div>

        @forelse($alats as $namaKategori => $listAlat)
            <section class="mb-12 last:mb-0" aria-labelledby="kategori-{{ $loop->index }}">
                <div class="mb-5 flex items-end justify-between gap-4">
                    <div>
                        <p class="mb-1 text-xs font-semibold uppercase tracking-widest text-[#D96B27]">Kategori</p>
                        <h2 id="kategori-{{ $loop->index }}" class="font-['Outfit'] text-2xl font-bold text-[#285A4D]">
                            {{ $namaKategori }}
                        </h2>
                    </div>
                    <span class="whitespace-nowrap rounded-full bg-[#285A4D]/[0.07] px-3 py-1 text-xs font-medium text-[#285A4D]">
                        {{ $listAlat->count() }} alat
                    </span>
                </div>

                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($listAlat as $alat)
                        @php
                            $jumlahDiKeranjang = (int) session("keranjang.{$alat->id}.jumlah", 0);
                            $stokTersedia = max(0, $alat->stok - $jumlahDiKeranjang);
                        @endphp
                        <article class="group flex h-full flex-col overflow-hidden rounded-2xl border border-[#E9E5DC] bg-white shadow-sm transition duration-200 hover:-translate-y-1 hover:shadow-lg">
                            <div class="relative aspect-[16/10] overflow-hidden bg-[#F4F1EA]">
                                @if($alat->foto)
                                    <img src="{{ asset('storage/images_alat/'.$alat->foto) }}"
                                        class="h-full w-full object-cover transition duration-300 group-hover:scale-105"
                                        alt="{{ $alat->nama_alat }}">
                                @else
                                    <div class="flex h-full items-center justify-center text-[#A6AEA8]" aria-label="Foto alat tidak tersedia">
                                        <i class="fa-solid fa-mountain-sun text-4xl"></i>
                                    </div>
                                @endif
                                <span class="absolute left-3 top-3 rounded-full bg-white/95 px-3 py-1 text-[11px] font-semibold text-[#285A4D] shadow-sm">
                                    {{ $namaKategori }}
                                </span>
                            </div>

                            <div class="flex flex-1 flex-col p-4">
                                <div class="mb-2">
                                    <h3 class="font-['Outfit'] text-base font-bold text-[#263D35]">{{ $alat->nama_alat }}</h3>
                                    @if($alat->deskripsi)
                                        <p class="mt-1 line-clamp-2 text-xs leading-5 text-[#737B75]">{{ $alat->deskripsi }}</p>
                                    @endif
                                </div>

                                <div class="mb-3 mt-auto flex items-end justify-between gap-3 border-t border-[#F0EDE7] pt-3">
                                    <div>
                                        <p class="mb-0.5 text-[11px] text-[#7C827D]">Harga sewa</p>
                                        <p class="font-['Outfit'] text-lg font-bold text-[#285A4D]">
                                            Rp{{ number_format($alat->harga, 0, ',', '.') }}
                                            <span class="font-['Instrument_Sans'] text-xs font-medium text-[#7C827D]">/ hari</span>
                                        </p>
                                    </div>
                                    <span class="rounded-full {{ $stokTersedia > 0 ? 'bg-emerald-50 text-emerald-700' : 'bg-red-50 text-red-700' }} px-2.5 py-1 text-[11px] font-semibold">
                                        {{ $stokTersedia > 0 ? 'Stok ' . $stokTersedia : 'Stok habis' }}
                                    </span>
                                </div>

                                @if($stokTersedia > 0)
                                    <form action="{{ route('keranjang.store') }}" method="POST" class="space-y-2.5">
                                        @csrf
                                        <input type="hidden" name="alat_id" value="{{ $alat->id }}">

                                        <div class="flex items-center justify-between gap-3">
                                            <span class="text-xs font-medium text-[#536159]">Jumlah</span>
                                            <div class="flex items-center rounded-lg border border-[#DDE3DD] bg-[#FAFBF9] p-0.5">
                                                <button type="button" class="btn-minus flex h-8 w-8 items-center justify-center rounded-md text-[#285A4D] transition hover:bg-[#E8F0EB] disabled:cursor-not-allowed disabled:opacity-40" aria-label="Kurangi jumlah">
                                                    <i class="fa-solid fa-minus text-xs"></i>
                                                </button>
                                                <input type="number" name="jumlah" min="1" max="{{ $stokTersedia }}" value="1" class="jumlah w-10 border-0 bg-transparent p-0 text-center text-sm font-semibold text-[#263D35] focus:ring-0" readonly aria-label="Jumlah alat">
                                                <button type="button" class="btn-plus flex h-8 w-8 items-center justify-center rounded-md text-[#285A4D] transition hover:bg-[#E8F0EB] disabled:cursor-not-allowed disabled:opacity-40" aria-label="Tambah jumlah">
                                                    <i class="fa-solid fa-plus text-xs"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-lg bg-[#285A4D] px-4 py-2.5 text-xs font-semibold text-white transition hover:bg-[#1E463B] focus:outline-none focus:ring-2 focus:ring-[#285A4D]/30 focus:ring-offset-2">
                                            <i class="fa-solid fa-cart-plus"></i>
                                            Masukkan ke keranjang
                                        </button>
                                    </form>
                                @else
                                    <div class="rounded-xl bg-[#F8F5F0] px-4 py-3 text-center text-sm font-medium text-[#8A6A51]">
                                        Stok maksimal sudah ada di keranjang.
                                    </div>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>
        @empty
            <div class="rounded-2xl border border-dashed border-[#D7DDD7] bg-white px-6 py-16 text-center">
                <span class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-[#285A4D]/[0.08] text-[#285A4D]">
                    <i class="fa-solid fa-box-open text-xl"></i>
                </span>
                <h2 class="font-['Outfit'] text-xl font-bold text-[#285A4D]">Belum ada alat tersedia</h2>
                <p class="mt-2 text-sm text-[#737B75]">Coba pilih kategori lain atau periksa kembali nanti.</p>
            </div>
        @endforelse
    </div>
</div>

<script>
    document.querySelectorAll('.btn-plus').forEach(button => {
        const controls = button.parentElement;
        const input = controls.querySelector('.jumlah');
        const minusButton = controls.querySelector('.btn-minus');
        const max = Number(input.max);

        const updateButtonStates = () => {
            const value = Number(input.value);
            button.disabled = value >= max;
            minusButton.disabled = value <= Number(input.min);
        };

        button.addEventListener('click', () => {
            const value = Number(input.value);
            if (value < max) {
                input.value = value + 1;
            }
            updateButtonStates();
        });

        minusButton.addEventListener('click', () => {
            const value = Number(input.value);
            if (value > Number(input.min)) {
                input.value = value - 1;
            }
            updateButtonStates();
        });

        updateButtonStates();
    });
</script>
@endsection
