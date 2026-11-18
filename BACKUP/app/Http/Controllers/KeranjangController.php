<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alat;
use App\Models\Rental;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $keranjang = session()->get('keranjang', []);

        $subtotal = 0;
        foreach ($keranjang as $item) {
            $subtotal += $item['harga'] * $item['jumlah'];
        }

        return view('pages.user.keranjang', compact('keranjang', 'subtotal'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'alat_id' => 'required|exists:alats,id',
            'jumlah'  => 'required|integer|min:1'
        ]);

        $keranjang = session()->get('keranjang', []);
        $alat_id   = $request->alat_id;
        $jumlah    = (int) $request->jumlah;

        $alat = Alat::findOrFail($alat_id);

        // jumlah alat ini yang sudah ada di keranjang
        $sudahAda = isset($keranjang[$alat_id]) ? $keranjang[$alat_id]['jumlah'] : 0;

        // cek stok: jumlah di keranjang + yang mau ditambah tidak boleh melebihi stok
        if ($sudahAda + $jumlah > $alat->stok) {
            $sisa = max($alat->stok - $sudahAda, 0);
            return redirect()->back()->with(
                'error',
                "Stok {$alat->nama_alat} hanya {$alat->stok}. Di keranjang sudah ada {$sudahAda}, kamu hanya bisa menambah {$sisa} lagi."
            );
        }

        if (isset($keranjang[$alat_id])) {
            $keranjang[$alat_id]['jumlah'] += $jumlah;
        } else {
            $keranjang[$alat_id] = [
                "id"     => $alat->id,
                "nama"   => $alat->nama_alat,
                "foto"   => $alat->foto,
                "harga"  => $alat->harga,
                "jumlah" => $jumlah
            ];
        }

        session()->put('keranjang', $keranjang);
        return redirect()->back()->with('success', 'Alat berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1'
        ]);

        $keranjang = session()->get('keranjang', []);

        if (isset($keranjang[$id])) {
            $alat = Alat::findOrFail($id);

            // cek stok saat jumlah diubah dari halaman keranjang
            if ($request->jumlah > $alat->stok) {
                return redirect()->route('keranjang.index')->with(
                    'error',
                    "Stok {$alat->nama_alat} hanya {$alat->stok}."
                );
            }

            $keranjang[$id]['jumlah'] = (int) $request->jumlah;
            session()->put('keranjang', $keranjang);
        }

        return redirect()->route('keranjang.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $keranjang = session()->get('keranjang', []);

        if (isset($keranjang[$id])) {
            unset($keranjang[$id]);
            session()->put('keranjang', $keranjang);
        }

        return redirect()->route('keranjang.index')->with('success', 'Item dihapus');
    }
}