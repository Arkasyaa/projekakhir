<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alat;

class KeranjangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $keranjang = session()->get('keranjang', []);
        return view('pages.user.keranjang', compact('keranjang'));
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
            'jumlah' => 'required|integer|min:1'
        ]);

        $keranjang = session()->get('keranjang', []);
        $alat_id = $request->alat_id;
        $jumlah = $request->jumlah;

        if(isset($keranjang[$alat_id])) {
            // kalau udah ada, jumlahnya ditambah
            $keranjang[$alat_id]['jumlah'] += $jumlah;
        } else {
            $alat = Alat::find($alat_id);
            $keranjang[$alat_id] = [
                "id" => $alat->id,
                "nama" => $alat->nama_alat,
                "foto" => $alat->foto,
                "harga" => $alat->harga,
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
        $keranjang = session()->get('keranjang');
        if(isset($keranjang[$id])) {
            $keranjang[$id]['jumlah'] = $request->jumlah;
            session()->put('keranjang', $keranjang);
        }
        return redirect()->route('keranjang.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $keranjang = session()->get('keranjang');
        if(isset($keranjang[$id])) {
            unset($keranjang[$id]);
            session()->put('keranjang', $keranjang);
        }
        return redirect()->route('keranjang.index')->with('success', 'Item dihapus');
    }
}
