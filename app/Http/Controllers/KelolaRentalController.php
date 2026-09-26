<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use Illuminate\Http\Request;

class KelolaRentalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rental = Rental::with(['user', 'items.alat'])->findOrFail($id);

        return view('pages.admin.kelola_rental.show', compact('rental'));
    }

    /**
     * Update status rental lewat dropdown pilihan di halaman detail.
     * Aturan alur yang diizinkan:
     * - menunggu_konfirmasi -> disetujui / ditolak
     * - disetujui -> selesai
     */
    public function updateStatus(Request $request, string $id)
    {
        $request->validate([
            'status'  => 'required|in:disetujui,ditolak,dipinjam,selesai',
            'catatan' => 'nullable|string',
        ]);

        $rental = Rental::findOrFail($id);
        $statusBaru = $request->status;

        // Cek apakah perpindahan status ini diizinkan dari status saat ini
        $alurDiizinkan = [
            'menunggu_konfirmasi' => ['disetujui', 'ditolak'],
            'disetujui'           => ['dipinjam'],
            'dipinjam'            => ['selesai'],
        ];

        if (!isset($alurDiizinkan[$rental->status]) || !in_array($statusBaru, $alurDiizinkan[$rental->status])) {
            return redirect()->route('admin.kelola_rental.index')
                ->with('error', 'Perubahan status tidak valid untuk kondisi rental ini.');
        }

        $rental->update([
            'status'  => $statusBaru,
            'catatan' => $statusBaru === 'ditolak' ? $request->input('catatan') : $rental->catatan,
        ]);

        return redirect()->route('admin.kelola_rental.index')
            ->with('success', 'Status rental berhasil diperbarui.');
    }
}