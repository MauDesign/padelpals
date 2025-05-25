{{-- Extends a base layout if you have one, e.g., @extends('layouts.app') --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Jugadores a {{ $challenge->name }}</title>
    {{-- Basic styling for demonstration --}}
    <style>
        body { font-family: sans-serif; margin: 20px; }
        .container { max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ccc; border-radius: 8px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input[type="text"], select, input[type="radio"], input[type="checkbox"] {
            width: 100%; padding: 8px; margin-bottom: 5px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;
        }
        button { padding: 10px 15px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background-color: #0056b3; }
        .alert { padding: 10px; margin-bottom: 15px; border-radius: 4px; }
        .alert-success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-danger { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .hidden { display: none; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Añadir Jugadores a: {{ $challenge->name }}</h1>

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

        <form action="{{ route('challenges.players.store', $challenge) }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Tipo de Jugador:</label>
                <div>
                    <input type="radio" name="player_type" value="user" id="player_type_user" checked onchange="togglePlayerFields()">
                    <label for="player_type_user">Usuario Registrado</label>
                </div>
                <div>
                    <input type="radio" name="player_type" value="guest" id="player_type_guest" onchange="togglePlayerFields()">
                    <label for="player_type_guest">Invitado</label>
                </div>
            </div>

            <div class="form-group" id="user_selection_field">
                <label for="user_id">Seleccionar Usuario:</label>
                <select name="user_id" id="user_id">
                    <option value="">-- Seleccionar Usuario --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group hidden" id="guest_name_field">
                <label for="guest_name">Nombre del Invitado:</label>
                <input type="text" name="guest_name" id="guest_name" value="{{ old('guest_name') }}">
            </div>

            <div class="form-group">
                <label for="team_id">ID de Equipo/Pareja (opcional):</label>
                <input type="text" name="team_id" id="team_id" value="{{ old('team_id') }}">
            </div>

            <button type="submit">Añadir Jugador</button>
        </form>

        <hr style="margin-top: 20px; margin-bottom: 20px;">

        <h2>Jugadores Actuales ({{ $challenge->players->count() }} / {{ $challenge->No_players ?? 'N/A' }})</h2>
        @if($challenge->players->count() > 0)
            <ul>
                @foreach($challenge->players as $challengePlayer)
                    <li>
                        @if($challengePlayer->user_id)
                            {{ $challengePlayer->user->name }} (Usuario Registrado)
                        @else
                            {{ $challengePlayer->name }} (Invitado)
                        @endif
                        @if($challengePlayer->team_id)
                            - Equipo: {{ $challengePlayer->team_id }}
                        @endif
                        {{-- Add a form/button to remove player or change team if needed --}}
                    </li>
                @endforeach
            </ul>
        @else
            <p>Aún no hay jugadores en este desafío.</p>
        @endif

        <div style="margin-top: 20px;">
            <a href="{{ route('challenges.show', $challenge) }}">Volver al Desafío</a>
            <br>
            <a href="{{ route('challenges.index') }}">Volver a la Lista de Desafíos</a>
        </div>
    </div>

    <script>
        function togglePlayerFields() {
            const playerType = document.querySelector('input[name="player_type"]:checked').value;
            const userSelectionField = document.getElementById('user_selection_field');
            const guestNameField = document.getElementById('guest_name_field');

            if (playerType === 'user') {
                userSelectionField.classList.remove('hidden');
                guestNameField.classList.add('hidden');
            } else if (playerType === 'guest') {
                userSelectionField.classList.add('hidden');
                guestNameField.classList.remove('hidden');
            }
        }
        // Initialize fields based on current selection (e.g., on page load if form was re-rendered due to error)
        document.addEventListener('DOMContentLoaded', togglePlayerFields);
    </script>
</body>
</html>
