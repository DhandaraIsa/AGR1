@extends('layouts.app')

@section('content')

<style>
body {
    background:
        radial-gradient(circle at top left, rgba(0,123,255,0.15), transparent 30%),
        radial-gradient(circle at bottom right, rgba(40,167,69,0.12), transparent 30%),
        linear-gradient(135deg, #07162c, #010814 70%);
    min-height: 100vh;
    overflow-x: hidden;
}

/* FUNDO DECORATIVO */
.auth-bg {
    position: absolute;
    inset: 0;
    overflow: hidden;
    z-index: 0;
}

.auth-circle {
    position: absolute;
    border-radius: 50%;
    filter: blur(90px);
}

.circle-1 {
    width: 260px;
    height: 260px;
    background: rgba(0, 123, 255, 0.18);
    top: -80px;
    left: -60px;
}

.circle-2 {
    width: 320px;
    height: 320px;
    background: rgba(40, 167, 69, 0.15);
    bottom: -100px;
    right: -100px;
}

/* CARD */
.register-card {
    position: relative;
    z-index: 2;

    background: rgba(255, 255, 255, 0.08);
    backdrop-filter: blur(18px);

    border: 1px solid rgba(255,255,255,0.08);

    border-radius: 28px;

    padding: 45px;

    box-shadow:
        0 15px 60px rgba(0,0,0,0.45),
        0 0 30px rgba(0,123,255,0.08);

    animation: fadeIn 0.8s ease;
    transition: 0.3s ease;
}

.register-card:hover {
    transform: translateY(-3px);
    box-shadow:
        0 20px 70px rgba(0,0,0,0.55),
        0 0 45px rgba(0,123,255,0.12);
}

/* ANIMAÇÃO */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(35px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* LOGO */
.logo {
    width: 190px;
    margin-bottom: 18px;
    filter: drop-shadow(0 0 12px rgba(255,255,255,0.12));
}

/* TITULOS */
.title {
    color: #fff;
    font-size: 30px;
    font-weight: 800;
    margin-bottom: 6px;
}

.sub {
    color: #b8c2d1;
    font-size: 14px;
    margin-bottom: 28px;
}

/* LABEL */
.form-label {
    color: #d9e2ef;
    font-size: 13px;
    margin-bottom: 8px;
    font-weight: 500;
}

/* INPUT */
.form-control {
    border-radius: 14px;
    padding: 15px;

    border: 1px solid rgba(255,255,255,0.08);

    background: rgba(255,255,255,0.10);

    color: #fff;

    transition: 0.3s ease;
}

.form-control:focus {
    background: rgba(255,255,255,0.14);

    border-color: rgba(0,123,255,0.6);

    box-shadow:
        0 0 0 3px rgba(0,123,255,0.15),
        0 0 15px rgba(0,123,255,0.20);

    color: #fff;
}

.form-control::placeholder {
    color: #c7d0db;
}

/* BOTÃO */
.btn-register {
    background: linear-gradient(90deg, #007bff, #28a745);

    border: none;

    border-radius: 50px;

    padding: 14px;

    font-weight: 700;

    font-size: 15px;

    color: #fff;

    transition: 0.3s ease;
}

.btn-register:hover {
    transform: translateY(-2px);

    box-shadow:
        0 10px 30px rgba(0,123,255,0.35),
        0 5px 20px rgba(40,167,69,0.25);

    opacity: 0.95;
}

/* LOGIN */
.login-link {
    color: #7dc8ff;
    text-decoration: none;
    font-weight: 600;
}

.login-link:hover {
    color: #fff;
}

/* ALERTA */
.error-box {
    background: rgba(220, 53, 69, 0.12);
    border: 1px solid rgba(220,53,69,0.25);
    border-radius: 12px;
    padding: 14px;
    color: #ffb8c0;
    font-size: 14px;
}

/* DIVISOR */
.divider {
    height: 1px;
    background: rgba(255,255,255,0.08);
    margin: 25px 0;
}

/* RESPONSIVO */
@media(max-width: 768px) {

    .register-card {
        padding: 30px;
    }

    .title {
        font-size: 24px;
    }

    .logo {
        width: 160px;
    }
}
</style>

<div class="auth-bg">
    <div class="auth-circle circle-1"></div>
    <div class="auth-circle circle-2"></div>
</div>

<div class="container py-5 position-relative">
    <div class="row justify-content-center align-items-center min-vh-100">

        <div class="col-lg-5 col-md-7">

            <div class="register-card">

                <!-- LOGO -->
                <div class="text-center">
                    <img src="{{ asset('img/AGR_LOGO.png') }}" class="logo">

                    <h1 class="title">
                        Criar Conta
                    </h1>

                    <p class="sub">
                        Entre para a AGR Medical Prime
                    </p>
                </div>

                <!-- FORM -->
                <form method="POST" action="{{ route('register.store') }}">

                    @csrf

                    <!-- NOME -->
                    <div class="mb-3">
                        <label class="form-label">
                            Nome Completo
                        </label>

                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            placeholder="Digite seu nome"
                            value="{{ old('name') }}"
                            required
                        >
                    </div>

                    <!-- EMAIL -->
                    <div class="mb-3">
                        <label class="form-label">
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            placeholder="Digite seu email"
                            value="{{ old('email') }}"
                            required
                        >
                    </div>

                    <!-- CPF -->
                    <div class="mb-3">
                        <label class="form-label">
                            CPF/CNPJ
                        </label>

                        <input
                            type="text"
                            name="cpf"
                            class="form-control"
                            maxlength="14"
                            inputmode="numeric"
                            pattern="[0-9]*"
                            placeholder="Digite somente números"
                            value="{{ old('cpf') }}"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                            required
                        >
                    </div>

                    <!-- TELEFONE -->
                    <div class="mb-3">
                        <label class="form-label">
                            Telefone
                        </label>

                        <input
                            type="text"
                            name="phone"
                            class="form-control"
                            placeholder="Digite seu telefone"
                            value="{{ old('phone') }}"
                        >
                    </div>

                    <!-- VENDEDOR -->
                    <div class="mb-3">
                        <label class="form-label">
                            Nome do vendedor (Opcional)
                        </label>

                        <input
                            type="text"
                            name="seller_name"
                            class="form-control"
                            placeholder="Opcional"
                            value="{{ old('seller_name') }}"
                        >
                    </div>

                    <!-- SENHA -->
                    <div class="mb-3">
                        <label class="form-label">
                            Senha
                        </label>

                        <input
                            type="password"
                            name="password"
                            class="form-control"
                            placeholder="Digite sua senha"
                            required
                        >
                    </div>

                    <!-- CONFIRMAR SENHA -->
                    <div class="mb-4">
                        <label class="form-label">
                            Confirmar Senha
                        </label>

                        <input
                            type="password"
                            name="password_confirmation"
                            class="form-control"
                            placeholder="Confirme sua senha"
                            required
                        >
                    </div>

                    <!-- ERROS -->
                    @if ($errors->any())

                        <div class="error-box mb-4">

                            @foreach ($errors->all() as $error)

                                <div>
                                    • {{ $error }}
                                </div>

                            @endforeach

                        </div>

                    @endif

                    <!-- BOTÃO -->
                    <button type="submit" class="btn btn-register w-100">
                        Criar Conta
                    </button>

                    <div class="divider"></div>

                    <!-- LOGIN -->
                    <div class="text-center text-light">

                        Já possui conta?

                        <a href="{{ route('login') }}" class="login-link">
                            Entrar
                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>
</div>

@endsection
