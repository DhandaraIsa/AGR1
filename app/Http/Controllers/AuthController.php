<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    // 🔹 Tela Login
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        return view('pages.login');
    }

    // 🔹 Autenticar usuário
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'Email ou senha inválidos'
        ])->onlyInput('email');
    }

    // 🔹 Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    // 🔹 Tela cadastro
    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        return view('pages.register');
    }

    // 🔹 Salvar cadastro
    public function store(Request $request)
    {
        $cpf_cnpj = preg_replace('/\D/', '', $request->input('cpf'));

        $request->merge(['cpf_cnpj' => $cpf_cnpj]);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'cpf_cnpj' => ['required', 'digits_between:11,14', 'unique:users,cpf_cnpj'],
            'phone' => ['nullable', 'regex:/^[0-9]+$/'],
            'seller_name' => ['nullable', 'string', 'max:255'],
            'password' => ['required', 'min:6', 'confirmed']
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'cpf_cnpj' => $cpf_cnpj,
            'phone' => $request->phone,
            'seller_name' => $request->seller_name,
            'password' => Hash::make($request->password)
        ]);

        Auth::login($user);

        return redirect()->route('home');
    }

    // 🔹 Google Login
    // public function redirectToGoogle()
    // {
    //     return Socialite::driver('google')->redirect();
    // }

    // // 🔹 Callback Google
    // public function handleGoogleCallback()
    // {
    //     $googleUser = Socialite::driver('google')->user();

    //     $user = User::where('email', $googleUser->getEmail())->first();

    //     if (!$user) {

    //         $user = User::create([
    //             'name' => $googleUser->getName(),
    //             'email' => $googleUser->getEmail(),

    //             // CPF fica null no login Google
    //             'cpf' => null,

    //             'password' => Hash::make(uniqid())
    //         ]);
    //     }

    //     Auth::login($user);

    //     return redirect('/');
    // }
}
