<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminAlatController extends Controller
{
    
    public function index()
    {
        $alats = Alat::latest()->get();
        return view('pages.admin.kelola_alat.index', compact('alats'));
    }

    
    public function create()
    {
        return view('pages.admin.kelola_alat.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nama_alat' => 'required|string',
            'kategori' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'status' => 'required|string',
            'foto' => 'nullable|file|mimes:jpg,jpeg,webp,png|max:2048',
        ]);

        $fotoName = null;
        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $fotoName = Str::random(16) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('images_alat', $fotoName, 'public'); 
        }

        Alat::create([
            'nama_alat' => $request->nama_alat,
            'kategori' => $request->kategori,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'status' => $request->status,
            'foto' => $fotoName,
        ]);

        return redirect()->route('admin.alat.index')->with('success', 'Data alat berhasil ditambah');
    }

    public function destroy(string $id)
    {
        $alat = Alat::findOrFail($id);

        if ($alat->foto && Storage::disk('public')->exists($alat->foto)) {
            Storage::disk('public')->delete($alat->foto);
        }

        $alat->delete();

        return redirect()->route('admin.alat.index')
            ->with('success', 'Data berhasil dihapus');
    }

}