<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SewaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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

        $tglAmbil   = \Carbon\Carbon::parse($request->tgl_ambil);
        $tglKembali = \Carbon\Carbon::parse($request->tgl_kembali);
        $durasi     = $tglAmbil->diffInDays($tglKembali);

        $subtotalPerHari = 0;
        foreach ($keranjang as $item) {
            $subtotalPerHari += $item['harga'] * $item['jumlah'];
        }
        $total = $subtotalPerHari * $durasi;

        $user = Auth::user();
        $user->update([
            'no_hp'  => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        $rental = Rental::create([
            'user_id'             => $user->id,
            'booking_code'        => 'ZANS-' . strtoupper(uniqid()),
            'tanggal_pengambilan' => $request->tgl_ambil,
            'tanggal_kembali'     => $request->tgl_kembali,
            'durasi_sewa'         => $durasi,
            'total_pembayaran'    => $total,
            'status'              => 'menunggu_konfirmasi',
        ]);

        foreach ($keranjang as $item) {
            $rental->items()->create([
                'alat_id'         => $item['id'],
                'jumlah'          => $item['jumlah'],
                'harga_saat_sewa' => $item['harga'],
            ]);
        }
        session()->forget('keranjang');

        return redirect()->route('riwayat.index')
        ->with('success', 'Pengajuan sewa berhasil dikirim, menunggu konfirmasi admin.');
    }
}
