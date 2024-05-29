<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\GameController;

// Game stuff (/game/*)
Route::get('/play', fn() => redirect()->route('game.classic') );

Route::group(['prefix' => 'game'], function () {

    Route::group(['namespace' => 'navbar'],function() {
        Route::view('/', 'pages.games.main')->name('game.main');
    });

    Route::get('/normal',   fn() => redirect()->route('game.classic') );
    Route::get('/medium',   fn() => redirect()->route('game.classic') );

    Route::get('/short',    [GameController::class, 'short'])->name('game.short');
    Route::get('/classic',  [GameController::class, 'classic'])->name('game.classic');
    Route::get('/long',     [GameController::class, 'long'])->name('game.long');

});
