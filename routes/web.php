<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LeaguesController;
use App\Http\Controllers\PlayersController;
use App\Http\Controllers\ChallengeController;
use App\Http\Controllers\ClubsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/leagues', [LeaguesController::class, 'index'])->name('leagues.index');
    Route::get('/leagues/create', [LeaguesController::class, 'create'])->name('leagues.create');
    Route::post('/leagues',[LeaguesController::class, 'store' ])->name('leagues.store');
    Route::get('/leagues/{league}',[LeaguesController::class, 'show' ])->name('leagues.show');
    Route::get('/leagues/{league}/edit',[LeaguesController::class, 'edit' ])->name('leagues.edit');
    Route::patch ('/leagues/{league}',[LeaguesController::class, 'update' ])->name('leagues.update');

    Route::get('/players', [PlayersController::class, 'index'])->name('players.index');
    Route::get('/players/create', [PlayersController::class, 'create'])->name('players.create');
    Route::post('/players',[PlayersController::class, 'store' ])->name('players.store');
    Route::get('/players/{player}',[PlayersController::class, 'show' ])->name('players.show');
    Route::get('/players/{player}/edit',[PlayersController::class, 'edit' ])->name('players.edit');
    Route::patch ('/players/{player}',[PlayersController::class, 'update' ])->name('players.update');

    Route::get('/challenges', [ChallengeController::class, 'index'])->name('challenges.index');
    Route::get('/challenges/create', [ChallengeController::class, 'create'])->name('challenges.create');
    Route::post('/challenges',[ChallengeController::class, 'store' ])->name('challenges.store');
    Route::get('/challenges/{challenge}',[ChallengeController::class, 'show' ])->name('challenges.show');
    Route::get('/challenges/{challenge}/edit',[ChallengeController::class, 'edit' ])->name('challenges.edit');
    Route::patch ('/challenges/{challenge}',[ChallengeController::class, 'update' ])->name('challenges.update');

    Route::get('/clubs', [ClubsController::class, 'index'])->name('clubs.index');
    Route::get('/clubs/create', [ClubsController::class, 'create'])->name('clubs.create');
    Route::post('/clubs',[ClubsController::class, 'store' ])->name('clubs.store');
    Route::get('/clubs/{club}',[ClubsController::class, 'show' ])->name('clubs.show');
    Route::get('/clubs/{club}/edit',[ClubsController::class, 'edit' ])->name('clubs.edit');
    Route::patch ('/clubs/{club}',[ClubsController::class, 'update' ])->name('clubs.update');
});

require __DIR__.'/auth.php';
