<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ChallengeRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate; // Add this line
// Remove if Permission model is not directly used in controller after Gate setup
// use App\Models\Permission; 

class ChallengeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $publicChallenges = Challenge::where('is_public', true)->get();
        $privateChallenges = collect();

        if ($user) {
            // Using Gate-like logic for fetching index, though Gates are typically for authorizing actions on specific instances
            // For index views, we often filter based on user capabilities or roles directly in the query
            if ($user->roles()->where('name', 'admin')->exists()) {
                $privateChallenges = Challenge::where('is_public', false)->get();
            } else {
                $privateChallenges = Challenge::where('is_public', false)
                                            ->where('user_id', $user->id)
                                            // Consider adding challenges where user is a participant
                                            ->get();
            }
        }
        $challenges = $publicChallenges->merge($privateChallenges)->unique('id');
        return view('challenges.index', compact('challenges'));
    }

    public function create()
    {
        $this->authorize('create-challenge');
        return view('challenges.create');
    }

    public function store(ChallengeRequest $request)
    {
        $this->authorize('create-challenge');

        $challenge = new Challenge($request->validated()); // Use validated data
        $challenge->user_id = Auth::id(); // Set creator
        // is_public should be part of validated data if coming from form
        $challenge->is_public = $request->boolean('is_public'); 
        
        // Default values if not in validated data and not nullable
        $challenge->type = $request->type ?? $challenge->type ?? ""; // Keep existing if not provided
        $challenge->endpoint = $request->endpoint ?? $challenge->endpoint ?? "";
        $challenge->tie_break = $request->tie_break ?? $challenge->tie_break ?? 0;
        $challenge->matching = $request->matching ?? $challenge->matching ?? "";

        $challenge->save();
        return redirect()->route('challenges.index')->with('success', 'Challenge agregada correctamente');
    }

    public function show(Challenge $challenge)
    {
        // For 'view-challenge', Gate::authorize might not work as expected for unauthenticated users
        // if the Gate strictly requires a User object.
        // So, we handle public access first, then use Gate for authenticated users on private challenges.
        if (!$challenge->is_public) {
            $this->authorize('view-challenge', $challenge);
        }
        // If it's public, or if private and authorized, load and show
        $challenge->load(['players.user', 'matches.player1.user', 'matches.player2.user', 'matches.challenge.players']);
        return view('challenges.show', compact('challenge'));
    }

    public function edit(Challenge $challenge)
    {
        $this->authorize('update-challenge', $challenge);
        // Return view for editing, e.g., return view('challenges.edit', compact('challenge'));
        abort(501, 'Not Implemented');
    }

    public function update(Request $request, Challenge $challenge) // Consider using a FormRequest
    {
        $this->authorize('update-challenge', $challenge);
        // $validatedData = $request->validated(); // If using FormRequest
        // $challenge->update($validatedData);
        abort(501, 'Not Implemented');
        // return redirect()->route('challenges.show', $challenge)->with('success', 'Challenge actualizado.');
    }

    public function destroy(Challenge $challenge)
    {
        $this->authorize('delete-challenge', $challenge);
        // $challenge->delete();
        abort(501, 'Not Implemented');
        // return redirect()->route('challenges.index')->with('success', 'Challenge eliminado.');
    }

    public function showAddPlayersForm(Challenge $challenge)
    {
        $this->authorize('manage-challenge-players', $challenge);
        $existingPlayerUserIds = $challenge->players()->whereNotNull('user_id')->pluck('user_id')->all();
        $users = \App\Models\User::whereNotIn('id', $existingPlayerUserIds)->get();
        return view('challenges.add_players_form', compact('challenge', 'users'));
    }

    public function addPlayer(Request $request, Challenge $challenge)
    {
        $this->authorize('manage-challenge-players', $challenge);

        $request->validate([
            'player_type' => 'required|in:user,guest',
            'user_id' => 'required_if:player_type,user|exists:users,id',
            'guest_name' => 'required_if:player_type,guest|string|max:255',
            'team_id' => 'nullable|string|max:255',
        ]);

        if ($challenge->players()->count() >= $challenge->No_players) {
            return redirect()->back()->with('error', 'El desafío ya está lleno.');
        }
        // ... (rest of the logic remains largely the same, ensure it uses validated data)
        $playerType = $request->input('player_type');
        $userId = $request->input('user_id');
        $guestName = $request->input('guest_name');

        if ($playerType === 'user' && $userId) {
            if ($challenge->players()->where('user_id', $userId)->exists()) {
                return redirect()->back()->with('error', 'Este usuario ya ha sido añadido al desafío.');
            }
        }

        $challengePlayer = new \App\Models\ChallengePlayer();
        $challengePlayer->challenge_id = $challenge->id;
        if ($playerType === 'user' && $userId) {
            $challengePlayer->user_id = $userId;
        } elseif ($playerType === 'guest' && $guestName) {
            $challengePlayer->name = $guestName;
        } else {
            return redirect()->back()->with('error', 'Información de jugador inválida.');
        }
        if ($request->filled('team_id')) {
            $challengePlayer->team_id = $request->input('team_id');
        }
        $challengePlayer->save();

        return redirect()->route('challenges.show', $challenge)->with('success', 'Jugador añadido correctamente.');
    }

    public function createMatchForm(Challenge $challenge)
    {
        $this->authorize('create-challenge-match', $challenge);
        $challengePlayers = $challenge->players;
        $teams = $challengePlayers->whereNotNull('team_id')->where('team_id', '!=', '')->groupBy('team_id');
        $individualPlayers = $challengePlayers;
        return view('challenges.matches.create', compact('challenge', 'teams', 'individualPlayers'));
    }

    public function storeMatch(Request $request, Challenge $challenge)
    {
        $this->authorize('create-challenge-match', $challenge);

        $request->validate([
            'match_type' => 'required|in:team,single',
            'team1_id' => 'required_if:match_type,team|nullable|string|max:255',
            'team2_id' => 'required_if:match_type,team|nullable|string|max:255|different:team1_id',
            'player1_id' => 'required_if:match_type,single|nullable|exists:challenge_players,id',
            'player2_id' => 'required_if:match_type,single|nullable|exists:challenge_players,id|different:player1_id',
            'match_date' => 'nullable|date',
            'match_time' => 'nullable|date_format:H:i',
            'status' => 'nullable|string|in:scheduled,in_progress,completed,cancelled',
        ]);
        
        $matchData = $request->all();
        $matchData['challenge_id'] = $challenge->id;

        if ($request->input('match_type') === 'team') {
            $team1Exists = $challenge->players()->where('team_id', $request->input('team1_id'))->exists();
            $team2Exists = $challenge->players()->where('team_id', $request->input('team2_id'))->exists();
            if (!$team1Exists || !$team2Exists) {
                return redirect()->back()->withInput()->with('error', 'Uno o ambos equipos seleccionados no son válidos para este desafío.');
            }
            $matchData['player1_id'] = null;
            $matchData['player2_id'] = null;
        } else { // single
            $player1ChallengePlayer = $challenge->players()->find($request->input('player1_id'));
            $player2ChallengePlayer = $challenge->players()->find($request->input('player2_id'));
            if (!$player1ChallengePlayer || !$player2ChallengePlayer || $player1ChallengePlayer->challenge_id !== $challenge->id || $player2ChallengePlayer->challenge_id !== $challenge->id) {
                 return redirect()->back()->withInput()->with('error', 'Uno o ambos jugadores seleccionados no son válidos para este desafío.');
            }
            $matchData['team1_id'] = null;
            $matchData['team2_id'] = null;
        }
        $matchData['status'] = $request->input('status', 'scheduled');

        \App\Models\ChallengeMatch::create($matchData);

        return redirect()->route('challenges.show', $challenge)->with('success', 'Partido creado correctamente.');
    }
}
