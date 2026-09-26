@extends('layouts.app')

@section('title', 'Detail Rental')

@section('content')
<div class="bg-[#FCFBF6]">
<div class="max-w-3xl mx-auto px-4 lg:px-10 py-16">

    <a href="{{ route('admin.kelola_rental.index') }}" class="text-sm text-gray-500 hover:text-gray-800">
        &larr; Kembali ke Kelola Rental
    </a>

    @if(session('success'))
        <div class="alert alert-success mt-4">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger mt-4">{{ session('error') }}</div>
    @endif

    <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 mt-4">

        <div class="flex justify-between items-start mb-6">
            <div>
                <p class="text-[12px] text-gray-400 mb-1">Booking ID</p>
                <p class="font-semibold text-[18px] text-[#C75A3A]">{{ $rental->booking_code }}</p>
            </div>

            @if ($rental->status === 'menunggu_konfirmasi')
                <span class="text-[11px] font-semibold rounded-full px-3 py-1 bg-orange-100 text-orange-500">MENUNGGU KONFIRMASI</span>
            @elseif ($rental->status === 'disetujui')
                <span class="text-[11px] font-semibold rounded-full px-3 py-1 bg-blue-100 text-blue-500">DISETUJUI</span>
            @elseif ($rental->status === 'dipinjam')
                <span class="text-[11px] font-semibold rounded-full px-3 py-1 bg-yellow-100 text-yellow-600">SEDANG DIPINJAM</span>
            @elseif ($rental->status === 'ditolak')
                <span class="text-[11px] font-semibold rounded-full px-3 py-1 bg-red-100 text-red-500">DITOLAK</span>
            @elseif ($rental->status === 'selesai')
                <span class="text-[11px] font-semibold rounded-full px-3 py-1 bg-green-100 text-green-600">SELESAI</span>
            @elseif ($rental->status === 'dibatalkan')
                <span class="text-[11px] font-semibold rounded-full px-3 py-1 bg-gray-200 text-gray-500">DIBATALKAN</span>
            @endif
        </div>

        <div class="grid grid-cols-2 gap-6 mb-6 pb-6 border-b border-gray-100">
            <div>
                <p class="text-[12px] text-gray-400 mb-1">Nama Penyewa</p>
                <p class="text-[14px] font-medium">{{ $rental->user->name }}</p>
            </div>
            <div>
                <p class="text-[12px] text-gray-400 mb-1">Nomor HP</p>
                <p class="text-[14px] font-medium">{{ $rental->user->no_hp ?? '-' }}</p>
            </div>
            <div class="col-span-2">
                <p class="text-[12px] text-gray-400 mb-1">Alamat</p>
                <p class="text-[14px] font-medium">{{ $rental->user->alamat ?? '-' }}</p>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-6 mb-6 pb-6 border-b border-gray-100">
            <div>
                <p class="text-[12px] text-gray-400 mb-1">Tanggal Pengambilan</p>
                <p class="text-[14px] font-medium">{{ \Carbon\Carbon::parse($rental->tanggal_pengambilan)->format('d M Y') }}</p>
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
                            <td class="py-2 text-right">Rp{{ number_format($item->harga_saat_sewa * $item->jumlah, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="flex justify-between items-center mb-6">
            <p class="text-[14px] font-semibold">Total Pembayaran</p>
            <p class="text-[#D96B27] font-bold text-[20px]">Rp{{ number_format($rental->total_pembayaran, 0, ',', '.') }}</p>
        </div>

        @if ($rental->status === 'ditolak' && $rental->catatan)
            <div class="bg-red-50 border border-red-100 text-red-600 text-[13px] rounded-lg p-3 mb-4">
                <strong>Alasan ditolak:</strong> {{ $rental->catatan }}
            </div>
        @endif

        @if (in_array($rental->status, ['menunggu_konfirmasi', 'disetujui', 'dipinjam']))
            <div class="border-t border-gray-100 pt-5">
                <p class="text-[13px] font-semibold mb-3">Update Status</p>

                <form action="{{ route('admin.kelola_rental.update_status', $rental->id) }}" method="POST"
                      onsubmit="return confirm('Yakin ingin mengubah status rental ini?');">
                    @csrf
                    @method('PATCH')

                    <div class="mb-3">
                        <label class="text-[13px] text-gray-500 block mb-1">Pilih status baru</label>
                        <select name="status" id="status-select" class="form-control" required
                                onchange="document.getElementById('field-catatan').classList.toggle('hidden', this.value !== 'ditolak')">
                            <option value="">-- Pilih Status --</option>

                            @if ($rental->status === 'menunggu_konfirmasi')
                                <option value="disetujui">Disetujui</option>
                                <option value="ditolak">Ditolak</option>
                            @elseif ($rental->status === 'disetujui')
                                <option value="dipinjam">Sedang Dipinjam</option>
                            @elseif ($rental->status === 'dipinjam')
                                <option value="selesai">Selesai</option>
                            @endif
                        </select>
                    </div>

                    <div id="field-catatan" class="mb-3 hidden">
                        <label class="text-[13px] text-gray-500 block mb-1">Alasan penolakan</label>
                        <textarea name="catatan" class="form-control" rows="2" placeholder="Tulis alasan menolak pengajuan ini..."></textarea>
                    </div>

                    <button type="submit" class="rounded-lg px-4 py-2 bg-[#C75A3A] hover:bg-[#B34E31] text-white text-[13px] font-semibold">
                        Update Status
                    </button>
                </form>
            </div>
        @endif
    </div>
</div>
</div>
@endsection