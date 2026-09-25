@extends('layouts.app')

@section('title', 'Riwayat Rental')

@section('content')
<div class="bg-[#FCFAF6]">
<div class="max-w-4xl mx-auto px-4 lg:px-10 py-16">

    <h1 class="font-['Outfit'] text-[28px] font-bold mb-8">Riwayat Rental</h1>

    @forelse ($rentals as $rental)
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 mb-5">

            <div class="flex justify-between items-start mb-4">
                <p class="font-semibold text-[15px]">Booking ID: {{ $rental->booking_code }}</p>

                @if ($rental->status === 'menunggu_konfirmasi')
                    <span class="text-[11px] font-semibold rounded-full px-3 py-1 bg-orange-100 text-orange-500">
                        MENUNGGU DIKONFIRMASI
                    </span>
                @elseif ($rental->status === 'dipinjam')
                    <span class="text-[11px] font-semibold rounded-full px-3 py-1 bg-blue-100 text-blue-500">
                        SEDANG DIPINJAM
                    </span>
                @elseif ($rental->status === 'ditolak')
                    <span class="text-[11px] font-semibold rounded-full px-3 py-1 bg-red-100 text-red-500">
                        DITOLAK
                    </span>
                @elseif ($rental->status === 'selesai')
                    <span class="text-[11px] font-semibold rounded-full px-3 py-1 bg-green-100 text-green-600">
                        SELESAI
                    </span>
                @endif
            </div>

            <div class="flex justify-between items-end">
                <div>
                    <p class="text-[12px] text-gray-400 mb-1">Alat yang Dirental</p>
                    <p class="font-semibold text-[14px] mb-4">
                        @foreach ($rental->items as $item)
                            {{ $item->alat->nama_alat }} (x{{ $item->jumlah }}){{ !$loop->last ? ', ' : '' }}
                        @endforeach
                    </p>

                    <div class="flex gap-10">
                        <div>
                            <p class="text-[12px] text-gray-400 mb-1">Tanggal Pengambilan</p>
                            @if ($rental->status === 'menunggu_konfirmasi')
                                <p class="text-[13px] font-medium">*Menunggu dikonfirmasi</p>
                            @elseif ($rental->status === 'ditolak')
                                <p class="text-[13px] font-medium">*Ajuan ditolak</p>
                            @elseif ($rental->status === 'dipinjam')
                                <p class="text-[13px] font-medium">
                                    H-{{ max(0, now()->diffInDays(\Carbon\Carbon::parse($rental->tanggal_pengambilan), false)) }} Pendakian
                                </p>
                            @else
                                <p class="text-[13px] font-medium">
                                    {{ \Carbon\Carbon::parse($rental->tanggal_pengambilan)->format('d M Y') }}
                                </p>
                            @endif
                        </div>
                        <div>
                            <p class="text-[12px] text-gray-400 mb-1">Durasi Sewa</p>
                            <p class="text-[13px] font-medium">{{ $rental->durasi_sewa }} Hari</p>
                        </div>
                    </div>
                </div>

                <div class="text-right">
                    <p class="text-[12px] text-gray-400 mb-1">Total Pembayaran</p>
                    <p class="text-[#D96B27] font-bold text-[18px] mb-4">
                        Rp{{ number_format($rental->total_pembayaran, 0, ',', '.') }}
                    </p>
                    <a href="{{ route('riwayat.show', $rental->id) }}"
                       class="inline-block border border-gray-300 rounded-lg px-4 py-2 text-[13px] font-medium hover:bg-gray-50 transition">
                        Lihat Detail
                    </a>
                </div>

            </div>
        </div>
    @empty
        <div class="bg-white border border-gray-200 rounded-xl p-10 text-center text-gray-400">
            Belum ada riwayat rental.
        </div>
    @endforelse

    @if ($rentals->hasPages())
        <div class="mt-6">
            {{ $rentals->links() }}
        </div>
    @endif

</div>
</div>
@endsection
