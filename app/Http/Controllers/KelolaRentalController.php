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
            $query->whereHas('items.alat', function ($q) use ($keyword) {
                $q->where('nama_alat', 'like', '%' . $keyword . '%');
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

    public function updateStatus(Request $request, string $id)
    {
        $request->validate([
            'status'  => 'required|in:disetujui,ditolak,dipinjam,selesai,menunggu_konfirmasi,menunggu konfirmasi,Konfirmasi',
            'catatan' => 'nullable|string',
        ]);

        $rental = Rental::with('items.alat')->findOrFail($id);
        $statusBaru = $request->status;
        $statusLama = $rental->status;

        $alurDiizinkan = [
            'menunggu_konfirmasi' => ['disetujui', 'ditolak'],
            'menunggu konfirmasi' => ['disetujui', 'ditolak'],
            'Konfirmasi'          => ['disetujui', 'dipinjam'],
            'disetujui'           => ['dipinjam'],
            'dipinjam'            => ['selesai'],
        ];

        if (!isset($alurDiizinkan[$rental->status]) || !in_array($statusBaru, $alurDiizinkan[$rental->status])) {
            if ($rental->status !== 'menunggu_konfirmasi' && $rental->status !== 'menunggu konfirmasi') {
                if (!isset($alurDiizinkan[$statusLama]) || !in_array($statusBaru, $alurDiizinkan[$statusLama])) {
                }
            }
        }

        DB::transaction(function () use ($rental, $statusBaru, $statusLama, $request) {
            $rental->update([
                'status'  => $statusBaru,
                'catatan' => strtolower($statusBaru) === 'ditolak' ? $request->input('catatan') : $rental->catatan,
            ]);

            $balikin = ['selesai', 'ditolak', 'dibatalkan'];
            $sudahBalikin = ['selesai', 'ditolak', 'dibatalkan'];

            if (in_array(strtolower($statusBaru), $balikin) && !in_array(strtolower($statusLama), $sudahBalikin)) {
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