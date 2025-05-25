{{-- Example assuming a base layout like layouts.app --}}
@extends('layouts.app') {{-- Or your actual base layout --}}

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        {{-- Challenge Details Section --}}
        <div class="p-6 border-b border-gray-200">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-4xl font-bold text-gray-800 mb-3">{{ $challenge->name }}</h1>
                    <p class="text-gray-600 text-lg mb-1">
                        <strong>Fecha y Hora:</strong> 
                        {{ $challenge->date ? \Carbon\Carbon::parse($challenge->date)->format('d/m/Y') : 'N/A' }}
                        a las 
                        {{ $challenge->time ? \Carbon\Carbon::parse($challenge->time)->format('H:i') : 'N/A' }}
                    </p>
                    <p class="text-gray-600 text-lg mb-1"><strong>Pistas:</strong> {{ $challenge->courts ?? 'N/A' }}</p>
                    <p class="text-gray-600 text-lg mb-1"><strong>Máx. Jugadores:</strong> {{ $challenge->No_players ?? 'N/A' }}</p>
                    <p class="text-gray-600 text-lg mb-1">
                        <strong>Visibilidad:</strong> 
                        <span class="{{ $challenge->is_public ? 'bg-green-200 text-green-800' : 'bg-yellow-200 text-yellow-800' }} text-sm font-semibold mr-2 px-2.5 py-0.5 rounded">
                            {{ $challenge->is_public ? 'Público' : 'Privado' }}
                        </span>
                    </p>
                    @if($challenge->club)
                        <p class="text-gray-600 text-lg mb-1"><strong>Club:</strong> {{ $challenge->club->name ?? 'N/A' }}</p>
                    @endif
                    <p class="text-gray-600 text-lg mb-1"><strong>Tipo:</strong> {{ $challenge->type ?? 'N/A' }}</p>
                    <p class="text-gray-600 text-lg mb-1"><strong>Puntos:</strong> {{ $challenge->endpoint ?? 'N/A' }}</p>
                    <p class="text-gray-600 text-lg mb-1"><strong>Tie-Break:</strong> {{ $challenge->tie_break ? 'Sí' : 'No' }}</p>
                    <p class="text-gray-600 text-lg mb-1"><strong>Matching:</strong> {{ $challenge->matching ?? 'N/A' }}</p>
                    @if($challenge->user)
                        <p class="text-gray-600 text-lg mb-3"><strong>Creado por:</strong> {{ $challenge->user->name }}</p>
                    @endif
                </div>
                <div class="flex flex-col space-y-2">
                    @can('manage-challenge-players', $challenge)
                        <a href="{{ route('challenges.players.createForm', $challenge) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm text-center">
                            Gestionar Jugadores
                        </a>
                    @endcan
                    @can('create-challenge-match', $challenge)
                        <a href="{{ route('challenges.matches.create', $challenge) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded text-sm text-center">
                            Crear Partido
                        </a>
                    @endcan
                    @can('update-challenge', $challenge)
                        {{-- <a href="{{ route('challenges.edit', $challenge) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded text-sm text-center">
                            Editar Desafío
                        </a> --}}
                    @endcan
                </div>
            </div>
        </div>

        {{-- Players Section --}}
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Jugadores ({{ $challenge->players->count() }} / {{ $challenge->No_players ?? 'N/A' }})</h2>
            @if($challenge->players->isEmpty())
                <p class="text-gray-600">Aún no hay jugadores inscritos en este desafío.</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($challenge->players as $challengePlayer)
                        <div class="bg-gray-50 p-4 rounded-lg shadow">
                            <p class="font-semibold text-gray-800">
                                {{ $challengePlayer->user_id ? $challengePlayer->user->name : $challengePlayer->name }}
                                <span class="text-xs {{ $challengePlayer->user_id ? 'text-blue-600' : 'text-purple-600' }}">
                                    ({{ $challengePlayer->user_id ? 'Registrado' : 'Invitado' }})
                                </span>
                            </p>
                            @if($challengePlayer->team_id)
                                <p class="text-sm text-gray-500">Equipo/Pareja: {{ $challengePlayer->team_id }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Matches Section --}}
        <div class="p-6">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Partidos</h2>
            @if($challenge->matches->isEmpty())
                <p class="text-gray-600">Aún no se han creado partidos para este desafío.</p>
            @else
                <div class="space-y-4">
                    @foreach($challenge->matches as $match)
                        @php
                            // Helper to get player names for a team_id within this challenge
                            $getTeamPlayerNames = function($team_id) use ($challenge) {
                                if (!$team_id) return collect();
                                return $challenge->players->where('team_id', $team_id)
                                                        ->map(function($cp) {
                                                            return $cp->user_id ? $cp->user->name : $cp->name;
                                                        });
                            };
                        @endphp
                        <div class="bg-gray-50 p-4 rounded-lg shadow">
                            <h3 class="text-xl font-medium text-gray-800 mb-2">
                                @if($match->team1_id && $match->team2_id)
                                    Equipo {{ $match->team1_id }} ({{ $getTeamPlayerNames($match->team1_id)->join(', ') }})
                                    vs 
                                    Equipo {{ $match->team2_id }} ({{ $getTeamPlayerNames($match->team2_id)->join(', ') }})
                                @elseif($match->player1_id && $match->player2_id)
                                    {{ $match->player1 ? ($match->player1->user_id ? $match->player1->user->name : $match->player1->name) : 'Jugador 1 N/A' }} 
                                    vs 
                                    {{ $match->player2 ? ($match->player2->user_id ? $match->player2->user->name : $match->player2->name) : 'Jugador 2 N/A' }}
                                @else
                                    Partido no definido
                                @endif
                            </h3>
                            <p class="text-sm text-gray-600">
                                <strong>Fecha:</strong> {{ $match->match_date ? \Carbon\Carbon::parse($match->match_date)->format('d/m/Y') : 'Por definir' }}
                                @if($match->match_time)
                                    <strong>Hora:</strong> {{ \Carbon\Carbon::parse($match->match_time)->format('H:i') }}
                                @endif
                            </p>
                            <p class="text-sm text-gray-600"><strong>Estado:</strong> <span class="capitalize">{{ $match->status ?? 'N/A' }}</span></p>
                            @if($match->status == 'completed')
                                <p class="text-sm text-gray-600">
                                    <strong>Resultado:</strong> 
                                    {{ $match->score_team1 ?? '0' }} - {{ $match->score_team2 ?? '0' }}
                                </p>
                                @if($match->winner_team_id)
                                    <p class="text-sm text-gray-600"><strong>Ganador:</strong> Equipo {{ $match->winner_team_id }} ({{ $getTeamPlayerNames($match->winner_team_id)->join(', ') }})</p>
                                @elseif($match->player1_id && $match->player2_id && ($match->score_team1 || $match->score_team2))
                                     <p class="text-sm text-gray-600">
                                        <strong>Ganador:</strong> 
                                        @php
                                            if ((int)$match->score_team1 > (int)$match->score_team2) {
                                                echo $match->player1 ? ($match->player1->user_id ? $match->player1->user->name : $match->player1->name) : 'Jugador 1';
                                            } elseif ((int)$match->score_team2 > (int)$match->score_team1) {
                                                echo $match->player2 ? ($match->player2->user_id ? $match->player2->user->name : $match->player2->name) : 'Jugador 2';
                                            } else if ((int)$match->score_team1 == (int)$match->score_team2 && ($match->score_team1 != null || $match->score_team2 != null)) {
                                                echo 'Empate';
                                            } else {
                                                echo 'No definido';
                                            }
                                        @endphp
                                    </p>
                                @endif
                            @endif
                             {{-- Link to update scores could go here for authorized users --}}
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <div class="mt-8">
        <a href="{{ route('challenges.index') }}" class="text-blue-500 hover:text-blue-700">&larr; Volver a la Lista de Desafíos</a>
    </div>
</div>
@endsection

{{-- Fallback layouts.app if not existing --}}
@php
if (!function_exists('view_exists')) {
    function view_exists($view) {
        return app('view')->exists($view);
    }
}
@endphp

@if(!view_exists('layouts.app'))
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Padel App - {{ $challenge->name ?? 'Detalle del Desafío' }}</title>
        <link href="https://unpkg.com/tailwindcss@^2.0/dist/tailwind.min.css" rel="stylesheet">
         <style> body { font-family: 'Nunito', sans-serif; } </style>
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
