<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Alat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SewaController extends Controller
{
    public function checkout(Request $request)
    {
        $request->validate([
            'nama'        => 'required|string|max:255',
            'no_hp'       => 'required|string|max:20',
            'alamat'      => 'required|string',
            'tgl_ambil'   => 'required|date|after_or_equal:today',
            'tgl_kembali' => 'required|date|after:tgl_ambil',
        ]);

        $keranjang = session()->get('keranjang', []);

        if (empty($keranjang)) {
            return redirect()->route('keranjang.index')->with('error', 'Keranjang masih kosong.');
        }

        $tglAmbil   = \Carbon\Carbon::parse($request->tgl_ambil)->startOfDay();
        $tglKembali = \Carbon\Carbon::parse($request->tgl_kembali)->startOfDay();
        $durasi     = (int) $tglAmbil->diffInDays($tglKembali);

        $user = Auth::user();

        try {
            DB::transaction(function () use ($request, $keranjang, $user, $durasi) {
                // Kunci baris alat selama transaksi supaya stok tidak bisa
                // diambil dua orang sekaligus, lalu cek stok dan hitung total.
                $subtotalPerHari = 0;
                $alatTerkunci = [];

                foreach ($keranjang as $item) {
                    $alat = Alat::lockForUpdate()->find($item['id']);

                    if (!$alat) {
                        throw new \RuntimeException('Alat tidak ditemukan.');
                    }
                    if ($alat->stok < $item['jumlah']) {
                        throw new \RuntimeException("Stok {$alat->nama_alat} tidak cukup. Sisa: {$alat->stok}");
                    }

                    $alatTerkunci[$item['id']] = $alat;
                    // Pakai harga terbaru dari database, bukan harga di session
                    $subtotalPerHari += $alat->harga * $item['jumlah'];
                }

                $user->update([
                    'name'   => $request->nama,
                    'no_hp'  => $request->no_hp,
                    'alamat' => $request->alamat,
                ]);

                $rental = Rental::create([
                    'user_id'             => $user->id,
                    'booking_code'        => 'ZANS-' . strtoupper(uniqid()),
                    'tanggal_pengambilan' => $request->tgl_ambil,
                    'tanggal_kembali'     => $request->tgl_kembali,
                    'durasi_sewa'         => $durasi,
                    'total_pembayaran'    => $subtotalPerHari * $durasi,
                    'status'              => 'menunggu_konfirmasi',
                ]);

                foreach ($keranjang as $item) {
                    $alat = $alatTerkunci[$item['id']];

                    $rental->items()->create([
                        'alat_id'         => $alat->id,
                        'jumlah'          => $item['jumlah'],
                        'harga_saat_sewa' => $alat->harga,
                    ]);

                    $alat->decrement('stok', $item['jumlah']);
                }
            });
        } catch (\RuntimeException $e) {
            return back()->with('error', $e->getMessage());
        }

        session()->forget('keranjang');

        return redirect()->route('riwayat.index')
            ->with('success', 'Pengajuan sewa berhasil dikirim, menunggu konfirmasi admin.');
    }
}
