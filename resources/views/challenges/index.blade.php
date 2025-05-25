{{-- Example assuming a base layout like layouts.app --}}
@extends('layouts.app') {{-- Or your actual base layout --}}

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Lista de Desafíos</h1>
        @can('create-challenge')
            <a href="{{ route('challenges.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Crear Nuevo Desafío
            </a>
        @endcan
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if($challenges->isEmpty())
        <p class="text-gray-600">No hay desafíos disponibles en este momento.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($challenges as $challenge)
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <div class="p-6">
                        <h2 class="text-2xl font-semibold text-gray-700 mb-2">{{ $challenge->name }}</h2>
                        <p class="text-gray-600 text-sm mb-1">
                            <strong>Fecha:</strong> {{ $challenge->date ? \Carbon\Carbon::parse($challenge->date)->format('d/m/Y') : 'N/A' }}
                        </p>
                        <p class="text-gray-600 text-sm mb-3">
                            <strong>Hora:</strong> {{ $challenge->time ? \Carbon\Carbon::parse($challenge->time)->format('H:i') : 'N/A' }}
                        </p>
                        <p class="text-gray-600 text-sm mb-4">
                            <strong>Estado:</strong> 
                            <span class="{{ $challenge->is_public ? 'bg-green-200 text-green-800' : 'bg-yellow-200 text-yellow-800' }} text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">
                                {{ $challenge->is_public ? 'Público' : 'Privado' }}
                            </span>
                        </p>
                        <a href="{{ route('challenges.show', $challenge) }}" class="inline-block bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded text-sm">
                            Ver Detalles
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection

{{-- Basic layouts.app if not existing --}}
@php
if (!function_exists('view_exists')) {
    function view_exists($view) {
        return app('view')->exists($view);
    }
}
@endphp

@if(!view_exists('layouts.app'))
    {{-- This is a fallback if layouts.app does not exist. Create a real one for your project. --}}
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Padel App</title>
        <link href="https://unpkg.com/tailwindcss@^2.0/dist/tailwind.min.css" rel="stylesheet"> {{-- For Tailwind CSS --}}
         <style>
            body { font-family: 'Nunito', sans-serif; }
            /* Add any global styles or overrides here */
        </style>
    </head>
    <body class="bg-gray-100">
        <nav class="bg-white shadow-md py-4">
            <div class="container mx-auto px-6 flex justify-between items-center">
                <a href="{{ url('/') }}" class="text-xl font-semibold text-gray-700">PadelApp</a>
                <div>
                    @guest
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-800 mr-4">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-gray-600 hover:text-gray-800">Register</a>
                        @endif
                    @else
                        <span class="text-gray-600 mr-4">Welcome, {{ Auth::user()->name }}</span>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                           class="text-red-500 hover:text-red-700">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                    @endguest
                </div>
            </div>
        </nav>
        <main class="py-8">
            @yield('content')
        </main>
    </body>
    </html>
@endif
