<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        // Admin langsung diarahkan ke panel admin.
        // Auth::check() dipakai supaya pengunjung yang belum login tidak error.
        if (Auth::check() && Auth::user()->role == 'admin') {
            return redirect()->route('admin.alat.index');
        }

        return view('pages.user.dashboard');
    }
}
