<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatrentalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rentals = Rental::where('user_id', Auth::id())
        ->with('items.alat')
        ->latest()
        ->paginate(5);

        return view('pages.user.riwayat', compact('rentals'));
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
    public function show(string $riwayat)
    {
        $rental = Rental::findOrFail($riwayat);

        if ($rental->user_id !== Auth::id()) {
        abort(403);
        }

        $rental->load('items.alat');

        return view('pages.user.riwayat_detail', ['rental' => $rental]);
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
