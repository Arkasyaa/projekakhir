<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alat;

class UserAlatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) 
    {
       
        $kategoris = Alat::select('kategori')->distinct()->pluck('kategori');

        $alats = Alat::where('stok', '>', 0)
                    ->when($request->kategori && $request->kategori != 'all', function($q) use ($request){
                        $q->where('kategori', $request->kategori);
                    })
                    ->latest() 
                    ->get()
                    ->groupBy('kategori');

        return view('pages.user.daftar_alat', compact('alats', 'kategoris'));
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
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
