@extends('layouts.app')

@section('content')

<style>
body {
    background: linear-gradient(135deg, #0b1f3a, #020d1f);
}

/* CARD */
.register-card {
    background: rgba(255, 255, 255, 0.08);
    backdrop-filter: blur(15px);
    border-radius: 20px;
    padding: 40px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.4);
    animation: fadeIn 0.8s ease;
}

/* ANIMAÇÃO */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}

/* INPUT */
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

/* LABEL */
.form-label {
    color: #ddd;
    font-size: 14px;
}

/* BOTÃO */
.btn-register {
    background: #28a745;
    border-radius: 30px;
    padding: 12px;
    font-weight: bold;
    border: none;
}

.btn-register:hover {
    background: #218838;
}

/* TEXTO */
.title {
    color: #fff;
}

.sub {
    color: #ccc;
    font-size: 14px;
}

/* LOGO */
.logo {
    width: 180px;
    margin-bottom: 15px;
}
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">

            <div class="register-card text-center">

                <!-- LOGO -->
                <img src="{{ asset('img/AGR_LOGO.png') }}" class="logo">

                <h4 class="title fw-bold">Criar Conta</h4>
                <p class="sub mb-4">Cadastre-se na AGR Medical Prime</p>

                <!-- FORM CORRETO -->
                <form method="POST" action="{{ route('register.store') }}">
                    @csrf

                    <div class="mb-3 text-start">
                        <label class="form-label">Nome</label>
                        <input type="text" name="name" class="form-control" placeholder="Digite seu nome" required>
                    </div>

                    <div class="mb-3 text-start">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Digite seu email" required>
                    </div>

                    <div class="mb-3 text-start">
                        <label class="form-label">CPF</label>
                        <input type="text" name="cpf" class="form-control" placeholder="Digite seu CPF">
                    </div>

                    <div class="mb-3 text-start">
                        <label class="form-label">Telefone</label>
                        <input type="text" name="phone" class="form-control" placeholder="Digite seu telefone">
                    </div>

                    <div class="mb-3 text-start">
                        <label class="form-label">Nome do vendedor (Opcional)</label>
                        <input type="text" name="seller_name" class="form-control" placeholder="Opcional">
                    </div>

                    <div class="mb-3 text-start">
                        <label class="form-label">Senha</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Digite sua senha" required>
                    </div>

                    <!-- ERROS -->
                    @if ($errors->any())
                        <div class="text-danger text-start mb-3">
                            @foreach ($errors->all() as $error)
                                <div>• {{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <button type="submit" class="btn btn-register w-100">
                        Criar Conta
                    </button>
                </form>

                <p class="mt-4 text-light">
                    Já tem conta?
                    <a href="{{ route('login') }}" class="text-info">Entrar</a>
                </p>

            </div>

        </div>
    </div>
</div>

@endsection