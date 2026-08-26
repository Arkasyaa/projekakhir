<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Routing\ControllerDispatcher;

class LoginController extends Controller
{

public function showLoginForm()
{
    return view ('auth.login');
}

}
