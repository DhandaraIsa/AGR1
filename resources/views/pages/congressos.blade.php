@extends('layouts.app')

@section('content')

@php
    use Illuminate\Support\Str;
@endphp

<div class="container mt-5">
    <h2 class="mb-4 text-center text-white">Congressos</h2>

    <div class="row">
        @forelse ($congresses as $congress)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">

                    {{-- IMAGEM --}}
                    <img
                        src="{{ asset($congress->banner_image ?? 'img/default.jpg') }}"
                        class="card-img-top"
                        alt="{{ $congress->title }}"
                        style="height: 200px; object-fit: cover;"
                    >

                    <div class="card-body d-flex flex-column">

                        {{-- TÍTULO --}}
                        <h5 class="card-title">
                            {{ $congress->title }}
                        </h5>

                        {{-- DESCRIÇÃO --}}
                        <p class="card-text text-muted">
                            {{ Str::limit($congress->description, 80) }}
                        </p>

                        {{-- DATA --}}
                        <p class="mb-1">
                            <strong>Data:</strong><br>
                            {{ \Carbon\Carbon::parse($congress->date_start)->format('d/m/Y') }}
                            @if($congress->date_end)
                                até {{ \Carbon\Carbon::parse($congress->date_end)->format('d/m/Y') }}
                            @endif
                        </p>

                        {{-- LOCAL --}}
                        <p class="mb-3">
                            <strong>Local:</strong><br>
                            {{ $congress->location }}
                        </p>

                        {{-- SANFONA WHATSAPP --}}
                        <div class="mt-auto">

                            <div class="accordion" id="accordionWhats{{ $congress->id }}">

                                <div class="accordion-item border-0">

                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed btn-whatsapp"
                                            type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#collapse{{ $congress->id }}">
                                            Falar com vendedor 💬
                                        </button>
                                    </h2>

                                    <div id="collapse{{ $congress->id }}" class="accordion-collapse collapse">
                                        <div class="accordion-body">

                                            <div class="row">

                                                <div class="col-6 mb-2">
                                                    <a href="https://wa.me/5511958193500?text={{ urlencode('Olá, quero o congresso ' . $congress->title) }}"
                                                        target="_blank"
                                                        class="seller-btn">
                                                        Wellington
                                                    </a>
                                                </div>

                                                <div class="col-6 mb-2">
                                                    <a href="https://wa.me/5511913718434?text={{ urlencode('Olá, quero o congresso ' . $congress->title) }}"
                                                        target="_blank"
                                                        class="seller-btn">
                                                        Juliana Costa
                                                    </a>
                                                </div>

                                                <div class="col-6 mb-2">
                                                    <a href="https://wa.me/5511999999993?text={{ urlencode('Olá, quero o congresso ' . $congress->title) }}"
                                                        target="_blank"
                                                        class="seller-btn">
                                                        Carlos
                                                    </a>
                                                </div>

                                                <div class="col-6 mb-2">
                                                    <a href="https://wa.me/5511939065802?text={{ urlencode('Olá, quero o congresso ' . $congress->title) }}"
                                                        target="_blank"
                                                        class="seller-btn">
                                                        Kauane
                                                    </a>
                                                </div>

                                                <div class="col-6 mb-2">
                                                    <a href="https://wa.me/5511970658756?text={{ urlencode('Olá, quero o congresso ' . $congress->title) }}"
                                                        target="_blank"
                                                        class="seller-btn">
                                                        Gabriel Monici
                                                    </a>
                                                </div>

                                                <div class="col-6 mb-2">
                                                    <a href="https://wa.me/5511960796993?text={{ urlencode('Olá, quero o congresso ' . $congress->title) }}"
                                                        target="_blank"
                                                        class="seller-btn">
                                                        Matheus
                                                    </a>
                                                </div>

                                        

                                            </div>

                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-white">Nenhum congresso disponível.</p>
        @endforelse
    </div>
</div>

@endsection