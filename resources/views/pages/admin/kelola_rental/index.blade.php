@extends('layouts.app')

@section('title', 'Kelola Rental')

@section('content')
<div class="bg-[#FCFBF6]">
<div class="max-w-6xl mx-auto px-4 lg:px-10 py-20">

    <h1 class="font-['Outfit'] text-[30px] font-bold py-[40px]">Kelola Rental</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="py-2 flex justify-between items-center">
        <form action="{{ route('admin.kelola_rental.index') }}" method="GET" class="flex items-center gap-2">
            <div style="position:relative; display:inline-block; padding:8px 12px 8px 35px; border:1px solid #ddd; border-radius:8px; width:400px; background:#fff;">
                <i class="fa-solid fa-search" style="position:absolute; left:12px; top:50%; transform:translateY(-50%); color:#999;"></i>
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari nama alat..."
                    style="width:100%; border:none; outline:none;"
                >
            </div>

            <select name="kategori" onchange="this.form.submit()"
                    style="border:1px solid #ddd; outline:none; background:#fff; padding:8px 12px; font-size:14px; border-radius:8px;">
                <option value="all">Semua Kategori</option>
                @foreach($kategoris as $kat)
                    <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                @endforeach
            </select>

            <select name="status" onchange="this.form.submit()"
                    style="border:1px solid #ddd; outline:none; background:#fff; padding:8px 12px; font-size:14px; border-radius:8px;">
                <option value="all">Status: Semua</option>
                <option value="menunggu_konfirmasi" {{ request('status') == 'menunggu_konfirmasi' ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                <option value="dipinjam" {{ request('status') == 'dipinjam' ? 'selected' : '' }}>Sedang Dipinjam</option>
                <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                <option value="dibatalkan" {{ request('status') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
            </select>
        </form>
    </div>

    {{-- Table --}}
    <table class="table border rounded-lg border-[#5C645D] overflow-hidden w-full table-bordered font-['Instrument_Sans']">
        <thead>
            <tr class="font-['Instrument_Sans'] text-center text-[15px] font-semibold">
                <th class="!text-[#5C645D]">Booking ID</th>
                <th class="!text-[#5C645D]">Nama Penyewa</th>
                <th class="!text-[#5C645D]">Alat yang Disewa</th>
                <th class="!text-[#5C645D]">Tgl Booking</th>
                <th class="!text-[#5C645D]">Tgl Kembali</th>
                <th class="!text-[#5C645D]">Biaya</th>
                <th class="!text-[#5C645D]">Status</th>
                <th class="!text-[#5C645D]">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($rentals as $rental)
                <tr class="text-center font-['Outfit'] text-[13px] font-semibold">
                    <td class="!py-[18px] align-middle !text-[#C75A3A]">{{ $rental->booking_code }}</td>
                    <td class="!py-[18px] align-middle">{{ $rental->user?->name ?? 'Pengguna tidak ditemukan' }}</td>
                    <td class="!py-[18px] align-middle font-['Instrument_Sans'] font-normal">
                        @foreach($rental->items as $item)
                            {{ $item->alat?->nama_alat ?? 'Alat tidak ditemukan' }}{{ !$loop->last ? ', ' : '' }}
                        @endforeach
                    </td>
                    <td class="!py-[18px] align-middle font-normal">
                        {{ \Carbon\Carbon::parse($rental->tanggal_pengambilan)->format('d M Y') }}
                    </td>
                    <td class="!py-[18px] align-middle font-normal">
                        {{ $rental->tanggal_kembali ? \Carbon\Carbon::parse($rental->tanggal_kembali)->format('d M Y') : '-' }}
                    </td>
                    <td class="!py-[18px] align-middle !text-[#D96B27]">
                        Rp{{ number_format($rental->total_pembayaran) }}
                    </td>
                    <td class="!py-[18px] align-middle">
                        @if($rental->status === 'menunggu_konfirmasi')
                            <span class="rounded-full bg-orange-100 text-orange-500 py-[2px] px-3">Konfirmasi</span>
                        @elseif($rental->status === 'disetujui')
                            <span class="rounded-full bg-blue-100 text-blue-500 py-[2px] px-3">Disetujui</span>
                        @elseif($rental->status === 'dipinjam')
                            <span class="rounded-full bg-yellow-100 text-yellow-600 py-[2px] px-3">Sedang Dipinjam</span>
                        @elseif($rental->status === 'selesai')
                            <span class="rounded-full bg-[#D1FAE5] text-[#10B981] py-[2px] px-3">Selesai</span>
                        @elseif($rental->status === 'ditolak')
                            <span class="rounded-full bg-red-100 text-red-500 py-[2px] px-3">Ditolak</span>
                        @elseif($rental->status === 'dibatalkan')
                            <span class="rounded-full bg-gray-200 text-gray-500 py-[2px] px-3">Dibatalkan</span>
                        @endif
                    </td>
                    <td class="!py-[18px] align-middle">
                        <a href="{{ route('admin.kelola_rental.show', $rental->id) }}"
                           class="rounded-lg px-4 py-2 bg-[#C75A3A] hover:bg-[#B34E31] text-white text-[11px] font-semibold transition">
                            DETAIL
                        </a>
                    </td>
                </tr>
            @empty
                <tr><td colspan="8" class="text-center py-6">Belum ada data rental</td></tr>
            @endforelse
        </tbody>
    </table>

    <div style="display:flex; justify-content:space-between; align-items:center; margin-top:20px;">
        <div style="font-size:14px; color:#666;">
            Menampilkan {{ $rentals->firstItem() ?? 0 }}-{{ $rentals->lastItem() ?? 0 }} dari {{ $rentals->total() }} entri
        </div>
        <div>
            {{ $rentals->links() }}
        </div>
    </div>
</div>
</div>
@endsection
