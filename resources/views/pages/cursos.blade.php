@extends('layouts.app')

@section('content')

@php
    use Illuminate\Support\Str;
@endphp

<div class="container mt-5">
    <h2 class="mb-4 text-center text-white">Cursos</h2>

    <div class="row">
        @forelse ($courses as $curso)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">

                    {{-- IMAGEM --}}
                    <img
                        src="{{ asset($curso->banner_image ?? 'img/default.jpg') }}"
                        class="card-img-top"
                        alt="{{ $curso->title }}"
                        style="height: 200px; object-fit: cover;"
                    >

                    <div class="card-body d-flex flex-column">

                        {{-- TÍTULO --}}
                        <h5 class="card-title">
                            {{ $curso->title }}
                        </h5>

                        {{-- DESCRIÇÃO --}}
                        <p class="card-text text-muted">
                            {{ Str::limit($curso->description, 80) }}
                        </p>

                        {{-- DATA --}}
                        <p class="mb-2">
                            <strong>Data:</strong><br>
                            {{ \Carbon\Carbon::parse($curso->date_start)->format('d/m/Y') }}
                            @if($curso->date_end)
                                até {{ \Carbon\Carbon::parse($curso->date_end)->format('d/m/Y') }}
                            @endif
                        </p>

                        {{-- LOCAL --}}
                        <p class="mb-3">
                            <strong>Local:</strong><br>
                            {{ $curso->location }}
                        </p>

                        {{-- WHATSAPP (sempre no final do card) --}}
                        <div class="mt-auto">
                            <div class="d-flex gap-2">
                                
                                <a href="https://wa.me/5511918579261" target="_blank" class="btn btn-success w-50">
                                    Comercial
                                </a>

                                <a href="https://wa.me/5511921808431" target="_blank" class="btn btn-success w-50">
                                    Suporte
                                </a>

                            </div>
                        </div>

                    </div> {{-- FECHA card-body --}}
                </div>
            </div>
        @empty
            <p class="text-center text-white">Nenhum curso disponível.</p>
        @endforelse
    </div>
</div>

@endsection