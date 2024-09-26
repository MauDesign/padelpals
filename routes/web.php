<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LeaguesController;
use App\Http\Controllers\PlayersController;
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
});

require __DIR__.'/auth.php';
