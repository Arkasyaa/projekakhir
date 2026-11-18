<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelolaRentalController extends Controller
{
    public function index(Request $request)
    {
        $query = Rental::with(['user', 'items.alat']);

        if ($request->filled('search')) {
            $keyword = $request->search;
            $query->where(function ($q) use ($keyword) {
                $q->where('booking_code', 'like', '%' . $keyword . '%')
                  ->orWhereHas('user', function ($u) use ($keyword) {
                      $u->where('name', 'like', '%' . $keyword . '%');
                  })
                  ->orWhereHas('items.alat', function ($a) use ($keyword) {
                      $a->where('nama_alat', 'like', '%' . $keyword . '%');
                  });
            });
        }

        if ($request->filled('kategori') && $request->kategori !== 'all') {
            $kategori = $request->kategori;
            $query->whereHas('items.alat', function ($q) use ($kategori) {
                $q->where('kategori', $kategori);
            });
        }

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $rentals = $query->latest()->paginate(5)->withQueryString();
        $kategoris = \App\Models\Alat::select('kategori')->distinct()->pluck('kategori');

        return view('pages.admin.kelola_rental.index', compact('rentals', 'kategoris'));
    }

    public function show(string $id)
    {
        $rental = Rental::with(['user', 'items.alat'])->findOrFail($id);
        return view('pages.admin.kelola_rental.show', compact('rental'));
    }

    // Tombol-tombol cepat (route setuju, tolak, selesai sebelumnya belum punya method)
    public function setuju(string $id)
    {
        return $this->ubahStatus($id, 'disetujui');
    }

    public function tolak(Request $request, string $id)
    {
        $request->validate(['catatan' => 'nullable|string']);

        return $this->ubahStatus($id, 'ditolak', $request->input('catatan'));
    }

    public function selesai(string $id)
    {
        return $this->ubahStatus($id, 'selesai');
    }

    public function updateStatus(Request $request, string $id)
    {
        $request->validate([
            'status'  => 'required|in:disetujui,ditolak,dipinjam,selesai,menunggu_konfirmasi,menunggu konfirmasi,Konfirmasi',
            'catatan' => 'nullable|string',
        ]);

        return $this->ubahStatus($id, $request->status, $request->input('catatan'));
    }

    /**
     * Ubah status rental. Stok alat dikembalikan satu kali saja,
     * saat status berubah menjadi selesai, ditolak, atau dibatalkan.
     */
    private function ubahStatus(string $id, string $statusBaru, ?string $catatan = null)
    {
        $rental = Rental::with('items.alat')->findOrFail($id);
        $statusLama = $rental->status;

        DB::transaction(function () use ($rental, $statusBaru, $statusLama, $catatan) {
            $rental->update([
                'status'  => $statusBaru,
                'catatan' => strtolower($statusBaru) === 'ditolak' ? $catatan : $rental->catatan,
            ]);

            $balikin = ['selesai', 'ditolak', 'dibatalkan'];

            if (in_array(strtolower($statusBaru), $balikin) && !in_array(strtolower($statusLama), $balikin)) {
                foreach ($rental->items as $item) {
                    if ($item->alat) {
                        $item->alat->increment('stok', $item->jumlah);
                    }
                }
            }
        });

        return redirect()->route('admin.kelola_rental.index')->with('success', 'Status rental berhasil diperbarui.');
    }
}
