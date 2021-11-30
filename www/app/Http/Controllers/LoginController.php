<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function auth(Request $request)
    {
        if (Auth::attempt(['login' => $request->login, 'password' => $request->password])) {
            $request->session()->regenerate();

            return redirect('/')->with('success', 'Вы авторизвались как админ!');
        }
        return back()->withErrors('Неверный логин/пароль');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
