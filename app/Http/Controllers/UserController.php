<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function index()
    {
        // cek biar admin gabisa masuk ke dashboard user
        if (Auth::user()->role == 'admin') {
            return redirect('/admin/dashboard');
        }

        return view('pages.user.dashboard');
    }
}