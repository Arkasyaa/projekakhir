@extends('layouts.app')

@section('title', 'Detail Riwayat')

@section('content')
<div class="bg-[#FCFAF6]">
<div class="max-w-3xl mx-auto px-4 lg:px-10 py-16">

    <a href="{{ route('riwayat.index') }}" class="text-sm text-gray-500 hover:text-gray-800">
        &larr; Kembali ke Riwayat
    </a>

    <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 mt-4">

        <div class="flex justify-between items-start mb-6">
            <div>
                <p class="text-[12px] text-gray-400 mb-1">Booking ID</p>
                <p class="font-semibold text-[18px]">{{ $rental->booking_code }}</p>
            </div>

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
            {{-- @elseif ($rental->status === 'dibatalkan')
                <span class="text-[11px] font-semibold rounded-full px-3 py-1 bg-gray-200 text-gray-500">
                    DIBATALKAN
                </span> --}}
            @endif
        </div>

        <div class="grid grid-cols-2 gap-6 mb-6 pb-6 border-b border-gray-100">
            <div>
                <p class="text-[12px] text-gray-400 mb-1">Tanggal Pengambilan</p>
                <p class="text-[14px] font-medium">
                    {{ \Carbon\Carbon::parse($rental->tanggal_pengambilan)->format('d M Y') }}
                </p>
            </div>
            <div>
                <p class="text-[12px] text-gray-400 mb-1">Tanggal Pengembalian</p>
                <p class="text-[14px] font-medium">
                    {{ $rental->tanggal_kembali ? \Carbon\Carbon::parse($rental->tanggal_kembali)->format('d M Y') : '-' }}
                </p>
            </div>
            <div>
                <p class="text-[12px] text-gray-400 mb-1">Durasi Sewa</p>
                <p class="text-[14px] font-medium">{{ $rental->durasi_sewa }} Hari</p>
            </div>
            <div>
                <p class="text-[12px] text-gray-400 mb-1">Tanggal Pengajuan</p>
                <p class="text-[14px] font-medium">{{ $rental->created_at->format('d M Y') }}</p>
            </div>
        </div>

        <div class="mb-6 pb-6 border-b border-gray-100">
            <p class="text-[13px] font-semibold mb-3">Alat yang Disewa</p>

            <table class="w-full text-[13px]">
                <thead>
                    <tr class="text-left text-gray-400 text-[12px]">
                        <th class="font-normal pb-2">Nama Alat</th>
                        <th class="font-normal pb-2 text-center">Jumlah</th>
                        <th class="font-normal pb-2 text-right">Harga/Hari</th>
                        <th class="font-normal pb-2 text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rental->items as $item)
                        <tr class="border-t border-gray-50">
                            <td class="py-2">{{ $item->alat->nama_alat }}</td>
                            <td class="py-2 text-center">{{ $item->jumlah }}</td>
                            <td class="py-2 text-right">Rp{{ number_format($item->harga_saat_sewa, 0, ',', '.') }}</td>
                            <td class="py-2 text-right">
                                Rp{{ number_format($item->harga_saat_sewa * $item->jumlah, 0, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="flex justify-between items-center mb-4">
            <p class="text-[14px] font-semibold">Total Pembayaran</p>
            <p class="text-[#D96B27] font-bold text-[20px]">
                Rp{{ number_format($rental->total_pembayaran, 0, ',', '.') }}
            </p>
        </div>

        {{-- @if ($rental->status === 'ditolak' && $rental->catatan)
            <div class="bg-red-50 border border-red-100 text-red-600 text-[13px] rounded-lg p-3 mb-4">
                <strong>Alasan ditolak:</strong> {{ $rental->catatan }}
            </div>
        @endif --}}

        {{-- @if ($rental->status === 'menunggu_konfirmasi')
            <form action="{{ route('riwayat.cancel', $rental->id) }}"
                  method="POST"
                  onsubmit="return confirm('Yakin ingin membatalkan pesanan ini?');">
                @csrf
                @method('PATCH')
                <button type="submit"
                        class="border border-red-300 text-red-500 rounded-lg px-4 py-2 text-[13px] font-medium hover:bg-red-50 transition">
                    Batalkan Pesanan
                </button>
            </form>
        @endif --}}
    </div>
</div>
</div>
@endsection
