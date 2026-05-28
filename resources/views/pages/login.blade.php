@extends('layouts.app')

@section('content')

<style>
body {
    background: linear-gradient(135deg, #0b1f3a, #020d1f);
}

.login-card {
    background: rgba(255, 255, 255, 0.08);
    backdrop-filter: blur(15px);
    border-radius: 20px;
    padding: 40px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.4);
    animation: fadeIn 0.8s ease;
}

.logo {
    width: 180px;
    margin-bottom: 20px;
    transition: 0.3s;
    filter: drop-shadow(0px 6px 20px rgba(0,0,0,0.7));
}

.logo:hover {
    transform: scale(1.05);
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.form-control {
    border-radius: 12px;
    padding: 14px;
    border: none;
    background: rgba(255,255,255,0.15);
    color: #fff;
}

.form-control::placeholder {
    color: #ddd;
}

.form-label {
    color: #ddd;
    font-size: 14px;
}

.btn-login {
    background: #28a745;
    border-radius: 30px;
    padding: 12px;
    font-weight: bold;
    border: none;
}

.btn-login:hover {
    background: #218838;
}

.login-title {
    color: #fff;
}

.login-sub {
    color: #ccc;
    font-size: 14px;
}

.eye-icon {
    position: absolute;
    right: 15px;
    top: 42px;
    cursor: pointer;
    color: #ccc;
}
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-4">

            <div class="login-card text-center">


                <img src="{{ asset('img/AGR_LOGO.png') }}" class="logo">


                <h4 class="login-title fw-bold mb-1">
                    AGR Medical Prime
                </h4>

                <p class="login-sub mb-4">
                    Plataforma exclusiva para clientes premium
                </p>


                <form method="POST" action="{{ route('login.auth') }}">
                    @csrf


                    <div class="mb-3 text-start">
                        <label class="form-label">E-mail</label>
                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            placeholder="Digite seu e-mail"
                        >
                    </div>


                    <div class="mb-3 text-start position-relative">
                        <label class="form-label">Senha</label>

                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="form-control pe-5"
                            placeholder="Digite sua senha"
                        >

                        <span onclick="togglePassword()" id="eyeIcon" class="eye-icon">
                            👁️
                        </span>
                    </div>

                    @error('email')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror


                    <button type="submit" class="btn btn-login w-100">
                        Entrar
                    </button>


                    <hr class="my-4 text-light">

                    <p class="text-light">Acesse sua conta premium para liberar todo o AGR Prime.</p>

                </form>


                <p class="mt-4 mb-0 text-light">
                    Não tem conta?
                    <a href="{{ route('register') }}" class="text-info">Criar conta</a>
                </p>

            </div>

        </div>
    </div>
</div>

<script>
function togglePassword() {
    const input = document.getElementById("password");
    const icon = document.getElementById("eyeIcon");

    if (input.type === "password") {
        input.type = "text";
        icon.innerHTML = "🙈";
    } else {
        input.type = "password";
        icon.innerHTML = "👁️";
    }
}
</script>

@endsection
