<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\GameController;

// Game stuff (/game/*)
Route::get('/play', fn() => redirect()->route('game.classic') );

Route::group(['prefix' => 'game'], function () {

    Route::group(['namespace' => 'navbar'],function() {
        Route::view('/', 'pages.games.main')->name('game.main');
    });

    // Singleplayer
    Route::get('/normal',   fn() => redirect()->route('game.classic') );
    Route::get('/medium',   fn() => redirect()->route('game.classic') );

    Route::get('/short',    [GameController::class, 'short'])->name('game.short');
    Route::post('/short',  [GameController::class, 'shortPost'])->name('game.clashortssic.post');
    Route::get('/classic',  [GameController::class, 'classic'])->name('game.classic');
    Route::post('/classic',  [GameController::class, 'classicPost'])->name('game.classic.post');
    Route::get('/long',     [GameController::class, 'long'])->name('game.long');
    Route::post('/long',  [GameController::class, 'longPost'])->name('game.long.post');


    // Multiplayer
    Route::get('/normal-mp/versus',   fn() => redirect()->route('game.classic') );
    Route::get('/medium-mp/coop',   fn() => redirect()->route('game.classic') );
    Route::get('/normal-mp-versus',   fn() => redirect()->route('game.classic') );
    Route::get('/medium-mp-coop',   fn() => redirect()->route('game.classic') );

    Route::get('/normal/mp/versus',   fn() => redirect()->route('game.classic') );
    Route::get('/medium/mp/coop',   fn() => redirect()->route('game.classic') );

    Route::get('/normal/multiplayer/versus',   fn() => redirect()->route('game.classic') );
    Route::get('/medium/multiplayer/coop',   fn() => redirect()->route('game.classic') );

    Route::get('/short-mp/versus',    [GameController::class, 'short'])->name('game.mp.short.versus');
    Route::get('/short-mp/coop',    [GameController::class, 'short'])->name('game.mp.short.coop');

    Route::get('/classic-mp/versus',  [GameController::class, 'classic'])->name('game.mp.classic.versus');
    Route::get('/classic-mp/coop',  [GameController::class, 'classic'])->name('game.mp.classic.coop');

    Route::get('/long-mp/versus',     [GameController::class, 'long'])->name('game.mp.long.versus');
    Route::get('/long-mp/coop',     [GameController::class, 'long'])->name('game.mp.long.coop');



});
