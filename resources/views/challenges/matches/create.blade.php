{{-- Extends a base layout if you have one, e.g., @extends('layouts.app') --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Partido para {{ $challenge->name }}</title>
    {{-- Basic styling for demonstration --}}
    <style>
        body { font-family: sans-serif; margin: 20px; background-color: #f4f4f4; color: #333; }
        .container { max-width: 800px; margin: auto; padding: 20px; background-color: #fff; border: 1px solid #ccc; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h1 { color: #007bff; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 8px; font-weight: bold; }
        input[type="text"], input[type="date"], input[type="time"], select {
            width: 100%; padding: 10px; margin-bottom: 5px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;
        }
        button { padding: 12px 18px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; }
        button:hover { background-color: #0056b3; }
        .alert { padding: 15px; margin-bottom: 20px; border-radius: 4px; }
        .alert-success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-danger { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .hidden { display: none; }
        .radio-group label { font-weight: normal; margin-right:15px; }
        .link-group a { margin-right: 10px; color: #007bff; text-decoration: none; }
        .link-group a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Crear Partido para: {{ $challenge->name }}</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('challenges.matches.store', $challenge) }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Tipo de Partido:</label>
                <div class="radio-group">
                    <input type="radio" name="match_type" value="team" id="match_type_team" checked onchange="toggleMatchFields()">
                    <label for="match_type_team">Por Equipos/Parejas</label>
                    <input type="radio" name="match_type" value="single" id="match_type_single" onchange="toggleMatchFields()">
                    <label for="match_type_single">Individual</label>
                </div>
            </div>

            {{-- Team Selection Fields --}}
            <div id="team_fields">
                <div class="form-group">
                    <label for="team1_id">Equipo/Pareja 1:</label>
                    <select name="team1_id" id="team1_id">
                        <option value="">-- Seleccionar Equipo 1 --</option>
                        @foreach($teams as $team_id => $players)
                            <option value="{{ $team_id }}" {{ old('team1_id') == $team_id ? 'selected' : '' }}>
                                Equipo {{ $team_id }} (
                                @foreach($players as $index => $player)
                                    {{ $player->user_id ? $player->user->name : $player->name }}@if(!$loop->last), @endif
                                @endforeach
                                )
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="team2_id">Equipo/Pareja 2:</label>
                    <select name="team2_id" id="team2_id">
                        <option value="">-- Seleccionar Equipo 2 --</option>
                         @foreach($teams as $team_id => $players)
                            <option value="{{ $team_id }}" {{ old('team2_id') == $team_id ? 'selected' : '' }}>
                                Equipo {{ $team_id }} (
                                @foreach($players as $index => $player)
                                    {{ $player->user_id ? $player->user->name : $player->name }}@if(!$loop->last), @endif
                                @endforeach
                                )
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Single Player Selection Fields --}}
            <div id="single_player_fields" class="hidden">
                <div class="form-group">
                    <label for="player1_id">Jugador 1:</label>
                    <select name="player1_id" id="player1_id">
                        <option value="">-- Seleccionar Jugador 1 --</option>
                        @foreach($individualPlayers as $player)
                            <option value="{{ $player->id }}" {{ old('player1_id') == $player->id ? 'selected' : '' }}>
                                {{ $player->user_id ? $player->user->name : $player->name }}
                                @if($player->team_id) (Equipo {{ $player->team_id }}) @endif
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="player2_id">Jugador 2:</label>
                    <select name="player2_id" id="player2_id">
                        <option value="">-- Seleccionar Jugador 2 --</option>
                         @foreach($individualPlayers as $player)
                            <option value="{{ $player->id }}" {{ old('player2_id') == $player->id ? 'selected' : '' }}>
                                {{ $player->user_id ? $player->user->name : $player->name }}
                                @if($player->team_id) (Equipo {{ $player->team_id }}) @endif
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="match_date">Fecha del Partido:</label>
                <input type="date" name="match_date" id="match_date" value="{{ old('match_date') }}">
            </div>

            <div class="form-group">
                <label for="match_time">Hora del Partido:</label>
                <input type="time" name="match_time" id="match_time" value="{{ old('match_time') }}">
            </div>

            <div class="form-group">
                <label for="status">Estado Inicial:</label>
                <select name="status" id="status">
                    <option value="scheduled" {{ old('status', 'scheduled') == 'scheduled' ? 'selected' : '' }}>Programado</option>
                    <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>En Progreso</option>
                    <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completado</option>
                    <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelado</option>
                </select>
            </div>

            <button type="submit">Crear Partido</button>
        </form>

        <div class="link-group" style="margin-top: 30px;">
            <a href="{{ route('challenges.show', $challenge) }}">Volver al Desafío</a>
            <br>
            <a href="{{ route('challenges.index') }}">Volver a la Lista de Desafíos</a>
        </div>
    </div>

    <script>
        function toggleMatchFields() {
            const matchType = document.querySelector('input[name="match_type"]:checked').value;
            const teamFields = document.getElementById('team_fields');
            const singlePlayerFields = document.getElementById('single_player_fields');

            if (matchType === 'team') {
                teamFields.classList.remove('hidden');
                singlePlayerFields.classList.add('hidden');
            } else if (matchType === 'single') {
                teamFields.classList.add('hidden');
                singlePlayerFields.classList.remove('hidden');
            }
        }
        // Initialize fields based on current selection (e.g., on page load if form was re-rendered due to error or old input)
        document.addEventListener('DOMContentLoaded', function() {
            // If old('match_type') exists and is 'single', trigger toggle
            var oldMatchType = "{{ old('match_type') }}";
            if (oldMatchType === 'single') {
                document.getElementById('match_type_single').checked = true;
            } else {
                 document.getElementById('match_type_team').checked = true; // Default
            }
            toggleMatchFields();
        });
    </script>
</body>
</html>
