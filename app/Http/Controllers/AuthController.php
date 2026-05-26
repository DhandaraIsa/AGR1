<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;



class AuthController extends Controller
{
    // 🔹 Tela login
    public function login()
    {
        return view('pages.login');
    }

    // 🔹 Autenticar
    public function authenticate(Request $request)
       
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/'); // ou dashboard
        }

        return back()->withErrors([
            'email' => 'Email ou senha inválidos'
        ]);
    }

    // 🔹 Logout
    public function logout(Request $request)
        
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    // 🔹 Tela cadastro
    public function register()
    {
        return view('pages.register');
    }

    // 🔹 Salvar cadastro
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'cpf' => $request->cpf,
            'phone' => $request->phone,
            'seller_name' => $request->seller_name,
            'password' => Hash::make($request->password)
        ]);

        Auth::login($user);

        return redirect('/');
    }

    public function redirectToGoogle()
{
    return Socialite::driver('google')->redirect();
}

public function handleGoogleCallback()
{
    $googleUser = Socialite::driver('google')->user();

    $user = User::where('email', $googleUser->getEmail())->first();

    if (!$user) {
        $user = User::create([
            'name' => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
            'password' => bcrypt('123456') // pode melhorar depois
        ]);
    }

    Auth::login($user);

    return redirect('/');
}
}