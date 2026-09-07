<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminAlatController extends Controller
{
    
   public function index(Request $request)
   {
        $query = Alat::query();

        if ($request->filled('search')) {
            $query->where('nama_alat', 'like', '%'.$request->search.'%');
        }

        if ($request->filled('kategori') && $request->kategori != 'all') {
            $query->where('kategori', $request->kategori);
        }

        if ($request->filled('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }

        $alats = $query->paginate(5); 
        $kategoris = Alat::select('kategori')->distinct()->pluck('kategori');

        return view('pages.admin.kelola_alat.index', compact('alats', 'kategoris'));
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

   public function edit(Alat $alat)
    {
        return view('pages.admin.kelola_alat.edit', compact('alat'));
    }

    public function update(Request $request, Alat $alat)
    {
        $request->validate([
            'nama_alat' => 'required|string',
            'kategori' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'status' => 'required|string',
            'foto' => 'nullable|file|mimes:jpg,jpeg,webp,png|max:2048',
        ]);

        $data = $request->all();

            // 1. CEK ADA UPLOAD GAMBAR BARU GA
        if ($request->hasFile('foto')) {
            // 2. HAPUS GAMBAR LAMA BIAR GA NUMPUK
            if($alat->foto && file_exists(public_path('storage/images_alat/'.$alat->foto))){
                unlink(public_path('storage/images_alat/'.$alat->foto));
            }

            $image = $request->file('foto');
            $fotoName = Str::random(16) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('images_alat', $fotoName, 'public');
            $data['foto'] = $fotoName; // MASUKIN NAMA FILE BARU KE DATA
        } else {
            unset($data['foto']); // biar foto lama ga ketimpa null
        }

        

        $alat->update($data);
        return redirect()->route('admin.alat.index')->with('success', 'Alat berhasil diupdate');
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