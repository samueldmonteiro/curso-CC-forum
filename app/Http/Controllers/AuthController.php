<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginForm()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        return view('login');
    }

    public function registerForm()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        return view('register');
    }

    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        if (!$email || !$password) {
            //return response()->json(['status' => false, 'message' => 'Preecha todos os campos corretamente!']);
            return message()->error('Preecha todos os campos corretamente!')->status(false)->json();
        }

        $loginError = 'Erro ao efetuar login, tente novamente!';
        if (
            !filter_var($email, FILTER_VALIDATE_EMAIL) ||
            strlen($email) > 30 || strlen($password) > 30
        ) {
            return message()->error($loginError)->status(false)->json();
        }

        if (!Auth::attempt(['email' => $email, 'password' => $password])) {
            return message()->error($loginError)->status(false)->json();
        }

        $request->session()->regenerate();
        return message()->success('Login efetuado com sucesso!')
            ->status(true)->more(['redirect' => route('home')])->json();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('loginForm');
    }
}
