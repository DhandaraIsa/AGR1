@php
    
    use Illuminate\Support\Str;
@endphp


@extends('layouts.app')


@section('content')

<div class="container mt-5">
    <h2 class="mb-4 text-center">Eventos</h2>

    <div class="row">
        @forelse ($events as $event)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">

                    
                    <img 
                        src="{{ asset($event->banner_image ?? 'img/default.jpg') }}" 
                        class="card-img-top" 
                        style="height: 200px; object-fit: cover;"
                    >

                    <div class="card-body d-flex flex-column">

                        
                        <h5 class="card-title">
                            {{ $event->title }}
                        </h5>

                        
                        <p class="card-text text-muted">
                            {{ Str::limit($event->description, 80) }}
                        </p>

                        
                        <p class="mb-1">
                            <strong>Data:</strong><br>
                            {{ \Carbon\Carbon::parse($event->date_start)->format('d/m/Y') }}
                            @if($event->date_end)
                                até {{ \Carbon\Carbon::parse($event->date_end)->format('d/m/Y') }}
                            @endif
                        </p>

                        
                        <p class="mb-2">
                            <strong>Local:</strong><br>
                            {{ $event->location }}
                        </p>

                        
                        <a href="#" class="btn btn-primary mt-auto">
                            Ver mais
                        </a>

                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">Nenhum evento disponível.</p>
        @endforelse
    </div>
</div>

@endsection